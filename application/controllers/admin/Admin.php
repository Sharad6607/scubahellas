<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Admin extends Core_Admin_Controller{



	function __construct(){

		parent::__construct();

		$this->load->model('admin/Login_model', 'admin');
		$this->load->model('admin/PermissionModel');
		$this->load->library('form_validation');

	}



	function profile(){
		$user = $this->session->userdata('admin_login_data');
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id =$this->input->post('id');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required');
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
                            "profile_pic" => $picture
                        ];
                        
                        $this->PermissionModel->Update($id,$data,'tbl_admin');
                        $this->session->set_flashdata('success', "Admin Profile details updated successfully.");
                        redirect('admin/profile'); 
                    }
                }
                else
                {
                    $data = [
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "email" => $this->input->post('email'),
                        "mobile" => $this->input->post('mobile')
                    ];
                    $this->PermissionModel->Update($id,$data,'tbl_admin');
                    $this->session->set_flashdata('success', "Admin Profile details updated successfully.");
                    redirect('admin/profile'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

		$this->data['active'] = 'dashboard';

		$this->data['title'] = 'Dashboard';

		$this->data['user'] = $this->admin->get_admin_member_data($user['id']);

		$views[] = 'admin/profile';

		$this->admin_view($views);		

	}

}