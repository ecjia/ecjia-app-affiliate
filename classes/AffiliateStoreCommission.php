<?php
/**
 * Created by PhpStorm.
 * User: huangyuyuan@ecmoban.com
 * Date: 19/6/5 005
 * Time: 11:35
 */

namespace Ecjia\App\Affiliate;

use Ecjia\App\Affiliate\Models\AffiliateStoreModel;
use Ecjia\App\Affiliate\Models\AffiliateOrderCommissionModel;

use Ecjia\App\Affiliate\AffiliateStore;
use RC_Time;
use ecjia;
use ecjia_error;

//代理商推荐店铺结算分佣
class AffiliateStoreCommission
{

    /**
     * 分佣规则
     * 前置：
     * 1.完成的普通订单（确认收货）
     * 2.优惠买单（已付款）
     * 3.退款订单，平台确认退款
     *
     * 细节：
     * 1.退款订单，分佣部分全退（负值）
     * 2.不论何种支付方式，佣金都为正数（商家负值因商家收钱）
     *
     * 目前两级代理（A，B），代理商的佣金从平台佣金部分获得（以平台佣金为基数计算）
     * 一级代理A，两个渠道获得佣金：
     * 1.直推，（数据表字段：affiliate_store.level0）
     * 2.团队分佣（下级代理b推荐店铺）（数据表字段：affiliate_store.level1）
     *
     * 二级代理B，一个渠道获得佣金：
     * 1.直推（数据表字段：affiliate_store.level2，查询上级获得）
     */

    public $store_id;
    public $order;
    public $inviter_agent_info;
    public $inviter_agent_info_parent;

    public function __construct($store_id, $order) {
        $this->store_id = $store_id;
        $this->order = $order;
    }

    public function run() {
        $inviter_agent_id = AffiliateStore::getAffiliateStoreId($this->store_id);//邀请人
        if(empty($inviter_agent_id)) {
            return true;//无邀请记录
        }

        //获得邀请人信息，并判断有无上级代理
        $this->inviter_agent_info = AffiliateStore::getAgentInfo($inviter_agent_id);
        if(empty($this->inviter_agent_info)) {
            return new \ecjia_error('agent_info_not_find', '代理商信息不存在');//代理商信息空
        }

        //获取上级代理商
        if($this->inviter_agent_info['agent_parent_id']) {
            $this->agentParentCommission();
        }
        $this->agentCommission();

        return true;
    }

    //当前代理结算
    private function agentCommission() {
        $agent = [
            'percent_value' => !empty($this->inviter_agent_info_parent['level2']) ? $this->inviter_agent_info_parent['level2'] : $this->inviter_agent_info['level0'],
            'affiliate_store_id' => $this->inviter_agent_info['id'],
        ];
        return $this->insertOrderCommission($agent);
    }

    //父级代理结算
    private function agentParentCommission() {
        $this->inviter_agent_info_parent = AffiliateStoreModel::where('id', $this->inviter_agent_info['agent_parent_id'])->first();
        $agent = [
            'percent_value' => $this->inviter_agent_info_parent['level1'],
            'affiliate_store_id' => $this->inviter_agent_info_parent['id']
        ];
        return $this->insertOrderCommission($agent);
    }

    private function calculateAgentAmount($order_amount_platform, $percent) {
        if($percent >= 100) {
            return $order_amount_platform;
        }
        return $order_amount_platform * ($percent / 100);
    }

    private function insertOrderCommission($agent) {
        $data = [
            'store_id' => $this->store_id,
            'affiliate_store_id' => $agent['affiliate_store_id'],
            'order_type' => $this->order['order_type'],
            'order_id' => $this->order['order_id'],
            'order_sn' => $this->order['order_sn'],
            'order_amount' => $this->order['order_amount'],
            'platform_commission' => $this->order['platform_profit'],//平台佣金
            'percent_value'=> $agent['percent_value'],
            'agent_amount' => $this->calculateAgentAmount($this->order['platform_profit'], $agent['percent_value']),
            'add_time' => \RC_Time::gmtime()
        ];

        AffiliateOrderCommissionModel::insert($data);

        return true;
    }

}