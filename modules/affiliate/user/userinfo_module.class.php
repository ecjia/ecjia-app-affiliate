<?php
//
//    ______         ______           __         __         ______
//   /\  ___\       /\  ___\         /\_\       /\_\       /\  __ \
//   \/\  __\       \/\ \____        \/\_\      \/\_\      \/\ \_\ \
//    \/\_____\      \/\_____\     /\_\/\_\      \/\_\      \/\_\ \_\
//     \/_____/       \/_____/     \/__\/_/       \/_/       \/_/ /_/
//
//   上海商创网络科技有限公司
//
//  ---------------------------------------------------------------------------------
//
//   一、协议的许可和权利
//
//    1. 您可以在完全遵守本协议的基础上，将本软件应用于商业用途；
//    2. 您可以在协议规定的约束和限制范围内修改本产品源代码或界面风格以适应您的要求；
//    3. 您拥有使用本产品中的全部内容资料、商品信息及其他信息的所有权，并独立承担与其内容相关的
//       法律义务；
//    4. 获得商业授权之后，您可以将本软件应用于商业用途，自授权时刻起，在技术支持期限内拥有通过
//       指定的方式获得指定范围内的技术支持服务；
//
//   二、协议的约束和限制
//
//    1. 未获商业授权之前，禁止将本软件用于商业用途（包括但不限于企业法人经营的产品、经营性产品
//       以及以盈利为目的或实现盈利产品）；
//    2. 未获商业授权之前，禁止在本产品的整体或在任何部分基础上发展任何派生版本、修改版本或第三
//       方版本用于重新开发；
//    3. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回并承担相应法律责任；
//
//   三、有限担保和免责声明
//
//    1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的；
//    2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未获得商业授权之前，我们不承
//       诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任；
//    3. 上海商创网络科技有限公司不对使用本产品构建的商城中的内容信息承担责任，但在不侵犯用户隐
//       私信息的前提下，保留以任何方式获取用户信息及商品信息的权利；
//
//   有关本产品最终用户授权协议、商业授权与技术服务的详细内容，均由上海商创网络科技有限公司独家
//   提供。上海商创网络科技有限公司拥有在不事先通知的情况下，修改授权协议的权力，修改后的协议对
//   改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和
//   等同的法律效力。您一旦开始修改、安装或使用本产品，即被视为完全理解并接受本协议的各项条款，
//   在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本
//   授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
//
//  ---------------------------------------------------------------------------------
//
defined('IN_ECJIA') or exit('No permission resources.');

use Ecjia\App\Affiliate\Models\AffiliateDistributorModel;
/**
 * 代理用户信息
 * @author huangyuyuan@ecmoban.com
 */
class affiliate_user_userinfo_module extends api_front implements api_interface {
    public function handleRequest(\Royalcms\Component\HttpKernel\Request $request) {	
    	
        //如果用户登录获取其session
        $user_id = $_SESSION['user_id'];
    	if ($user_id <= 0) {
    		return new ecjia_error(100, 'Invalid session');
    	}
    	

		RC_Loader::load_app_func('admin_user', 'user');
		$user_info = EM_user_info($user_id);
		if (empty($user_info)) {
			return new ecjia_error('userinfo_not_exist', '用户信息不存在 ！');
		}

        $distributor = collect(AffiliateDistributorModel::with([
            'user_model' => function($query) {
                $query->select('user_id', 'user_name');
            },
            'affiliate_grade_model' => function($query) {
                $query->select('grade_id', 'grade_name');
            },
        ])->where('user_id', $user_id)->first())->toArray();

        $data = array(
            'id'               => intval($user_info['id']),
            'name'             => !empty($user_info['name']) ? trim($user_info['name']) : '',
            'agent_role'       => '',
            'label_agent_role' => !empty($distributor['affiliate_grade_model']['grade_name']) ? $distributor['affiliate_grade_model']['grade_name'] : $user_info['rank_name'],
            'avatar_img'       => empty($user_info['avatar_img']) ? '' : $user_info['avatar_img'],
        );

        $today_amount = $this->get_today_affiliate($user_id);
        $total_order_amount = $this->total_order_amount($user_id);
        $total_amount = $this->get_total_affiliate($user_id);

        $data['stats'] = array(
            'withdrawal_amount'           => $user_info['user_money'],
            'formated_withdrawal_amount'  => $user_info['formated_user_money'],
            'today_amount'                => $today_amount,
            'formated_today_amount'       => ecjia_price_format($today_amount, false),
            'total_order_amount'          => $total_order_amount,
            'formated_total_order_amount' => ecjia_price_format($total_order_amount, false),
            'total_amount'                => $total_amount,
            'formated_total_amount'       => ecjia_price_format($total_amount, false)
        );
		
		return $data;
	}
	
	
	/**
	 * 获取当前角色今日分佣收益
	 */
	private function get_today_affiliate($user_id) {
		$amount = 0;
        if (!empty($user_id)) {
            $start_time = RC_Time::local_strtotime(RC_Time::local_date('Y-m-d'));
            $end_time = $start_time + 86399;
            $amount = RC_DB::table('affiliate_log')
                ->where('user_id', $user_id)
//                ->where('money_status', '!=', '-1')
                ->where('separate_type', '!=', '2')
                ->where('time', '>=', $start_time)
                ->where('time', '<=', $end_time)
                ->pluck(RC_DB::raw('SUM(money) as amount'));
            $amount = $amount > 0 ? $amount : 0;
        }
		return $amount;
	}
	
	/**
	 * 获取当前角总分佣收益
	 */
	private function get_total_affiliate($user_id) {
		$amount = 0;
		if (!empty($user_id)) {
			$amount = RC_DB::table('affiliate_log')
			->where('user_id', $user_id)
//			->where('money_status', '!=', '-1')
            ->where('separate_type', '!=', '2')
			->pluck(RC_DB::raw('SUM(money) as amount'));
			$amount = $amount > 0 ? $amount : 0;
		}
		return $amount;
	}
	
	/**
	 * 所有已确认收货订单总金额
	 */
	private function total_order_amount ($user_id) {
        $amount = 0;
		if (!empty($user_id)) {
            $amount = RC_DB::table('affiliate_log as al')
                ->leftJoin('order_info as oi', RC_DB::raw('oi.order_id'), '=', RC_DB::raw('al.order_id'))
                ->where(RC_DB::raw('al.user_id'), $user_id)
                ->where(RC_DB::raw('al.separate_type'), '!=', '2')
                ->whereIn('order_status', array(OS_SPLITED, OS_SPLITING_PART))
                ->where('shipping_status', SS_RECEIVED)
                ->where('pay_status', PS_PAYED)
                ->select(RC_DB::Raw('SUM(goods_amount + shipping_fee + insure_fee + pay_fee + pack_fee + card_fee + tax - integral_money - bonus - discount) as total_amount'))
                ->first();
            $amount = $amount['total_amount'] > 0 ? $amount['total_amount'] : 0;
		}
		return $amount;
	}
}

// end