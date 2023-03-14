<?php
class Common_model extends CI_Model{

	public function insert($table, $data)
	{
		$insert = $this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();
		return $insert?$insert_id:FALSE;
	}

	public function get_result($table, $where)
	{
		$query = $this->db->select("*")->where($where)->get($table);
		return $query->result();
	}

	public function update($data, $where, $table)
	{
		$update = $this->db->where($where)->update($table, $data);
		return $update?TRUE:FALSE;
	}

	public function delete($table, $data)
	{
		$delete = $this->db->delete($table, $data);
		return $delete?TRUE:FALSE;
	}

	public function count($table,$where)
	{
		$query = $this->db->select("id")->where($where)->get($table);
		$count = $query->num_rows();
		return $count;
	}
    
    public function get_result_array($data, $where, $table, $order = "DESC", $by = "id")
    {
        $query = $this->db->select($data)->where($where)->order_by($by , $order)->get($table);
        return $query->result_array();
    }
    
    public function get_row($data, $where, $table)
    {
        $query = $this->db->select($data)->where($where)->get($table);
        return $query->row_array();
    }

	public function row_array($data, $where, $table)
	{
		$query = $this->db->select($data)->where($where)->get($table);
		return $query->row_array();
	}

	public function result($data, $where, $table, $order = "DESC", $by = "id")
	{
		$query = $this->db->select($data)->where($where)->order_by($by , $order)->get($table);
		$result = $query->result();
		return $result;
	}
	
	public function row($data, $where, $table)
	{
		$query = $this->db->select($data)->where($where)->get($table);
		$result = $query->row();
		return $result;
	}

	public function customInsert($query)
    {
        $data = $this->db->query($query);
    }
	
}