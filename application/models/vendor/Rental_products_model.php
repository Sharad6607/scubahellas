<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_products_model extends CI_Model{

	public function getProductsByVendor($id){
        $query = $this->db->select('t1.product_name,t1.description,t1.product_image,t2.rental_price,t2.created_at,t2.status,t2.id');
        $this->db->from('tbl_rental_products t1');
        $this->db->join('tbl_vendor_rental_products t2', 't1.id = t2.product_id', 'RIGHT');
        $this->db->where('t2.vendor_id', $id);
        $query = $this->db->get();
		return $query->result();
    }
    
     public function get_product_by_vendor($id)
    {
        $query1 = $this->db->select('product_id');
        $this->db->from('tbl_vendor_rental_products');
        $this->db->where('vendor_id', $id);
        $query1 = $this->db->get();
        $result1 = $query1->result();
        $prod_ = [];
        foreach ($result1 as $key => $value) {
            array_push($prod_,$value->product_id);
        }
        $query = $this->db->select('t1.product_name,t1.description,t1.product_image,t1.mrp,t1.created_at,t1.status,t1.id');
        $this->db->from('tbl_rental_products t1');
        $this->db->where_not_in('t1.id', $prod_);
        $query = $this->db->get();
        $result =  $query->result();

        return $result;
    }

    public function get_product_by_vendor_edit($id,$edit_id)
    {
        $query1 = $this->db->select('product_id,id as rental_id');
        $this->db->from('tbl_vendor_rental_products');
        $this->db->where('vendor_id', $id);
        //$this->db->where('id!=',$edit_id);
        $query1 = $this->db->get();
        $result1 = $query1->result();
        $prod_ = [];
        foreach ($result1 as $key => $value) {
                if($value->rental_id  == $edit_id){
                    continue;
                }
            array_push($prod_,$value->product_id);
        }
        $query = $this->db->select('t1.product_name,t1.description,t1.product_image,t1.mrp,t1.created_at,t1.status,t1.id');
        $this->db->from('tbl_rental_products t1');
        $this->db->where_not_in('t1.id', $prod_);
        $query = $this->db->get();
        $result =  $query->result();

        return $result;
    }

    public function edit_products($id,$edit_id){
        $query = $this->db->select('t1.product_name,t1.description,t1.product_image,t2.rental_price,t2.created_at,t2.status,t2.product_id,t1.id,t2.stock');
        $this->db->from('tbl_rental_products t1');
        $this->db->join('tbl_vendor_rental_products t2', 't1.id = t2.product_id', 'inner');
        $this->db->where('t2.id', $edit_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteRecord($tablename,$id){
      $this->db-> where('id', $id);
      $this->db-> delete($tablename);
      return true;
    }
}