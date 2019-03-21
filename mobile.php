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

class mobile extends ecjia_front {
	public function __construct() {	
		parent::__construct();	
		$front_url = RC_App::apps_url('statics/front', __FILE__);
		$front_url = str_replace('sites/api/', '', $front_url);
  		/* js与css加载路径*/
  		$this->assign('front_url', $front_url);
  		$this->assign('title', ecjia::config('shop_name'). __('邀请好友注册得奖励', 'affiliate'));
	}
	
	public function init() {
		
		$invite_code = isset($_GET['invite_code']) ? trim($_GET['invite_code']) : '';
		$urlscheme = ecjia::config('mobile_shop_urlscheme');
		if (preg_match('/ECJiaBrowse/', $_SERVER['HTTP_USER_AGENT'])) {
			header("location: ".$urlscheme."app?open_type=signup&invite_code=".$invite_code);
			exit();
		}
		$affiliate_note = __("请输入您的电话并下载移动商城应用程序", 'affiliate');
		
		
		/*是否有设置下载地址*/
		if (stripos($_SERVER['HTTP_USER_AGENT'], "iPhone")) {
			$url = ecjia::config('mobile_iphone_download');
		} elseif (stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
			$url = ecjia::config('mobile_android_download');
		}
		
		if ($this->is_weixin() == true) {
			$this->assign('is_h5', 1);
			$affiliate_note = sprintf(__("请输入您的手机号并下载【%s】", 'affiliate'), ecjia::config('shop_name'));
		}
		
		/* 推荐处理 */
		$affiliate = unserialize(ecjia::config('affiliate'));
		if (isset($affiliate['on']) && $affiliate['on'] == 1 && $affiliate['intviee_reward']['intivee_reward_value'] > 0) {
			if ($affiliate['intviee_reward']['intivee_reward_type'] == 'bonus') {
				$reward_value = RC_DB::table('bonus_type')->where('type_id', $affiliate['intviee_reward']['intivee_reward_value'])->pluck('type_money');
				$reward_value = price_format($reward_value);
				$reward_type = __('红包', 'affiliate');
			} elseif ($affiliate['intviee_reward']['intivee_reward_type'] == 'integral') {
				$reward_value = $affiliate['intviee_reward']['intivee_reward_value'];
				$reward_type = __('积分', 'affiliate');
			} elseif ($affiliate['intviee_reward']['intivee_reward_type'] == 'balance') {
				$reward_value = price_format($affiliate['intviee_reward']['intivee_reward_value']);
				$reward_type = __('现金', 'affiliate');
			}
			
			if ($affiliate['intviee_reward']['intivee_reward_by'] == 'signup') {
				$affiliate_note .= sprintf(__("，完成注册后，您将获得%s%s奖励", 'affiliate'), $reward_value,$reward_type);
			} 
			else {
				$affiliate_note .= sprintf(__("，完成注册首次下单后，您将获得%s%s奖励", 'affiliate'), $reward_value,$reward_type);
			}
			
		}
		
		$user_id = Ecjia\App\Affiliate\UserInviteCode::getUserId($invite_code);

		if (!empty($user_id)) {
			$user_name = RC_DB::table('users')->where('user_id', $user_id)->pluck('user_name');
			$note = sprintf(__("%s为您推荐[%s]移动商城", 'affiliate'), $user_name,ecjia::config('shop_name'));
			if ($this->is_weixin() == true) {
				$note = sprintf(__("%s向您推荐一款购物应用【%s】", 'affiliate'), $user_name, ecjia::config('shop_name'));
			}
			$this->assign('note', $note);
		}
		
		$this->assign('invite_code', $invite_code);
		$this->assign('affiliate_note', $affiliate_note);
		
		//$this->display('affiliate.dwt');
		$this->display(
				RC_Package::package('app::affiliate')->loadTemplate('front/affiliate.dwt', true)
		);
	}
	
	public function invite() {
		/* 推荐处理 */
		$affiliate = unserialize(ecjia::config('affiliate'));
		if (isset($affiliate['on']) && $affiliate['on'] == 1) {
			$invite_code = isset($_POST['invite_code']) ? trim($_POST['invite_code']) : '';
			$mobile_phone = isset($_POST['mobile_phone']) ? trim($_POST['mobile_phone']) : '';

            $check_mobile = Ecjia\App\Sms\Helper::check_mobile($mobile_phone);
            if (is_ecjia_error($check_mobile)) {
                return $this->showmessage($check_mobile->get_error_message(), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
            }
			
			$count = RC_DB::table('users')->where('mobile_phone', $mobile_phone)->count();
			if (!empty($invite_code) && !empty($mobile_phone) && $count <= 0) {
				$invite_user_id = Ecjia\App\Affiliate\UserInviteCode::getUserId($invite_code);
				
				if (!empty($invite_user_id)) {
					if (!empty($affiliate['config']['expire'])) {
						if ($affiliate['config']['expire_unit'] == 'hour') {
							$c = $affiliate['config']['expire'] * 1;
						} elseif ($affiliate['config']['expire_unit'] == 'day') {
							$c = $affiliate['config']['expire'] * 24;
						} elseif ($affiliate['config']['expire_unit'] == 'week') {
							$c = $affiliate['config']['expire'] * 24 * 7;
						} else {
							$c = 1;
						}
					} else {
						$c = 24; // 过期时间为 1 天
					}
					$time = RC_Time::gmtime() + $c*3600;
					
					/* 判断在有效期内是否已被邀请*/
					$is_invitee = RC_DB::table('invitee_record')
						->where('invitee_phone', $mobile_phone)
						->where('invite_type', 'signup')
						->where('expire_time', '>', RC_Time::gmtime())
						->first();
					
					if (empty($is_invitee)) {
						RC_DB::table('invitee_record')->insert(array(
							'invite_id'		=> $invite_user_id,
							'invitee_phone' => $mobile_phone,
							'invite_type'	=> 'signup',
							'is_registered' => 0,
							'expire_time'	=> $time,
							'add_time'		=> RC_Time::gmtime()
						));
					}
				}
			}
		}
	
		if (stripos($_SERVER['HTTP_USER_AGENT'], "iPhone")) {
			$url = ecjia::config('mobile_iphone_download');
		} elseif (stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
			$url = ecjia::config('mobile_android_download');
		}
		
		$urlscheme = ecjia::config('mobile_shop_urlscheme');
		$app_url = $urlscheme."app?open_type=signup&invite_code=".$invite_code;
		
		if (empty($url)) {
			$url = RC_Uri::url('user/privilege/register');
		}
		
		if ( $count > 0) {
			return ecjia_front::$controller->showmessage(__('该手机号已注册！', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR, array('url' => $url, 'app' => $app_url));
		}
		
		if (isset($is_invitee) && !empty($is_invitee)) {
			return	ecjia_front::$controller->showmessage(__('您已被邀请过，请勿重复提交！', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR, array('url' => $url, 'app' => $app_url));
		}
		
		return ecjia_front::$controller->showmessage(__('提交成功！', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('url' => $url, 'app' => $app_url));
	}
	
	/**
	 * 生成推广二维码图片
	 */
	public function qrcode()
	{
	    $code = $_GET['invite_code'];
	    
	    $img = with(new Ecjia\App\Affiliate\GenerateInviteCode($code))->createQrcode();
	    
	    $this->header('Content-Type', 'image/png');
	    
	    $this->displayContent($img);
	}
	
	
	public static function is_weixin(){
		if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
			return true;
		}
		return false;
	}
}

// end