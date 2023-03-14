<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Core_Vendor_Controller{

	function __construct(){

		parent::__construct();

		$this->load->model('vendor/Dashboard_model','dashboard');
	}

	function index(){

		$this->data['active'] = 'dashboard';

		$this->data['title'] = 'Dashboard';

		$views[] = 'vendor/dashboard';

		$this->vendor_view($views);
	}

}