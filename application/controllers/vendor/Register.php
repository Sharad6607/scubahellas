<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Register extends CI_Controller{



	function __construct(){

		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('admin/PermissionModel');

		if(!empty($user['id'])) redirect('vendor/dashboard');

	}

	function index(){

		$data['title'] = 'Scuba Hellas';
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
                            "status" => 0,
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
                        $this->session->set_flashdata('message', "You have successfully sign up.Wait for the admin verify.You will get confirmation email on your email address");
                        redirect('vendor/register'); 
                    }
                }
                else
                {
                    $data = [
                        "first_name" => $this->input->post('first_name'),
                        "last_name" => $this->input->post('last_name'),
                        "email" => $this->input->post('email'),
                        "mobile" => $this->input->post('mobile'),
                        "status" => 0,
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
                    $this->session->set_flashdata('message', "You have successfully sign up.Wait for the admin verify.You will get confirmation email on your email address");
                    redirect('vendor/register'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }

		$this->load->view('vendor/register', $data);

	}
}