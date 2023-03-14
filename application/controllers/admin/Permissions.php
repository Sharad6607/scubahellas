<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Permissions extends Core_Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data['error']="";
        $this->data['success']="";
        $this->load->model('admin/PermissionModel');
        if(!isset($this->session->userdata['userPermissions'])){
            $this->roles->getGoUserRoles();   
        }
        //$this->roles->getModuleNameByRole();

        $userPermissions            = $this->session->userdata['userPermissions'];
        $this->data['urlkey']       = $this->uri->segment(1);
    }
    
    public function index() {
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['subadmin'] = $this->roles->getRoles();
        $views[] = 'admin/permission';
        $this->admin_view($views);
    }

    public function getRolePermission($id){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $checkCount=0;
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() != false) {
                $data['name']       = $this->input->post('name');
                $role_id  = $this->PermissionModel->Update($id,$data,'tbl_role');
                $postData="insert into tbl_role_permission (role_id,module_id,permission_id) values";
                if(isset($_POST['view']) && count($this->input->post('view')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('view');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$val[0]."','".$val[1]."','".$val[2]."'),"; 
                    }
                } 
                if(isset($_POST['add']) && count($this->input->post('add')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('add');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$val[0]."','".$val[1]."','".$val[2]."'),"; 
                    }
                }
                if(isset($_POST['edit']) && count($this->input->post('edit')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('edit');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$val[0]."','".$val[1]."','".$val[2]."'),"; 
                    }
                }
                if(isset($_POST['delete']) && count($this->input->post('delete')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('delete');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$val[0]."','".$val[1]."','".$val[2]."'),"; 
                    }
                }
                    $this->PermissionModel->deleteRecord('tbl_role_permission',$this->input->post('role_id')); 
                if($checkCount ==1){ 
                    $postData = rtrim($postData, ','); 
                    $this->PermissionModel->customInsert($postData);
                }
                redirect('admin/permissions/getRolePermission/'.$this->input->post('role_id')); 
                $this->session->set_flashdata('success', "Permission details updated successfully.");
            }
        }
        $this->data['allModules'] = $this->roles->getModules();
        $this->data['subadmin_name_by_id'] = $this->roles->getRoles_by_id($id);
        $views[] = 'admin/edit_permission';
        $this->admin_view($views);
    }

    public function addRolePermission(){
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $checkCount=0;
            $this->form_validation->set_rules('name', 'Name', 'required');
            if ($this->form_validation->run() != false) {
                $data['name']       = $this->input->post('name');
                $data['parent_id']  = 0;
                $data['status']  = 1;
                $data['is_permissionable']  = 1;
                $data['added_by']  = $user['id'];

                $role_id  = $this->PermissionModel->insert('tbl_role',$data);

                $postData="insert into tbl_role_permission (role_id,module_id,permission_id) values";
                if(isset($_POST['view']) && count($this->input->post('view')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('view');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$role_id."','".$val[0]."','".$val[1]."'),"; 
                    }
                } 
                if(isset($_POST['add']) && count($this->input->post('add')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('add');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$role_id."','".$val[0]."','".$val[1]."'),"; 
                    }
                }
                if(isset($_POST['edit']) && count($this->input->post('edit')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('edit');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$role_id."','".$val[0]."','".$val[1]."'),"; 
                    }
                }
                if(isset($_POST['delete']) && count($this->input->post('delete')) > 0){
                    $checkCount=1;
                    $view = $this->input->post('delete');
                    foreach ($view as $key => $value) {
                        $val = explode(',', $value); 
                        $postData.= " ('".$role_id."','".$val[0]."','".$val[1]."'),"; 
                    }
                }
                    $this->PermissionModel->deleteRecord('tbl_role_permission',$this->input->post('role_id')); 
                if($checkCount ==1){ 

                    $postData = rtrim($postData, ','); 
                    $this->PermissionModel->customInsert($postData);
                }
                $this->session->set_flashdata('success', "Permission details added successfully.");
                redirect('admin/permissions'); 
            }
        }
      
        $this->data['allModules'] = $this->roles->getModules();
        $views[] = 'admin/add_permission';
        $this->admin_view($views);
    }
}
