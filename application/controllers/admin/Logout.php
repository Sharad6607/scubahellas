<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Core_Admin_Controller{

	function __construct(){
		parent::__construct();
	}

	function index(){
		
		$session = $this->session->userdata('admin_login_data');
		$this->db->where('log_id', $session['login_log_id']);
		$this->db->update('tbl_admin_member_login_log', array('logout_time'=>date('Y-m-d H:i:s')));
		$this->session->unset_userdata('admin_login_data');
		$this->session->unset_userdata('userModule');
		redirect(ADMIN_PATH);
	}
}