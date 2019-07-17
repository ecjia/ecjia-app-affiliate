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
 * 后台VIP分销权益
 * @author songqianqian
 */
class admin_distribution_grade extends ecjia_admin {
	public function __construct() {
		parent::__construct();
		
		RC_Loader::load_app_func('admin_category', 'goods');
		RC_Loader::load_app_func('admin_user', 'user');
		
		/* 加载所需js */
		RC_Script::enqueue_script('smoke');
		RC_Script::enqueue_script('jquery-validate');
		RC_Script::enqueue_script('jquery-form');
		RC_Script::enqueue_script('jquery-uniform');
		RC_Script::enqueue_script('jquery-chosen');
		RC_Style::enqueue_style('uniform-aristo');
		RC_Style::enqueue_style('chosen');
		RC_Script::enqueue_script('bootstrap-placeholder', RC_Uri::admin_url('statics/lib/dropper-upload/bootstrap-placeholder.js'), array(), false, true);
		RC_Style::enqueue_style('bootstrap-editable', RC_Uri::admin_url('statics/lib/x-editable/bootstrap-editable/css/bootstrap-editable.css'));
		RC_Script::enqueue_script('bootstrap-editable.min', RC_Uri::admin_url('statics/lib/x-editable/bootstrap-editable/js/bootstrap-editable.min.js'));
		
		RC_Style::enqueue_style('affiliate', RC_App::apps_url('statics/css/affiliate.css', __FILE__), array());
		
		RC_Script::enqueue_script('admin_distribution_grade', RC_App::apps_url('statics/js/admin_distribution_grade.js', __FILE__), array(), false, 1);
		RC_Script::localize_script('admin_distribution_grade', 'js_lang', config('app-affiliate::jslang.affiliate_page'));
	}
	
