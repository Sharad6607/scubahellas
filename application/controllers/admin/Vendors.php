<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendors extends Core_Admin_Controller {
    public $table = "tbl_vendors";
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
        
        $this->data['active'] = 'vendors';
        $this->data['title'] = 'vendors';
        $this->data['vendors'] = $this->Common_model->get_result($this->table,['status>='=> 0]);
        $views[] = 'admin/vendor/index';

        $this->admin_view($views);
    }

    public function add_vendor() {
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
                        
                        $this->PermissionModel->insert('tbl_vendors',$data);
                        $this->session->set_flashdata('success', "Vendors detail updated successfully.");
                        redirect('admin/vendors'); 
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
                    $this->PermissionModel->insert('tbl_vendors',$data);
                    $this->session->set_flashdata('success', "Vendors details updated successfully.");
                    redirect('admin/vendors'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['roles'] = $this->roles->getRoles();
        $views[] = 'admin/vendor/add';

        $this->admin_view($views);
    }

    public function edit_vendor() {
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
                        
                        $this->PermissionModel->Update($id,$data,'tbl_vendors');
                        $this->session->set_flashdata('success', "Vendors details updated successfully.");
                        redirect('admin/vendors'); 
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
                    
                    $this->PermissionModel->Update($id,$data,'tbl_vendors');
                    $this->session->set_flashdata('success', "Vendors details updated successfully.");
                    redirect('admin/vendors'); 
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
        $views[] = 'admin/vendor/edit';

        $this->admin_view($views);
    }

    public function delete_vendor() {

        $this->data['vendors'] = $this->Common_model->delete($this->table,['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Vendor Deleted successfully.");
        redirect('admin/vendors'); 
    }

    public function change_status()
    {
        $where = array();
        $where['id'] = $this->input->post('id');
        $data = array('status' => $this->input->post('status'),'email'=> $this->input->post('email'));
        $mail_data['email'] = $this->input->post('email');
        $subject = "Confirmation Email for Vendor Account Activation";
        $message = $this->load->view('backend/mailer/vendor-account-activation', $mail_data, true);
        send_mail($this->input->post('email'), $subject, $message);
        return $this->PermissionModel->Update($this->input->post('id'),['status' => $this->input->post('status')],'tbl_vendors',);

        
    }

    
}
