<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dives extends Core_Admin_Controller {
    public $table = "tbl_dives_center";
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
        
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['center'] = $this->Common_model->get_result($this->table,['status>='=> 0]);
        $views[] = 'admin/manage-dives/index';

        $this->admin_view($views);
    }

    public function add_dives() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('address', 'Address', 'required');
            if ($this->form_validation->run() != false) {
                $id =$this->input->post('id');
                $data = [
                    "country" => "India",
                    "state" => "NA",
                    "city" => $this->input->post('reg-input-city'),
                    'created_at' => date("Y-m-d H:i:s"),
                    "status" => 1,
                    "added_by" => $user['id'],
                    "email" => $user['email'],
                    "latitude" => $this->input->post('latitude'),
                    "longitude" => $this->input->post('longitude'),
                    "address" => $this->input->post('address'),
                    "type" => $user['role_id'] > 0 ? "sub-admin":"admin",
                    "category_id"=> $this->input->post('category_id')
                ];
                $this->PermissionModel->insert($this->table,$data);
                $this->session->set_flashdata('success', "Dive Center details Added successfully.");
                redirect('admin/manage-dives'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['dives_category'] = $this->Common_model->get_result("tbl_dives_category",['status>='=> 0]);
        $views[] = 'admin/manage-dives/add';

        $this->admin_view($views);
    }

    public function edit_dives() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('city', 'City', 'required');
            if ($this->form_validation->run() != false) {
                $id =$this->input->post('id');
                $data = [
                    "city" => $this->input->post('city'),
                    "status" => $this->input->post('status'),
                    "latitude" => $this->input->post('latitude'),
                    "longitude" => $this->input->post('longitude'),
                    "address" => $this->input->post('address'),
                    "category_id"=> $this->input->post('category_id')
                ];
                $this->PermissionModel->Update($id,$data,$this->table);
                $this->session->set_flashdata('success', "Dives Center details updated successfully.");
                redirect('admin/manage-dives'); 
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'manage-dives';
        $this->data['title'] = 'Dives Center';
        $this->data['user'] = $this->Common_model->get_result($this->table,['id'=>$this->uri->segment(3)]);
        $this->data['dives_category'] = $this->Common_model->get_result("tbl_dives_category",['status>='=> 0]);
        $views[] = 'admin/manage-dives/edit';

        $this->admin_view($views);
    }

    public function delete_dives() {

        $this->data['vendors'] = $this->Common_model->delete($this->table,['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Dives Center Deleted successfully.");
        redirect('admin/manage-dives'); 
    }

    public function getallmarker(){
        $center = $this->Common_model->get_result("tbl_dives_center",['status>='=> 0]);
        header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
        echo '<markers>';
        $ind=0;
        // Iterate through the rows, printing XML nodes for each
        foreach($center as $key => $value){
          // Add to XML document node
          echo '<marker ';
          echo 'id="' . $value->id . '" ';
          echo 'name="' . $this->parseToXML($value->city) . '" ';
          echo 'address="' . $this->parseToXML($value->address) . '" ';
          echo 'lat="' . $value->latitude . '" ';
          echo 'lng="' . $value->longitude . '" ';
          echo 'type="' . $value->city . '" ';
          echo '/>';
          $ind = $ind + 1;
        }

        // End XML file
        echo '</markers>';
        
    }



    function parseToXML($htmlStr)
    {
        $xmlStr=str_replace('<','&lt;',$htmlStr);
        $xmlStr=str_replace('>','&gt;',$xmlStr);
        $xmlStr=str_replace('"','&quot;',$xmlStr);
        $xmlStr=str_replace("'",'&#39;',$xmlStr);
        $xmlStr=str_replace("&",'&amp;',$xmlStr);
        return $xmlStr;
    }

    
}
