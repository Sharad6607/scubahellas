<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Uploadfiles
{
    private $CI;
    
    function __construct()
    {
        $this->CI =& get_instance();
		$this->CI->load->library('image_lib');
		
        
    }
	
	function do_upload($files,$filename){
				$config = array(
				'upload_path' => "./assets/uploads/user",
				'allowed_types' => "jpg|png|jpeg",
				'overwrite' => TRUE,
				//'max_size' => "2048000",
			   // 'max_height' => "768",
				//'max_width' => "1024"
				'encrypt_name'=> TRUE
				);
			$this->CI->load->library('upload',$config); 
				$respose=array();
				$files = $files;
                $cpt = count($files['name']);
                for($i=0; $i<$cpt; $i++)
                {        
					//$new_name = time().$files['name'][$i];
					//$config['file_name'] = $new_name;
					//$respose[]=$new_name;
                    //$_FILES[$filename]['name']= $files['type'][$i];
                    $_FILES[$filename]['name']= $files['name'][$i];
                    $_FILES[$filename]['type']= $files['type'][$i];
                    $_FILES[$filename]['tmp_name']= $files['tmp_name'][$i];
                    $_FILES[$filename]['error']= $files['error'][$i];
                    $_FILES[$filename]['size']= $files['size'][$i]; 
                    //$this->CI->upload->do_upload($filename);
                   	if($this->CI->upload->do_upload($filename)){
						$filesData = $this->CI->upload->data();
						$respose[]=$filesData['file_name'];
					} 
                }
                
				return $respose;
	}


	function do_uploadImage($files,$filename,$target){
				$config = array(
				'upload_path' => "./assets/uploads/".$target,
				'allowed_types' => "jpg|png|jpeg",
				'overwrite' => TRUE,
				//'max_size' => "2048000",
			   	// 'max_height' => "768",
				//'max_width' => "1024"
				'encrypt_name'=> TRUE
				);
			$this->CI->load->library('upload',$config); 
				$respose=array();
				$files = $files;
                $cpt = count($files['name']);
                for($i=0; $i<$cpt; $i++)
                {        
					$new_name = time().$files['name'][$i];
					$config['file_name'] = $new_name;
					//$respose[]=$new_name;
                    $_FILES[$filename]['name']= $files['name'][$i];
                    $_FILES[$filename]['type']= $files['type'][$i];
                    $_FILES[$filename]['tmp_name']= $files['tmp_name'][$i];
                    $_FILES[$filename]['error']= $files['error'][$i];
                    $_FILES[$filename]['size']= $files['size'][$i]; 
                    //$this->CI->upload->do_upload($filename);
                    if($this->CI->upload->do_upload($filename)){
						$filesData = $this->CI->upload->data();
						$respose[]=$filesData['file_name'];
					}
                }
				return $respose;
	}


	function do_uploadSingle($files,$filename,$target=null){
			$target = $target != null ? $target : 'user';
			$config = array(
				'upload_path' => "./assets/uploads/".$target,
				'allowed_types' => "jpg|png|jpeg",
				'overwrite' => TRUE,
				//'max_size' => "2048000",
			  	 // 'max_height' => "768",
				//'max_width' => "1024"
				'encrypt_name'=> TRUE
				);
				
				$this->CI->load->library('upload',$config); 
				
				if($this->CI->upload->do_upload($filename)){
					$filesData = $this->CI->upload->data();
					$this->reSizeLogo($filesData['file_name']);
					return $filesData['file_name'];
					
				}else{
					return 0;
				}
				
	}
	
	function reSizeLogo($imgName){
	
		 //$img_path =  realpath("img")."\\images\\uploaded\\".$imgName.".jpeg";
		 // Configuration
		 $config['image_library'] = 'gd2';
		 $config['source_image'] = FCPATH.'assets/uploads/user/'.$imgName;
		 $config['new_image'] = FCPATH.'assets/uploads/user/'.$imgName;
		 $config['create_thumb'] = TRUE;
		 $config['maintain_ratio'] = TRUE;
		 $config['width'] = 130;
		 $config['height'] = 91;
		$this->CI->load->library('image_lib', $config); 
		$this->CI->image_lib->initialize($config);
		$this->CI->image_lib->resize();
		if ( ! $this->CI->image_lib->resize()){ 
		  echo $this->CI->image_lib->display_errors();
		 }
		
	}

	
	
	
	
}
        
    