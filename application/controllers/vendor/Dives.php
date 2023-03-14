<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dives extends Core_Vendor_Controller {
    public $table = "tbl_dives_center";
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data['error']="";
        $this->data['success']="";
        $this->load->model('admin/PermissionModel');
        $this->load->model('vendor/Dives_model');
        $this->data['urlkey'] = $this->uri->segment(1);
        $this->load->library('Uploadfiles');
    }
    
    public function index() {
        $user = $this->session->userdata('vendor_login_data');
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['center'] = $this->Dives_model->getCategoryDefaultById($user['id']);
        $views[] = 'vendor/manage-dives/index';

        $this->vendor_view($views);
    }

    public function add_dives() {
        $user = $this->session->userdata('vendor_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {
                $data = [
                    "vendor_id" => $user['id'],
                    "location_id" => $this->input->post('location_id'),
                    'created_at' => date("Y-m-d H:i:s"),
                    "status" => $this->input->post('status'),
                ];
                //print_r($data);die;
                $insert_id = $this->PermissionModel->insert("tbl_vendor_dives_location",$data);
                if($insert_id){
                    $vendor_id =$user['id'];
                    $location_id =$this->input->post('location_id');
                    $status = 1;
                    if (!empty($_FILES['file']['name'][0])) {
                        $response = $this->uploadfiles->do_uploadImage($_FILES['file'], 'file','dives_location_image');
                        if(count($response) > 0){
                            $query ="insert into tbl_vendor_dives_center_images (vendor_id,location_id,image,status) values";
                            foreach ($response as $key => $value) {
                                $query .="('$vendor_id','$insert_id','$value','$status'),";
                            }
                            $query = rtrim($query, ',');
                            $this->Common_model->customInsert($query);
                        }
                    }
                }
                $this->session->set_flashdata('success', "Dive Center details Added successfully.");
                redirect('vendor/manage-dives'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['dives_location'] = $this->Common_model->get_result("tbl_dives_center",['status>='=> 0]);
        $views[] = 'vendor/manage-dives/add';

        $this->vendor_view($views);
    }

    public function edit_dives() {
        $user = $this->session->userdata('vendor_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {
                $data = [
                    "location_id" => $this->input->post('location_id'),
                    "status" => $this->input->post('status'),
                ];
                $id =$this->input->post('id');
                $this->PermissionModel->Update($id,$data,'tbl_vendor_dives_location');
                $vendor_id =$user['id'];
                $status = 1;
                if (!empty($_FILES['file']['name'][0])) {
                    $response = $this->uploadfiles->do_uploadImage($_FILES['file'], 'file','dives_location_image');
                    //var_dump($response);die;
                    if(count($response) > 0){
                        $ids = $this->uri->segment(3);
                        $query ="insert into tbl_vendor_dives_center_images (vendor_id,location_id,image,status) values";
                        foreach ($response as $key => $value) {
                            $query .="('$vendor_id','$ids','$value','$status'),";
                        }
                        $query = rtrim($query, ',');
                        $this->Common_model->customInsert($query);
                    }
                }
                $this->session->set_flashdata('success', "Dive Center details Updated successfully.");
                redirect('vendor/manage-dives'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['dives_location'] = $this->Common_model->get_result("tbl_dives_center",['status>='=> 0]);
        $this->data['center'] = $this->Dives_model->getlocationById($this->uri->segment(3));
        $views[] = 'vendor/manage-dives/edit';
        $this->vendor_view($views);
    }

    public function delete_dives() {

        $this->data['vendors'] = $this->Common_model->delete('tbl_vendor_dives_location',['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Dives Center Deleted successfully.");
        redirect('vendor/manage-dives'); 
    }

    public function deleteImage($id){

      $this->Dives_model->deleteRecord('tbl_vendor_dives_center_images',$id);
      echo 1;
    }

    public function change_status()
    {
        return $this->PermissionModel->Update($this->input->post('id'),['status' => $this->input->post('status')],'tbl_vendor_dives_location',);

        
    }




    
}
