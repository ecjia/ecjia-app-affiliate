<?php
defined('IN_ECJIA') or exit('No permission resources.');

class affiliate_shop_config_model extends Component_Model_Model {
	public $table_name = '';
	public function __construct() {
// 		$this->db_config = RC_Config::load_config('database');
// 		$this->db_setting = 'default';
		$this->table_name = 'shop_config';
		parent::__construct();
	}
    
	/*保存推荐设置*/
	public function put_affiliate($config) {
		$temp = serialize($config);
		$data = array(
			'value' => $temp
		);
		ecjia_config::instance()->clear_cache();
		return $this->where(array('code' => 'affiliate'))->update($data);
	}
}

// end