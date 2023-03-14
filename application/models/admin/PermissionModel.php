<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionModel extends CI_Model{

	public function insert($tableName, $data){
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    public function deleteRecord($tablename,$id){
      $this->db-> where('role_id', $id);
      $this->db-> delete($tablename);
      return true;
    }
	public function customInsert($query){
        $data = $this->db->query($query);
    }
    public function Update($id, $data,$tablename){
        $this->db->where('id', $id);
        $this->db->update($tablename, $data);
        return true;
    }

}