	/**
	 * VIP分销权益
	 */
	public function init() {
		$this->admin_priv('distribution_grade_manage');
		
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('VIP分销权益', 'affiliate')));
		$this->assign('ur_here', __('VIP分销权益', 'affiliate'));
		
		$this->assign('action_link', array('text' => __('分销商权益', 'article'), 'href'=> RC_Uri::url('affiliate/admin_distribution_grade/add')));

		$data = $this->get_grade_list();
		$this->assign('data', $data);
		
        return $this->display('distribution_grade_list.dwt');
	}
	
	/**
	 * VIP分销权益添加
	 */
	public function add() {
		$this->admin_priv('distribution_grade_update');
		
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('添加分销权益', 'affiliate')));
		
		$this->assign('ur_here', __('添加分销权益', 'affiliate'));
		$this->assign('action_link', array('href' =>RC_Uri::url('affiliate/admin_distribution_grade/init'), 'text' => __('分销商权益列表', 'affiliate')));
		
		$data['limit_days'] = 1;
		$data['sort_order'] = 10;
		$this->assign('data', $data);
		
		$this->assign('special_ranks', get_user_rank_list(true));
		
		$this->assign('cat_list', RC_Api::api('goods', 'get_goods_category'));
		
		$this->assign('form_action', RC_Uri::url('affiliate/admin_distribution_grade/insert'));
		
        return $this->display('distribution_grade_info.dwt');
	}
	
	/**
	 * VIP分销权益添加处理
	 */
	public function insert() {
		$this->admin_priv('distribution_grade_update');
		
		$grade_name = !empty($_POST['grade_name'])      ? trim($_POST['grade_name'])            : '';
		$user_rank  = !empty($_POST['user_rank'])       ? intval($_POST['user_rank']) 		    : 0;
		$goods_id   = !empty($_POST['goods_id'])        ? intval($_POST['goods_id'])            : 0;
		$limit_days = !empty($_POST['limit_days'])      ? intval($_POST['limit_days'])          : 1;
		$sort_order = !empty($_POST['sort_order'])      ? intval($_POST['sort_order'])          : 10;
		$user_card_intro    = !empty($_POST['user_card_intro'])     ? trim($_POST['user_card_intro'])   : '';
		$grade_intro   		= !empty($_POST['grade_intro'])         ? trim($_POST['grade_intro'])       : '';
	
		
		if (RC_DB::table('affiliate_grade')->where('grade_name', $grade_name)->count() > 0) {
			return $this->showmessage(sprintf(__('权益名称 %s 已经存在。', 'affiliate'), $grade_name), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
		if (empty($goods_id)) {
			return $this->showmessage(__('请先指定商品', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
		$data = array(
			'grade_name'   	  => $grade_name,
			'user_rank'    	  => $user_rank,
			'goods_id'     	  => $goods_id,
			'limit_days'   	  => $limit_days,
			'user_card_intro' => $user_card_intro,
			'grade_intro'  	  => $grade_intro,
			'sort_order'  	  => $sort_order,
			'add_time'     	  => RC_Time::gmtime(),
		);
			
		$grade_id = RC_DB::table('affiliate_grade')->insertGetId($data);
		
		$pjaxurl = RC_Uri::url('affiliate/admin_distribution_grade/edit', array('grade_id' => $grade_id));
		if($grade_id) {
			return $this->showmessage(__('分销权益添加成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array(pjaxurl => $pjaxurl));
		} else {
			return $this->showmessage(__('分销权益添加失败', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
	}
	
	/**
	 * 编辑VIP分销权益
	 */
	public function edit() {
		$this->admin_priv('distribution_grade_update');
		
		ecjia_screen::get_current_screen()->add_nav_here(new admin_nav_here(__('编辑分销权益', 'affiliate')));
		
		$this->assign('ur_here', __('编辑分销权益', 'affiliate'));
		$this->assign('action_link', array('href' =>RC_Uri::url('affiliate/admin_distribution_grade/init'), 'text' => __('分销权益列表', 'affiliate')));
		
		$grade_id = intval($_GET['grade_id']);
		$data = RC_DB::table('affiliate_grade')->where('grade_id', $grade_id)->first();
		$this->assign('data', $data);
		
		$goods = RC_DB::table('goods')->where('goods_id', $data['goods_id'])->first();
		$goods['goods_thumb']           = !empty($goods['goods_thumb']) && file_exists(RC_Upload::upload_path($goods['goods_thumb'])) ? RC_Upload::upload_url($goods['goods_thumb']) : RC_Uri::admin_url('statics/images/nopic.png');
		$goods['formated_shop_price']   = ecjia_price_format($goods['shop_price']);
		$goods['formated_market_price'] = ecjia_price_format($goods['market_price']);
		$goods['formated_cost_price'] 	= ecjia_price_format($goods['cost_price']);
		$this->assign('goods', $goods);
		
		$this->assign('special_ranks', get_user_rank_list(true));
		
		$this->assign('form_action', RC_Uri::url('affiliate/admin_distribution_grade/update'));
		
        return $this->display('distribution_grade_info.dwt');
	}
	
	
	/**
	 *  编辑VIP分销权益处理
	 */
	public function update() {
		$this->admin_priv('distribution_grade_update');
		
		$grade_id   = !empty($_POST['grade_id'])       	? intval($_POST['grade_id'])           	: 0;
		$grade_name = !empty($_POST['grade_name'])      ? trim($_POST['grade_name'])            : '';
		$user_rank  = !empty($_POST['user_rank'])       ? intval($_POST['user_rank']) 		    : 0;
		$goods_id   = !empty($_POST['goods_id'])        ? intval($_POST['goods_id'])            : 0;
		$limit_days = !empty($_POST['limit_days'])      ? intval($_POST['limit_days'])          : 1;
		$sort_order = !empty($_POST['sort_order'])      ? intval($_POST['sort_order'])          : 10;
		$user_card_intro    = !empty($_POST['user_card_intro'])     ? trim($_POST['user_card_intro'])   : '';
		$grade_intro   		= !empty($_POST['grade_intro'])         ? trim($_POST['grade_intro'])       : '';
		
		if (RC_DB::table('affiliate_grade')->where('grade_id', '!=', $grade_id)->where('grade_name', $grade_name)->count() > 0) {
			return $this->showmessage(sprintf(__('权益名称 %s 已经存在。', 'affiliate'), $grade_name), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
		if (empty($goods_id)) {
			return $this->showmessage(__('请先指定商品', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
		
		$data = array(
			'grade_name'   	  => $grade_name,
			'user_rank'    	  => $user_rank,
			'goods_id'     	  => $goods_id,
			'limit_days'   	  => $limit_days,
			'user_card_intro' => $user_card_intro,
			'grade_intro'  	  => $grade_intro,
			'sort_order'  	  => $sort_order,
			'add_time'     	  => RC_Time::gmtime(),
		);
			
		RC_DB::table('affiliate_grade')->where('grade_id', $grade_id)->update($data);
		
		$pjaxurl = RC_Uri::url('affiliate/admin_distribution_grade/edit', array('grade_id' => $grade_id));
		if($grade_id) {
			return $this->showmessage(__('分销权益编辑成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array(pjaxurl => $pjaxurl));
		} else {
			return $this->showmessage(__('分销权益编辑失败', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_ERROR);
		}
	}

	/**
	 * 删除VIP分销权益
	 */
	public function remove() {
		$this->admin_priv('distribution_grade_delete');
		
		$grade_id = intval($_GET['grade_id']);
		RC_DB::table('affiliate_grade')->where('grade_id', $grade_id)->delete();
		return $this->showmessage(__('删除分销权益成功', 'affiliate'), ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS);
	}	
	
	/**
	 * 添加/编辑页搜索商品
	 */
	public function search_goods() {
		$cat_id = intval($_POST['cat_id']);
		$goods_keywords  = remove_xss($_POST['goods_keywords']);
		$goods_sn        = remove_xss($_POST['goods_sn']);
	
		$db_goods = RC_DB::table('goods as g');
	
		if (!empty($cat_id)) {
			$where = get_children($cat_id);
			$db_goods->whereRaw($where);
		}
		if (!empty($goods_keywords)) {
			$db_goods->where(RC_DB::raw('goods_name'), 'like', '%' . mysql_like_quote($goods_keywords) . '%');
		}
	
		if (!empty($goods_sn)) {
			$db_goods->where(RC_DB::raw('goods_sn'), 'like', '%' . mysql_like_quote($goods_sn) . '%');
		}
	
		$goods_list = $db_goods
		->select(RC_DB::raw('goods_id, goods_name'))
		->where(RC_DB::raw('is_delete'), 0)
		->orderBy(RC_DB::raw('sort_order'), 'asc')
		->orderBy('goods_id', 'desc')
		->take(50)
		->get();
		
		return $this->showmessage('', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('content' => $goods_list));
	}
	
	public function get_goods_info() {
		$goods_id = intval($_POST['goods_id']);
		
		$goods = RC_DB::table('goods')->where('goods_id', $goods_id)->first();
		$goods['goods_thumb']           = !empty($goods['goods_thumb']) && file_exists(RC_Upload::upload_path($goods['goods_thumb'])) ? RC_Upload::upload_url($goods['goods_thumb']) : RC_Uri::admin_url('statics/images/nopic.png');
		$goods['formated_shop_price']   = ecjia_price_format($goods['shop_price']);
		$goods['formated_market_price'] = ecjia_price_format($goods['market_price']);
		$goods['formated_cost_price'] 	= ecjia_price_format($goods['cost_price']);
		$this->assign('goods', $goods);
		
		$type = remove_xss($_POST['type']);
		if ($type == 'add') {
			$content = $this->fetch('library/goods.lbi');
		} else {
			$content = $this->fetch('library/goods_info.lbi');
		}
		
		return $this->showmessage('', ecjia::MSGTYPE_JSON | ecjia::MSGSTAT_SUCCESS, array('content' => $content));
	}

	/**
	 * 获取权益列表
	 */
	private function get_grade_list() {
		$db_grade = RC_DB::table('affiliate_grade as ag')
		->leftJoin('user_rank as ur', RC_DB::raw('ag.user_rank'), '=', RC_DB::raw('ur.rank_id'));
		
		$count = $db_grade->count();
		$page = new ecjia_page($count, 10, 5);
		
		$data = $db_grade
		->select(RC_DB::raw('ag.grade_id'), RC_DB::raw('ag.grade_name'), RC_DB::raw('ag.limit_days'), RC_DB::raw('ur.rank_name'))
		->orderby(RC_DB::raw('ag.grade_id'), 'desc')
		->take(10)
		->skip($page->start_id-1)
		->get();
		
		$list = array();
		if (!empty($data)) {
			foreach ($data as $row) {
				$row['add_time']  		   = RC_Time::local_date('Y-m-d H:i:s', $row['add_time']);
				$row['distributor_count']  = RC_DB::table('affiliate_distributor')->where('grade_id', $row['grade_id'])->count();
				$list[] = $row;
			}
		}
		return array('list' => $list, 'page' => $page->show(5), 'desc' => $page->page_desc());
	}
}

//end