<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rental_products extends Core_Vendor_Controller {
    public $table = "tbl_dives_center";
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data['error']="";
        $this->data['success']="";
        $this->load->model('admin/PermissionModel');
        $this->load->model('vendor/Rental_products_model');
        $this->data['urlkey'] = $this->uri->segment(1);
        $this->load->library('Uploadfiles');
    }
    
    public function index() {
        $user = $this->session->userdata('vendor_login_data');
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['products'] = $this->Rental_products_model->getProductsByVendor($user['id']);
        $views[] = 'vendor/products/index';

        $this->vendor_view($views);
    }

    public function add_products() {
        $user = $this->session->userdata('vendor_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('rental_price', 'Rental Price', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {
                $data = [
                    "product_id" => $this->input->post('product_id'),
                    'status' => $this->input->post('status'),
                    "rental_price" => $this->input->post('rental_price'),
                    'created_at' => date("Y-m-d H:i:s"),
                    'stock' => $this->input->post('stock'),
                    'vendor_id' => $user['id']
                ];
                //print_r($data);die;
                $this->PermissionModel->insert('tbl_vendor_rental_products',$data);
                $this->session->set_flashdata('success', "Products details updated successfully.");
                redirect('vendor/rental-products');
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['get_products'] = $this->Rental_products_model->get_product_by_vendor($user['id']);
        $views[] = 'vendor/products/add';

        $this->vendor_view($views);
    }

    public function edit_products() {
        $user = $this->session->userdata('vendor_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('rental_price', 'Rental Price', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {

                $data = [
                    "product_id" => $this->input->post('product_id'),
                    'status' => $this->input->post('status'),
                    "rental_price" => $this->input->post('rental_price'),
                    'stock' => $this->input->post('stock'),
                    'vendor_id' => $user['id']
                ];
                $id =$this->input->post('id');
                
                $this->PermissionModel->Update($id,$data,'tbl_vendor_rental_products');
                $this->session->set_flashdata('success', "Products details updated successfully.");
                redirect('vendor/rental-products'); 
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['products'] = $this->Rental_products_model->edit_products($user['id'],$this->uri->segment(3));

        //print_r($this->data['products']);die;
        $this->data['get_products'] = $this->Rental_products_model->get_product_by_vendor_edit($user['id'],$this->uri->segment(3));
        $views[] = 'vendor/products/edit';

        $this->vendor_view($views);
    }

    public function delete_products() {

        $this->data['products'] = $this->Common_model->delete('tbl_vendor_rental_products',['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Products Deleted successfully.");
        redirect('vendor/rental-products'); 
    }

    public function change_status()
    {
        return $this->PermissionModel->Update($this->input->post('id'),['status' => $this->input->post('status')],'tbl_vendor_rental_products',);

        
    }




    
}
