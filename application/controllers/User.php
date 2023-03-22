<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends Core_front_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('front/Customer_model', 'customer');
	}
	
	function send_message($Phno,$Msg,$Password,$SenderID,$UserID,$EntityID,$TemplateID){         
        $ch='';
        $url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
    function verify_otp(){
        $mobile = $this->input->post('mobile');
        $otp = $this->input->post('otp');
    	$motp = $this->session->userdata("login_otp");
    	if($otp==$motp){
	        $check = get_table_value('tbl_customer', array('mobile' => $mobile));
			$this->session->set_userdata('user_data', $check);
			echo 'Success'; die;
    	}else{
    	    echo 'Invalid'; die;
    	}
    }
    
    function send_otp(){
        $post = $this->input->post();
        $check = get_table_value('tbl_customer', array('mobile' => $post['mobile']));
    	if(empty($check)){
    		echo 'Invalid####ok'; die;
    	}
    	else {
		    $otp = rand(100000, 999999);
		    $this->session->set_userdata("login_otp", $otp);
			$Phno=$post['mobile'];
            $Msg = "Use the OTP $otp to verify your contact number and login to Scuba Hellas account. OTP is valid for 15 minutes";
            $Password='';
            $SenderID='';
            $UserID='';
            $EntityID='';
            $TemplateID='';
            
            $ch='';
            $url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    		$output=curl_exec($ch);
            curl_close($ch);
            echo "Success####$otp";
		}
    }

	function login(){
    
    	$post = $this->input->post();
    	$check = get_table_value('tbl_customer', array('email' => $post['email'], 'password' => md5($post['password'])));
		if(empty($check)){
				$check2 = get_table_value('tbl_customer', array('mobile' => $post['email'], 'password' => md5($post['password'])));
				if(empty($check2)){
					echo 'error####Invalid Email Address Or Password'; die;
				} else {
					$this->session->set_userdata('user_data', $check2);
					echo 'success####Successfully Login'; die;
					
				}			
			} else {
				$this->session->set_userdata('user_data', $check);
				echo 'success####Successfully Login'; die;
				
			}
		
	}


	
 	function logout(){
		$this->session->unset_userdata('user_data');
		redirect(FRONT_PATH);
	}
	
	function registration(){
		$post = $this->input->post();
		$check = get_table_value('tbl_customer', array('email' => $post['email']));
		if(!empty($check) && $check['email_varified'] == 1){
			echo 'error####Email Already exists'; die;
		}

		if(!empty($check) && $check['email_varified'] == 0){
			$token = token();
			$data = array(
				'email_varify_link' => $token
			);
			$this->db->where('id', $check['id']);
			$this->db->update('tbl_customer', $data);

			$mail_data['token'] = $token;
			$subject = "Activate account with Scuba Hellas";
			$message = $this->load->view('front/mailer/customer-registration', $mail_data, true);
			send_mail($post['email'], $subject, $message);
			echo 'error####Email Already exists. An email with varification link sent to your Email ID.'; die;
		}

		if(empty($check)){
			$token = token();
			$data = array(
				'name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'mobile' => $post['mobile'],
				'email' => $post['email'],
				'password' => md5($post['password']),
				'email_varify_link' => $token,
				'email_varified' => 1,
				'plan_id' =>1
			);
			$this->db->insert('tbl_customer', $data);

			$mail_data['token'] = $token;
			$subject = "Successfully Registered with Scuba Hellas";
			$message = $this->load->view('front/mailer/customer-registration', $mail_data, true);
			send_mail($post['email'], $subject, $message);
			
			echo 'success####Successfully Registered. A confirmation email is sent to your Email ID.'; die;
		}
	}

	function forgot_password(){
		$post = $this->input->post();
		if($post){
			$check = get_table_value('tbl_customer', array('email' => $post['email']));
			if(empty($check)){
				echo 'error####Invalid Email ID'; die;
			} else {
				$token = token();
				$data = array(
					'forgot_password_link' => $token
				);
				$this->db->where('id', $check['id']);
				$this->db->update('tbl_customer', $data);
				
				$headers =  "From: info@scubahellas.com\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				$mail_data['token'] = $token;
				$subject = "Reset Password Link";
				$message = $this->load->view('front/mailer/customer-reset-password', $mail_data, true);
				$test = send_mail($post['email'], $subject, $message);
				error_log(print_r('Gmail '.$test,true));
				mail($post['email'], $subject, $message, $headers);
				echo 'success####Reset password link sent to your Email ID.'; die;
			}
		} else {
			$views[] = 'front/forgot-password';
			$this->front_view($views,false);
		}		
	}
	


    function forget(){

		$post = $this->input->post();

		$check = get_table_value('tbl_customer', array('email' => $post['email']));

		if(empty($check)){

			echo 'error####Invalid Email ID'; die;

		} else {

			$token = token();

			$data = array(

				'forgot_password_link' => $token

			);

			$this->db->where('id', $check['id']);

			$this->db->update('tbl_customer', $data);



			$mail_data['token'] = $token;

			$subject = "Reset Password Link";

			$message = $this->load->view('front/mailer/customer-reset-password', $mail_data, true);

			send_mail($post['email'], $subject, $message);

			echo 'error####Reset password link sent to your Email ID.'; die;

		}

	}


	
	function profile(){

		$user_data = $this->data['user_data'];

		if(empty($user_data)){ redirect(FRONT_PATH); }

		$this->data['user'] = get_table_value('tbl_customer', array('id' => $user_data['id']));
		$this->data['active'] = 'profile';

		$views[] = 'front/my-profile';

		$this->front_view($views,false);

	}
	function edit_profile(){
		$user_data = $this->data['user_data'];
		if(empty($user_data)){ redirect(FRONT_PATH); }
		$post = $this->input->post();
		if($post){
			$update = array(
				'name' => $post['name'],
				'last_name' => $post['last_name'],
				'mobile' => $post['mobile'],
				'email' => $post['email'],
			);
			$this->db->where('id', $user_data['id']);
			$this->db->update('tbl_customer', $update);
			echo 'success####Successfully Updated'; die;
		} else {
			$this->data['user'] = get_table_value('tbl_customer', array('id' => $user_data['id']));
			$this->data['active'] = 'profile';
			$views[] = 'front/edit-user-profile';
			$this->front_view($views,false);
		}
	}

	function change_password(){

		$user_data = $this->data['user_data'];

		if(empty($user_data)){ redirect(FRONT_PATH); }

		$post = $this->input->post();

		if($post){
		    if($post['new_password']==$post['confirm_password']){
    
    			$check = get_table_value('tbl_customer', array('email' => $user_data['email'], 'password' => md5($post['current_password'])));
    
    			if(empty($check)){ echo 'error####Current Password is Incorrect'; die; }
    
    			$update = array(
    
    				'password' => md5($post['new_password']),
    
    			);
    
    			$this->db->where('id', $user_data['id']);
    
    			$this->db->update('tbl_customer', $update);
    
    			echo 'success####Successfully Updated'; die;
	     	}else{
	     	    echo 'success####Confirm Password Does Not Match'; die;
	     	}

		} else {

			$this->data['user'] = get_table_value('tbl_customer', array('id' => $user_data['id']));

			$this->data['active'] = 'change-pass';

			$views[] = 'front/change-password';

			$this->front_view($views,false);

		}

	}

	function subscription(){
		$post = $this->input->post();
		$check = get_table_value('subscriptions', array('email' => $post['subscribe-email']));
		if(empty($check)){
			$data = array('email' => $post['subscribe-email']);
			$this->db->insert('subscriptions', $data);

			$mail_data = array();
			$subject = "Thanks for subscribing Scuba Hellas";
			$message = $this->load->view('front/mailer/subscription', $mail_data, true);
			send_mail($post['subscribe-email'], $subject, $message);
			echo 'success####Successfully Subscribed'; die;
		} else {
			echo 'error####Already Subscribed'; die;
		}
	}

	function contact(){
		$post = $this->input->post();
		$data = array(
			'type' => 'contact',
			'name' => $post['name'].' '.$post['last_name'],
			'email' => $post['email'],
			'phone' => $post['phone'],
			'subject' => $post['subject'],
			'message' => $post['message'],
		);
		$this->db->insert('user_query', $data);

		$mail_data['name'] = $post['name'];
		$subject = "Thanks for contacting Scuba Hellas";
		$message = $this->load->view('front/mailer/contact-us-user', $mail_data, true);
		send_mail($post['email'], $subject, $message);

		$mail_data['name'] = $post['name'];
		$mail_data['email'] = $post['email'];
		$mail_data['phone'] = $post['phone'];
		$mail_data['subject'] = $post['subject'];
		$mail_data['message'] = $post['message'];
		$subject = "New Contact us query";
		$message = $this->load->view('front/mailer/contact-us-admin', $mail_data, true);
		$settings = get_table_value('admin_site_settings', array('site_id' => 1));
		send_mail($settings['site_email'], $subject, $message);
		echo 'success####Your query is successfully received'; die;
	}
}