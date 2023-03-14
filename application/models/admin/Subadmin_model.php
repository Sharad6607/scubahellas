<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subadmin_model extends CI_Model{

	function getsubadmin(){
		$this->db->select('t1.*,t2.name');
		$this->db->from('tbl_admin t1');
		$this->db->join('tbl_role t2', 't1.role_id = t2.id');
		$this->db->where('t1.role_id >',0);
		$query = $this->db->get();
		return $query->result();
	}

}