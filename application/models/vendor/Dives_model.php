<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dives_model extends CI_Model{

	public function getCategoryDefaultById($id){
        $query = $this->db->select('t1.category_id,t1.country,t1.state,t1.city,t1.latitude,t1.longitude,t1.address,t2.created_at,t2.status,t2.id');
        $this->db->from('tbl_dives_center t1');
        $this->db->join('tbl_vendor_dives_location t2', 't1.id = t2.location_id', 'innder');
        $this->db->where('t2.vendor_id', $id);
        $query = $this->db->get();
		return $query->result();
    }
    public function getlocationById($id){
    	$query = $this->db->select('t1.category_id,t1.country,t1.state,t1.city,t1.latitude,t1.longitude,t1.address,t2.created_at,t1.status,t2.id,t2.location_id');
        $this->db->from('tbl_dives_center t1');
        $this->db->join('tbl_vendor_dives_location t2', 't1.id = t2.location_id', 'innder');
        $this->db->where('t2.id', $id);
        $query = $this->db->get();
		return $query->result();
    }

    public function getImageById($id){
        $this->db->select('id,image');
        $this->db->where('location_id', $id);
		$this->db->order_by("id", "ASC");
        $query = $this->db->get('tbl_vendor_dives_center_images');
        $result   = $query->result();
        return $result;
    }

    public function deleteRecord($tablename,$id){
      $this->db-> where('id', $id);
      $this->db-> delete($tablename);
      return true;
    }
}