<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subadmin extends Core_Admin_Controller {
    
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
        
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['subadmin'] = $this->Subadmin_model->getsubadmin();
        $views[] = 'admin/subadmin/index';

        $this->admin_view($views);
    }

    public function add_subadmin() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() != false) {
                $id =$this->input->post('id');
                $data = [
                    "role_id" => $this->input->post('role_id'),
                    "first_name" => $this->input->post('first_name'),
                    "last_name" => $this->input->post('last_name'),
                    "email" => $this->input->post('email'),
                    "mobile" => $this->input->post('mobile'),
                    "password" => md5(trim($this->input->post('password'))),
                    "parent_id" => 0,
                    "status" => 1,
                    'profile_pic'=> "dummy.jpg",
                    'type'=> "sub-admin"  
                ];
                $this->PermissionModel->insert('tbl_admin',$data);
                $this->session->set_flashdata('success', "Subadmin details Added successfully.");
                redirect('admin/manage-subadmin'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['roles'] = $this->roles->getRoles();
        $views[] = 'admin/subadmin/add';

        $this->admin_view($views);
    }

    public function edit_subadmin() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('status', 'Statis', 'required');
            if ($this->form_validation->run() != false) {
                $id =$this->input->post('id');
                $data = [
                    "role_id" => $this->input->post('role_id'),
                    "first_name" => $this->input->post('first_name'),
                    "last_name" => $this->input->post('last_name'),
                    "email" => $this->input->post('email'),
                    "mobile" => $this->input->post('mobile'),
                    "status" => $this->input->post('status')
                ];
                $this->PermissionModel->Update($id,$data,'tbl_admin');
                $this->session->set_flashdata('success', "Subadmin details updated successfully.");
                redirect('admin/manage-subadmin'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['roles'] = $this->roles->getRoles();
        $this->data['user'] = $this->admin->get_admin_member_data($this->uri->segment(3));
        $views[] = 'admin/subadmin/edit';

        $this->admin_view($views);
    }

    public function delete_subadmin() {

        $this->data['vendors'] = $this->Common_model->delete('tbl_admin',['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Subadmin Deleted successfully.");
        redirect('admin/manage-subadmin'); 
    }

    
}
