<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19/6/5 005
 * Time: 11:35
 */

namespace Ecjia\App\Affiliate;

use Ecjia\App\Affiliate\Models\AffiliateStoreModel;

class AffiliateStore
{

    //获得代理商id
    public function getAgentIdByUserId($user_id) {
        return AffiliateStoreModel::where('user_id', $user_id)->pluck('id');
    }


    public function getAgentInfoByUserId($user_id) {
        return AffiliateStoreModel::where('user_id', $user_id)->first();
    }

    public function getAgentInfo($id) {
        return AffiliateStoreModel::where('id', $id)->first();
    }

    public function getParentAgentInfoByUserId($user_id) {
        $info = AffiliateStoreModel::where('user_id', $user_id)->first();
        if($info) {
            return AffiliateStoreModel::where('id', $info['agent_parent_id'])->first();
        } else {
            return [];
        }
    }
}