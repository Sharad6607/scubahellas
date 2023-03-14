<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller{



	function __construct(){

		parent::__construct();

		$this->load->model('vendor/Login_model', 'login');

		$user = $this->session->userdata('vendor_login_data');

		if(!empty($user['id'])) redirect('vendor/dashboard');

	}



	function index(){

		$data['title'] = 'Scuba Hellas';

		$data['captcha'] = get_capctha('ogpm_login_captcha');

		$this->load->view('vendor/login', $data);

	}



	function auth(){

		$post = $this->input->post();

		if(empty($post['email'])) redirect('vendor/login');

		$captcha = $this->session->userdata('ogpm_login_captcha');

		if(empty($post['captcha_code']) || $post['captcha_code']!=$captcha){

			$this->session->set_flashdata('message', '<div class="alert alert-danger text-center"><b>Invalid Captcha Code</b></div>');

			redirect('vendor/login');

		}

		$response = $this->login->auth($post);

		if(empty($response['user'])){

			$this->session->set_flashdata('message', '<div class="alert alert-hide alert-danger text-center"><b>'.$response['message'].'</b></div>');

			redirect('vendor/login');

		} else{

			$user = $response['user'];

		}

		unset($user['password']);

		$user['login_log_id'] = $response['log_id'];

		$this->session->set_flashdata('message', '<div class="alert alert-hide alert-success"><b>Login Successfully...</b></div>');

		$this->session->set_userdata('vendor_login_data', $user);

		redirect('vendor/dashboard');

	}

}