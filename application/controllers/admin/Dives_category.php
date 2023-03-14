<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dives_category extends Core_Admin_Controller {
    public $table = "tbl_dives_category";
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data['error']="";
        $this->data['success']="";
        $this->load->model('admin/PermissionModel');
        $this->load->model('admin/Subadmin_model');
        $this->load->model('admin/Login_model', 'admin');
        if(!isset($this->session->userdata['userPermissions'])){
            $this->roles->getGoUserRoles();   
        }
        
        $userPermissions            = $this->session->userdata['userPermissions'];
        $this->data['urlkey']       = $this->uri->segment(1);
    }
    
    public function index() {
        
        $this->data['active'] = 'manage-dives-category';
        $this->data['title'] = 'Dives Category';
        $this->data['dives_category'] = $this->Common_model->get_result($this->table,['status>='=> 0]);
        $views[] = 'admin/manage-dives-category/index';

        $this->admin_view($views);
    }

    public function add_dives() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('name', 'Dives Category Name', 'required');

            if ($this->form_validation->run() != false) {
                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image/dives-icon';
                    $config['allowed_types']        = 'jpg|png|GIF|gif|jpeg';
                    $config['max_size']             = 500000;
                    $config['file_name']            = time();
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file'))
                    {                        
                        $this->session->set_flashdata('error', "Image Not Uploaded.");
                    }
                    else
                    {
                        $path =  $this->upload->data();
                        $picture = $path['file_name'];
                        $data = [
                            "name" => $this->input->post('name'),
                            "status" => $this->input->post('status'),
                            'created_at' => date("Y-m-d H:i:s"),
                            "icon" => $picture
                        ];
                        
                        $this->PermissionModel->insert('tbl_dives_category',$data);
                        $this->session->set_flashdata('success', "Dives category details updated successfully.");
                        redirect('admin/manage-dives-category'); 
                    }
                }
                else
                {
                    $data = [
                            "name" => $this->input->post('name'),
                            "status" => $this->input->post('status'),
                            'created_at' => date("Y-m-d H:i:s"),
                            "icon" => $picture
                        ];
                    $this->PermissionModel->insert('tbl_dives_category',$data);
                    $this->session->set_flashdata('success', "Dives category details updated successfully.");
                    redirect('admin/manage-dives-category'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }

        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $views[] = 'admin/manage-dives-category/add';

        $this->admin_view($views);
    }

    public function edit_dives() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('name', 'Dives Category Name', 'required');
            if ($this->form_validation->run() != false) {
                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image/dives-icon';
                    $config['allowed_types']        = 'jpg|png|GIF|gif|jpeg';
                    $config['max_size']             = 500000;
                    $config['file_name']            = time();
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file'))
                    {                        
                        $this->session->set_flashdata('error', "Image Not Uploaded.");
                    }
                    else
                    {
                        $path =  $this->upload->data();
                        $picture = $path['file_name'];
                        $data = [
                            "name" => $this->input->post('name'),
                            "status" => $this->input->post('status'),
                            "icon" => $picture
                        ];
                        $id =$this->input->post('id');
                        
                        $this->PermissionModel->Update($id,$data,'tbl_dives_category');
                        $this->session->set_flashdata('success', "Dives category details updated successfully.");
                        redirect('admin/manage-dives-category'); 
                    }
                }
                else
                {
                        $data = [
                            "name" => $this->input->post('name'),
                            "status" => $this->input->post('status'),
                        ];
                    $id =$this->input->post('id');
                    
                    $this->PermissionModel->Update($id,$data,'tbl_dives_category');
                    $this->session->set_flashdata('success', "Dives category details updated successfully.");
                    redirect('admin/manage-dives-category'); 
                }
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['user'] = $this->Common_model->get_result($this->table,['id'=>$this->uri->segment(3)]);
        $views[] = 'admin/manage-dives-category/edit';

        $this->admin_view($views);
    }

    public function delete_dives() {

        $this->data['vendors'] = $this->Common_model->delete($this->table,['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Dives Center Deleted successfully.");
        redirect('admin/manage-dives-category'); 
    }

    
}
