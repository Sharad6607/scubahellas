<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customers extends Core_Admin_Controller {
    public $table = "tbl_customer";
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
        
        $this->data['active'] = 'customers';
        $this->data['title'] = 'customers';
        $this->data['customers'] = $this->Common_model->get_result($this->table,['status>='=> 0]);
        $views[] = 'admin/customer/index';

        $this->admin_view($views);
    }

    public function add_customer() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'city', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            if ($this->form_validation->run() != false) {
                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image';
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
                            "first_name" => $this->input->post('first_name'),
                            "last_name" => $this->input->post('last_name'),
                            "email" => $this->input->post('email'),
                            "mobile" => $this->input->post('mobile'),
                            "status" => $this->input->post('status'),
                            "country" => $this->input->post('country'),
                            "state" => $this->input->post('state'),
                            "city" => $this->input->post('city'),
                            "address" => $this->input->post('address'),
                            "profile_pic" => $picture,
                            "password" => md5(trim($this->input->post('password'))),
                            'created_at' => date("Y-m-d H:i:s"),
                            "zip_code" => $this->input->post('zip_code'),
                            "gender" => $this->input->post('gender')
                        ];
                        
                        $this->PermissionModel->insert('tbl_customer',$data);
                        $this->session->set_flashdata('success', "Customer details updated successfully.");
                        redirect('admin/customers'); 
                    }
                }
                else
                {
                    $data = [
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "email" => $this->input->post('email'),
                        "mobile" => $this->input->post('mobile'),
                        "status" => $this->input->post('status'),
                        "country" => $this->input->post('country'),
                        "state" => $this->input->post('state'),
                        "city" => $this->input->post('city'),
                        "address" => $this->input->post('address'),
                        "password" => md5(trim($this->input->post('password'))),
                        'created_at' => date("Y-m-d H:i:s"),
                        "zip_code" => $this->input->post('zip_code'),
                        "gender" => $this->input->post('gender')
                    ];
                    $this->PermissionModel->insert('tbl_customer',$data);
                    $this->session->set_flashdata('success', "Customer details updated successfully.");
                    redirect('admin/customers'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['roles'] = $this->roles->getRoles();
        $views[] = 'admin/customer/add';

        $this->admin_view($views);
    }

    public function edit_customer() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('city', 'city', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            if ($this->form_validation->run() != false) {
                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image';
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
                            "first_name" => $this->input->post('first_name'),
                            "last_name" => $this->input->post('last_name'),
                            "email" => $this->input->post('email'),
                            "mobile" => $this->input->post('mobile'),
                            "status" => $this->input->post('status'),
                            "country" => $this->input->post('country'),
                            "state" => $this->input->post('state'),
                            "city" => $this->input->post('city'),
                            "address" => $this->input->post('address'),
                            "profile_pic" => $picture,
                            "zip_code" => $this->input->post('zip_code'),
                            "gender" => $this->input->post('gender')
                        ];
                        if(!empty($this->input->post('password'))){
                            $data['password'] = md5(trim($this->input->post('password')));
                        }
                        $id =$this->input->post('id');
                        
                        $this->PermissionModel->Update($id,$data,'tbl_customer');
                        $this->session->set_flashdata('success', "Customer details updated successfully.");
                        redirect('admin/customers'); 
                    }
                }
                else
                {
                    $data = [
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "email" => $this->input->post('email'),
                        "mobile" => $this->input->post('mobile'),
                        "status" => $this->input->post('status'),
                        "country" => $this->input->post('country'),
                        "state" => $this->input->post('state'),
                        "city" => $this->input->post('city'),
                        "address" => $this->input->post('address'),
                        "zip_code" => $this->input->post('zip_code'),
                        "gender" => $this->input->post('gender')
                    ];
                    if(!empty($this->input->post('password'))){
                            $data['password'] = md5(trim($this->input->post('password')));
                    }
                    $id =$this->input->post('id');
                    
                    $this->PermissionModel->Update($id,$data,'tbl_customer');
                    $this->session->set_flashdata('success', "Customer details updated successfully.");
                    redirect('admin/customers'); 
                }
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['user'] = $this->Common_model->get_result($this->table,['id'=>$this->uri->segment(3)]);
        $views[] = 'admin/customer/edit';

        $this->admin_view($views);
    }

    public function delete_customer() {

        $this->data['customers'] = $this->Common_model->delete($this->table,['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Customer Deleted successfully.");
        redirect('admin/customers'); 
    }

    public function change_status()
    {
        return $this->PermissionModel->Update($this->input->post('id'),['status' => $this->input->post('status')],'tbl_customer',);

        
    }

    
}
