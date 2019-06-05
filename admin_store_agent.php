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

/**
 * ECJIA 店铺代理商管理
 * songqianqian
 */
class admin_store_agent extends ecjia_admin
{

    public function __construct()
    {
        parent::__construct();

        RC_Script::enqueue_script('jquery-validate');
        RC_Script::enqueue_script('jquery-form');
        RC_Script::enqueue_script('smoke');
        RC_Script::enqueue_script('bootstrap-datepicker', RC_Uri::admin_url('statics/lib/datepicker/bootstrap-datepicker.min.js'));
        RC_Style::enqueue_style('datepicker', RC_Uri::admin_url('statics/lib/datepicker/datepicker.css'));

        RC_Script::enqueue_script('jquery-chosen');
        RC_Style::enqueue_style('chosen');
        RC_Script::enqueue_script('ecjia-region');
        RC_Script::enqueue_script('jquery-uniform');
        RC_Style::enqueue_style('uniform-aristo');
        
        RC_Script::enqueue_script('koala', RC_App::apps_url('statics/js/koala.js', __FILE__));
        
        RC_Style::enqueue_style('store_agent', RC_App::apps_url('statics/css/store_agent.css', __FILE__), array());
        
        RC_Script::enqueue_script('admin_store_agent', RC_App::apps_url('statics/js/admin_store_agent.js', __FILE__), array(), false, 1);
        RC_Script::localize_script('admin_store_agent', 'js_lang', config('app-affiliate::jslang.admin_store_agent_page'));

        ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('店铺代理列表', 'affiliate'), RC_Uri::url('affiliate/admin_store_agent/init')));
    }

    /**
     * 店铺代理商列表
     */
    public function init() {
        $this->admin_priv('affiliate_store_manage');

        ecjia_screen::get_current_screen()->remove_last_nav_here();
        ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('店铺代理列表', 'affiliate')));

        $this->assign('ur_here', __('店铺代理列表', 'affiliate'));
        $this->assign('action_link', array('text' => __('添加代理商', 'affiliate'), 'href' => RC_Uri::url('affiliate/admin_store_agent/add')));
        
		$data = $this->get_list();
		$this->assign('data', $data);
		$this->assign('filter', $data['filter']);
		
        $this->assign('search_action', RC_Uri::url('affiliate/admin_store_agent/init'));

        $this->display('store_agent_list.dwt');
    }
    
    
    /**
     * 验证会员信息
     */
    public function validate_acount() {
    	$this->admin_priv('affiliate_store_update');
    	 
    	$user_mobile = empty($_POST['user_mobile']) ? 0 : $_POST['user_mobile'];
    	$check_mobile = Ecjia\App\Sms\Helper::check_mobile($user_mobile);
    
    	if (is_ecjia_error($check_mobile)) {
    		return $this->showmessage($check_mobile->get_error_message(), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	} else {
    		$user_info   = RC_DB::table('users')->where('mobile_phone', $user_mobile)->first();
    		if (empty($user_info)) {
    			return $this->showmessage(__('该手机号对应的会员信息不存在！', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} else {
    			$result = array(
    				'user_id' 	  => $user_info['user_id'],
    				'user_name'   => $user_info['user_name'],
    			);
    			
    			$is_exist_user = RC_DB::table('affiliate_store')->where('user_id', $user_info['user_id'])->count();
    			if ($is_exist_user) {
    				return $this->showmessage(__('该会员已是店铺代理商', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR, array('result' => $result));
    			}
    			return $this->showmessage('', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('result' => $result));
    		}
    	}
    }

    /**
     * 添加代理商
     */
    public function add() {
        $this->admin_priv('affiliate_store_update');

        ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('添加代理商', 'affiliate')));

        $this->assign('ur_here', __('添加代理商', 'affiliate'));
        $this->assign('action_link', array('href' => RC_Uri::url('affiliate/admin_store_agent/init'), 'text' => __('代理商列表', 'affiliate')));
        
        $provinces = ecjia_region::getSubarea(ecjia::config('shop_country'));
        $this->assign('province', $provinces);
        
        $this->assign('form_action', RC_Uri::url('affiliate/admin_store_agent/insert'));

        $this->display('store_agent_edit.dwt');
    }
    
    /**
     * 添加代理商处理
     */
    public function insert() {
    	$this->admin_priv('affiliate_store_update');
    	
    	$user_id    = intval($_POST['user_id']);
    	$agent_name = trim($_POST['agent_name']);
    	
    	$user_mobile = empty($_POST['user_mobile']) ? 0 : $_POST['user_mobile'];
    	$check_mobile = Ecjia\App\Sms\Helper::check_mobile($user_mobile);
    	if (is_ecjia_error($check_mobile)) {
    		return $this->showmessage($check_mobile->get_error_message(), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	} 
    	
    	$user_info   = RC_DB::table('users')->where('mobile_phone', $user_mobile)->first();
    	if (empty($user_info)) {
    		return $this->showmessage(__('该手机号对应的会员信息不存在', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}

    	$is_exist_user = RC_DB::table('affiliate_store')->where('user_id', $user_id)->count();
    	if ($is_exist_user) {
    		return $this->showmessage(__('该会员已是店铺代理商', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    	
    	$is_exist_name = RC_DB::table('affiliate_store')->where('agent_name', $agent_name)->count();
    	if ($is_exist_name) {
    		return $this->showmessage(__('代理商名称已存在，请更换', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    	 
    	if(!empty($_POST['level0'])) {
    		if (substr($_POST['level0'], -1, 1) == '%') {
    			$intval = substr($_POST['level0'], 0, strlen($_POST['level0'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('直推店铺佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level0'] > 100 || $_POST['level0'] < 0) {
    				return $this->showmessage(__('直推店铺佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}	
    		} elseif (!is_numeric($_POST['level0'])) {
    			return $this->showmessage(__('直推店铺佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level0'] > 100 || $_POST['level0'] < 0) {
    			return $this->showmessage(__('直推店铺佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}
    	
    	if(!empty($_POST['level1'])) {
    		if (substr($_POST['level1'], -1, 1) == '%') {
    			$intval = substr($_POST['level1'], 0, strlen($_POST['level1'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('团队推荐佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level1'] > 100 || $_POST['level1'] < 0) {
    				return $this->showmessage(__('团队推荐佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}
    		} elseif (!is_numeric($_POST['level1'])) {
    			return $this->showmessage(__('团队推荐佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level1'] > 100 || $_POST['level1'] < 0) {
    			return $this->showmessage(__('团队推荐佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}
    	
    	if(!empty($_POST['level2'])) {
    		if (substr($_POST['level2'], -1, 1) == '%') {
    			$intval = substr($_POST['level2'], 0, strlen($_POST['level_point'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('直属下级佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level2'] > 100 || $_POST['level2'] < 0) {
    				return $this->showmessage(__('直属下级佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}
    		} elseif (!is_numeric($_POST['level2'])) {
    			return $this->showmessage(__('直属下级佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level2'] > 100 || $_POST['level2'] < 0) {
    			return $this->showmessage(__('直属下级佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}

    	//产生代理商资料
    	$data_affiliate_store = array(
    		'user_id'       => $user_id,
    		'agent_name'    => $agent_name,
    		'level0'		=> (float)$_POST['level0'],	
    		'level1'		=> (float)$_POST['level1'],
    		'level2'		=> (float)$_POST['level2'],
    		'add_time'     	=> RC_Time::gmtime(),
    	);
    	$id = RC_DB::table('affiliate_store')->insertGetId($data_affiliate_store);

    	if($id){
    		return $this->showmessage(__('添加店铺代理商成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('affiliate/admin_store_agent/edit', array('id' => $id))));
    	} else {
    		return $this->showmessage(__('添加店铺代理商失败', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    }
    
    /**
     * 编辑代理商
     */
    public function edit() {
    	$this->admin_priv('affiliate_store_update');
    
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('编辑代理商', 'affiliate')));
    	$this->assign('ur_here', __('编辑代理商', 'affiliate'));
    	$this->assign('action_link', array('text' => __('代理商列表', 'affiliate'), 'href' => RC_Uri::url('affiliate/admin_store_agent/init')));
    
    	$id     = intval($_GET['id']);
    	$data   = RC_DB::table('affiliate_store')->where('id', $id)->first();
    	$data['user'] = RC_DB::TABLE('users')->where('user_id', $data['user_id'])->select('mobile_phone', 'user_name')->first();
    	$this->assign('data', $data);
    
    	$this->assign('form_action', RC_Uri::url('affiliate/admin_store_agent/update'));
    
    	$this->display('store_agent_edit.dwt');
    }
    
    /**
     * 编辑代理商处理
     */
    public function update() {
    	$this->admin_priv('affiliate_store_update');
    
    	$id = intval($_POST['id']);
    	
    	$user_id    = intval($_POST['user_id']);
    	$agent_name = trim($_POST['agent_name']);
    	
    	$user_mobile = empty($_POST['user_mobile']) ? 0 : $_POST['user_mobile'];
    	$check_mobile = Ecjia\App\Sms\Helper::check_mobile($user_mobile);
    	if (is_ecjia_error($check_mobile)) {
    		return $this->showmessage($check_mobile->get_error_message(), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    	 
    	$user_info   = RC_DB::table('users')->where('mobile_phone', $user_mobile)->first();
    	if (empty($user_info)) {
    		return $this->showmessage(__('该手机号对应的会员信息不存在！', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    	
    	$is_exist_user = RC_DB::table('affiliate_store')->where('user_id', $user_id)->where('id', '!=', $id)->count();
    	if ($is_exist_user) {
    		return $this->showmessage(__('该会员已是店铺代理商', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}
    	
    	$is_exist_name = RC_DB::table('affiliate_store')->where('agent_name', $agent_name)->where('id', '!=', $id)->count();
    	if ($is_exist_name) {
    		return $this->showmessage(__('代理商名称已存在，请更换', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    	}

    	if(!empty($_POST['level0'])) {
    		if (substr($_POST['level0'], -1, 1) == '%') {
    			$intval = substr($_POST['level0'], 0, strlen($_POST['level0'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('直推店铺佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level0'] > 100 || $_POST['level0'] < 0) {
    				return $this->showmessage(__('直推店铺佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}
    		} elseif (!is_numeric($_POST['level0'])) {
    			return $this->showmessage(__('直推店铺佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level0'] > 100 || $_POST['level0'] < 0) {
    			return $this->showmessage(__('直推店铺佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}
    	 
    	if(!empty($_POST['level1'])) {
    		if (substr($_POST['level1'], -1, 1) == '%') {
    			$intval = substr($_POST['level1'], 0, strlen($_POST['level1'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('团队推荐佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level1'] > 100 || $_POST['level1'] < 0) {
    				return $this->showmessage(__('团队推荐佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}
    		} elseif (!is_numeric($_POST['level1'])) {
    			return $this->showmessage(__('团队推荐佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level1'] > 100 || $_POST['level1'] < 0) {
    			return $this->showmessage(__('团队推荐佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}
    	 
    	if(!empty($_POST['level2'])) {
    		if (substr($_POST['level2'], -1, 1) == '%') {
    			$intval = substr($_POST['level2'], 0, strlen($_POST['level_point'])-1);
    			if (!is_numeric($intval)) {
    				return $this->showmessage(__('直属下级佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			} elseif ($_POST['level2'] > 100 || $_POST['level2'] < 0) {
    				return $this->showmessage(__('直属下级佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    			}
    		} elseif (!is_numeric($_POST['level2'])) {
    			return $this->showmessage(__('直属下级佣金比格式不正确，应为数字类型', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		} elseif ($_POST['level2'] > 100 || $_POST['level2'] < 0) {
    			return $this->showmessage(__('直属下级佣金比为0-100，请修改', 'store'),ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
    		}
    	}

    	$data_affiliate_store = array(
    		'user_id'       => $user_id,
    		'agent_name'    => $agent_name,
    		'level0'		=> (float)$_POST['level0'],
    		'level1'		=> (float)$_POST['level1'],
    		'level2'		=> (float)$_POST['level2'],
    	);
    	RC_DB::table('affiliate_store')->where('id', $id)->update($data_affiliate_store);
    	
    	return $this->showmessage(__('编辑代理商成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('affiliate/admin_store_agent/edit', array('id' => $id))));
    }
    

    /**
     * 删除代理商
     */
    public function remove() {
    	$this->admin_priv('affiliate_store_delete');
    
    	$id = intval($_GET['id']);
    	RC_DB::table('affiliate_store')->where('id', $id)->delete();
    
    	return $this->showmessage(__('删除成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
    }
    

    /**
     * 批量操作
     */
    public function batch() {
    	$this->admin_priv('affiliate_store_delete');
    
    	$ids  = explode(',', $_POST['id']);
    	RC_DB::table('affiliate_store')->whereIn('id', $ids)->delete();
    	
    	return $this->showmessage(__('批量删除成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('pjaxurl' => RC_Uri::url('affiliate/admin_store_agent/init')));
    }
    
    /**
     * 查看详情
     */
    public function detail() {
    	$this->admin_priv('affiliate_store_manage');
    
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('代理商详情', 'affiliate')));
    	
    	$this->assign('ur_here', __('代理商详情', 'affiliate'));
    	$this->assign('action_link', array('text' => __('代理商列表', 'affiliate'), 'href' => RC_Uri::url('affiliate/admin_store_agent/init')));
    
    	$id    = intval($_GET['id']);
    	$data  = RC_DB::table('affiliate_store')->where('id', $id)->first();
    	$data['user'] = RC_DB::TABLE('users')->where('user_id', $data['user_id'])->select('mobile_phone', 'user_name')->first();
    	$data['add_time_new']  = RC_Time::local_date('Y-m-d H:i:s', $data['add_time']);
    	$data['team_count']	   = RC_DB::TABLE('affiliate_store')->where('agent_parent_id', $id)->count();
    	
    	$this->assign('data', $data);
    	
    	$this->display('store_agent_detail.dwt');
    }
    
    
    /**
     * 查看团队列表
     */
    public function team_list() {
    	$this->admin_priv('affiliate_store_manage');
    
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('下级代理商列表', 'affiliate')));
    	$this->assign('ur_here', __('下级代理商列表', 'affiliate'));
    	
    	$id = intval($_GET['id']);
    	$this->assign('action_link', array('text' => __('代理商详情', 'affiliate'), 'href' => RC_Uri::url('affiliate/admin_store_agent/detail',  array('id' => $id))));
    	
    	$agent_name = RC_DB::TABLE('affiliate_store')->where('id', $id)->pluck('agent_name');
    	$this->assign('agent_name', $agent_name);
    	
    	$team_count = RC_DB::TABLE('affiliate_store')->where('agent_parent_id', $id)->count();
    	$this->assign('team_count', $team_count);
    	
    	$data = $this->get_team_list($id);
    	$this->assign('data', $data);
    	$this->assign('filter', $data['filter']);
    	
    	$this->assign('search_action', RC_Uri::url('affiliate/admin_store_agent/team_list', array('id' => $id)));
    	
    	$this->display('team_list.dwt');
    }
    
    
    /**
     * 查看店铺列表
     */
    public function store_list() {
    	$this->admin_priv('affiliate_store_manage');
    
    	ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('推广店铺列表', 'affiliate')));
    	$this->assign('ur_here', __('推广店铺列表', 'affiliate'));
    	
    	$id = intval($_GET['id']);
    	$this->assign('id', $id);
    	$this->assign('action_link', array('text' => __('代理商详情', 'affiliate'), 'href' => RC_Uri::url('affiliate/admin_store_agent/detail', array('id' => $id))));
    	
    	$agent_name = RC_DB::TABLE('affiliate_store')->where('id', $id)->pluck('agent_name');
    	$this->assign('agent_name', $agent_name);
    	
    	$agent_list_arr = RC_DB::table('affiliate_store')->where('agent_parent_id', $id)->lists('id');
    	array_push($agent_list_arr, $id);
    	
    	$store_count = RC_DB::TABLE('affiliate_store_record')->whereIn('affiliate_store_id', $agent_list_arr)->count();
    	$this->assign('store_count', $store_count);

    	$type = trim($_GET['type']);
    	$this->assign('type', $type);
    	
    	$data = $this->get_store_list($id, $type);
    	$this->assign('data', $data);
    	$this->assign('type_count', $data['count']);
    	$this->assign('filter', $data['filter']);
    	
    	$this->assign('search_action', RC_Uri::url('affiliate/admin_store_agent/store_list', array('id' => $id)));
    	
    	$this->display('store_list.dwt');
    }
  
    /**
     * 获取代理商列表数据
     */
    private function get_list() {
    	
    	$db_data = RC_DB::table('affiliate_store as a')
    	->leftJoin('users as u', RC_DB::raw('a.user_id'), '=', RC_DB::raw('u.user_id'));
    	
    	$db_data->where(RC_DB::raw('a.agent_parent_id'), 0);
    	
    	$filter['start_date'] = empty($_GET['start_date']) ? '' : $_GET['start_date'];
    	$filter['end_date']   = empty($_GET['end_date']) ? '' : $_GET['end_date'];
    	$filter['keywords']	 = trim($_GET['keywords']);
    	
    	if ($filter['keywords']) {
    		$db_data ->whereRaw('(a.agent_name  like  "%'.mysql_like_quote($filter['keywords']).'%"  or u.mobile_phone like "%'.mysql_like_quote($filter['keywords']).'%")');
    	}
    	if (!empty($filter['start_date'])) {
    		$start_date = RC_Time::local_strtotime($filter['start_date']);
    		$db_data->where(RC_DB::raw('a.add_time'), '>=', $start_date);
    	}
    	
    	if (!empty($filter['end_date'])) {
    		$end_date = RC_Time::local_strtotime($filter['end_date']);
    		$db_data->where(RC_DB::raw('a.add_time'), '<', $end_date);
    	}
        	
    	$count = $db_data->count();
    	$page = new ecjia_page($count, 10, 5);
    
    	$data = $db_data
    	->select(RC_DB::raw('a.*'),RC_DB::raw('u.mobile_phone'), RC_DB::raw('u.user_name'))
    	->orderby(RC_DB::raw('a.add_time'), 'desc')
    	->take(10)
    	->skip($page->start_id-1)
    	->get();
    	$list = array();
    	if (!empty($data)) {
    		foreach ($data as $row) {
    			$row['add_time']  = RC_Time::local_date('Y-m-d H:i:s', $row['add_time']);
    			$list[] = $row;
    		}
    	}
    	return array('list' => $list, 'filter' => $filter, 'page' => $page->show(5), 'desc' => $page->page_desc());
    }
    
    /**
     * 获取B级代理商列表数据
     */
    private function get_team_list($id) {
    	
    	$db_data = RC_DB::table('affiliate_store as a')
    	->leftJoin('users as u', RC_DB::raw('a.user_id'), '=', RC_DB::raw('u.user_id'));

    	$db_data->where(RC_DB::raw('a.agent_parent_id'), $id);
    	 
    	$filter['keywords']	 = trim($_GET['keywords']);
    	 
    	if ($filter['keywords']) {
    		$db_data ->whereRaw('(a.agent_name  like  "%'.mysql_like_quote($filter['keywords']).'%"  or u.mobile_phone like "%'.mysql_like_quote($filter['keywords']).'%")');
    	}
    	 
    	$count = $db_data->count();
    	$page = new ecjia_page($count, 10, 5);
    
    	$data = $db_data
    	->select(RC_DB::raw('a.*'),RC_DB::raw('u.mobile_phone'), RC_DB::raw('u.user_name'))
    	->orderby(RC_DB::raw('a.add_time'), 'desc')
    	->take(10)
    	->skip($page->start_id-1)
    	->get();
    	$list = array();
    	if (!empty($data)) {
    		foreach ($data as $row) {
    			$row['add_time']  = RC_Time::local_date('Y-m-d H:i:s', $row['add_time']);
    			$row['store_num'] = RC_DB::TABLE('affiliate_store_record')->where('affiliate_store_id', $row['id'])->whereNotNull('store_id')->count();
    			$list[] = $row;
    		}
    	}
    	return array('list' => $list, 'filter' => $filter, 'page' => $page->show(5), 'desc' => $page->page_desc());
    }
    
    /**
     * 获取推广店铺列表数据
     */
    private function get_store_list($id, $type = '') {

    	$store_parent_list_arr = RC_DB::table('affiliate_store_record')->where('affiliate_store_id', $id)->whereNotNull('store_id')->lists('store_id');
    	$store_count['parent'] = RC_DB::table('store_franchisee')->whereIn('store_id', $store_parent_list_arr)->count();

    	
    	$agent_list_arr = RC_DB::table('affiliate_store')->where('agent_parent_id', $id)->lists('id');
    	$store_next_list_arr = RC_DB::table('affiliate_store_record')->whereIn('affiliate_store_id', $agent_list_arr)->whereNotNull('store_id')->lists('store_id');
    	$store_count['next'] = RC_DB::table('store_franchisee')->whereIn('store_id', $store_next_list_arr)->count();

    	$db_data = RC_DB::table('store_franchisee');
    	if(empty($type)){
    		$store_list_arr = RC_DB::table('affiliate_store_record')->where('affiliate_store_id', $id)->whereNotNull('store_id')->lists('store_id');
    		$db_data->whereIn('store_id', $store_list_arr);
    	} else {
    		$agent_list_arr = RC_DB::table('affiliate_store')->where('agent_parent_id', $id)->lists('id');
    		$store_list_arr = RC_DB::table('affiliate_store_record')->whereIn('affiliate_store_id', $agent_list_arr)->whereNotNull('store_id')->lists('store_id');
    		$db_data->whereIn('store_id', $store_list_arr);
    	}
    	
    	
    	$filter['keywords']	 = trim($_GET['keywords']);
    	if ($filter['keywords']) {
    		$db_data ->whereRaw('(merchants_name  like  "%'.mysql_like_quote($filter['keywords']).'%")');
    	}

    	$count = $db_data->count();
    	$page = new ecjia_page($count, 10, 5);
    	
    	$data = $db_data
    	->select(RC_DB::raw('store_id'),RC_DB::raw('cat_id'),RC_DB::raw('merchants_name'), RC_DB::raw('apply_time'))
    	->orderby(RC_DB::raw('apply_time'), 'desc')
    	->take(10)
    	->skip($page->start_id-1)
    	->get();
    	$list = array();
    	if (!empty($data)) {
    		foreach ($data as $row) {
    			$row['apply_time']  = RC_Time::local_date('Y-m-d H:i:s', $row['apply_time']);
    			$row['cat_name']    = RC_DB::TABLE('store_category')->where('cat_id', $row['cat_id'])->pluck('cat_name');
    			$list[] = $row;
    		}
    	}
    	return array('list' => $list, 'filter' => $filter, 'page' => $page->show(5), 'desc' => $page->page_desc(), 'count' => $store_count);
    }
}

// end
