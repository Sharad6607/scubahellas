<?php

function get_capctha($session_name=null,$pool=null){

	$CI =& get_instance();

	$CI->load->helper('captcha');

	$config = array(

		'img_path'	=> './assets/admin/captcha/',

		'img_url'	=> base_url('/assets/admin/captcha/'),

		'font_path'	=> FCPATH.'system/fonts/texb.ttf',

		'img_width'	=> 150,

		'img_height'=> 30,

		'expiration'=> 600,

		'word_length'=> 6,

		'font_size'	=> 16,

		'img_id'	=> 'captcha_image',

		'pool'		=> ( empty($pool) ? '0123456789' : $pool ),

		'colors'	=> array(

			'background' => array(255, 255, 255),

			'border' => array(0, 0, 0),

			'text' => array(0, 0, 0),

			'grid' => array(255, 40, 40)

		)

	);

	$captcha = create_captcha($config);

	$CI->session->set_userdata(array($session_name=>$captcha['word']));

	return $captcha;

}

function get_table_data($table, $condition=array()){

	$CI =& get_instance();

	$CI->db->select()->from($table);

	if($condition) $CI->db->where($condition);

	return $CI->db->get()->result_array();

}

function send_mail($to, $subject, $message, $attachment=array(),$cc=""){

	$CI =& get_instance();

	$CI->email->clear(True);

	$config['protocol'] = 'smtp';

	$config['smtp_host'] = 'ssl://smtp.googlemail.com';

	$config['smtp_port'] = 465;

	$config['smtp_user'] = 'info@swastikpooja.com';

	$config['smtp_pass'] = 'hnl@9876';	
	
	$config['mailtype'] = 'html';

	$config['charset'] = 'iso-8859-1';

	$config['newline'] = "\r\n";

	$config['crlf'] = "\r\n";

	$config['priority'] = 1;

	$CI->email->initialize($config);

	$CI->email->from('info@swastikpooja.com', 'Scuba Hellas');

	$CI->email->to($to);

	if($cc != "") $CI->email->cc($cc);

	$CI->email->subject($subject);

	$CI->email->message($message);

	if(!empty($attachment)){

		foreach($attachment as $a) $CI->email->attach($a);

	}

	return @$CI->email->send();

}

function slugify($text){

    $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

    $text = trim($text, '-');

    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    $text = strtolower($text);

    $text = preg_replace('~[^-\w]+~', '', $text);

    if(empty($text)) return 'n-a';

    return $text;

}

function get_table_value($table,$condition=array()){

	$CI =& get_instance();

	$CI->db->select()->from($table);

	$CI->db->where($condition);

	return $CI->db->get()->row_array();

}



?>