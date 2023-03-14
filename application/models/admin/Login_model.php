<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

	function auth($post){
		$this->db->select()->from('tbl_admin');
		$this->db->where('email', trim($post['email']));
		$user_ = $this->db->get()->row_array();
		if(empty($user_)) return array('message' => 'Username is not valid!'); 

		$this->db->select()->from('tbl_admin');
		$this->db->where('id', $user_['id']);
		$this->db->where('password', md5(trim($post['password'])));
		$user = $this->db->get()->row_array();
		if(!empty($user) && $user['status']!=1) return array('message'=>'Your account is blocked!');

		if(empty($user)){
			$data = array(
				'member_id' => $user_['id'],
				'ip_value' => $this->input->ip_address()
			);
			$this->db->insert('tbl_admin_member_invalid_log', $data);
			$record = get_table_data('tbl_admin_member_invalid_log', array('member_id' => $user_['id']));
			if(count($record) >= 3 && $user_['status']==1){
				$this->db->where('id', $user_['id']);
				$this->db->update('tbl_admin', array('status' => 0));
				return array('message' => 'Now your account is blocked!'); // if user attempt 3 invalid password block account
			}
			return array('message' => 'Password is not valid!'); // If password is incorrect
		} else{
			$this->db->where('member_id', $user['id']);
			$this->db->delete('tbl_admin_member_invalid_log');
			$data = array(
				'member_id' => $user['id']
			);
			$this->db->insert('tbl_admin_member_login_log', $data);
			$log_id = $this->db->insert_id();
			return array('message' => 'Login successfull!', 'user' => $user, 'log_id' => $log_id);
		}
	}

	function get_admin_member_data($member_id){
		$this->db->select()->from('tbl_admin');
		$this->db->where('id',$member_id);
		$query = $this->db->get();
		return $query->row_array();
	}
}