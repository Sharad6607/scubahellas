<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends Core_Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->data['error']="";
        $this->data['success']="";
        $this->load->model('admin/PermissionModel');
        $this->load->model('admin/Booking_model');
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
        $this->data['subadmin'] = $this->Booking_model->getsubadmin();
        $views[] = 'admin/booking/index';

        $this->admin_view($views);
    }

    
}
