<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rental_products extends Core_Admin_Controller {
    public $table = "tbl_rental_products";
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
        
        $this->data['active'] = 'products';
        $this->data['title'] = 'products';
        $this->data['products'] = $this->Common_model->get_result($this->table,['status>='=> 0]);
        $views[] = 'admin/products/index';

        $this->admin_view($views);
    }

    public function add_products() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('mrp', 'MRP', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {
                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image/product';
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
                        $category_name = implode(',', $this->input->post('category_id'));
                        $path =  $this->upload->data();
                        $picture = $path['file_name'];
                        $data = [
                            "product_name" => $this->input->post('product_name'),
                            'slug' => slugify(trim($this->input->post('product_name')).' '.trim($this->input->post('sku'))),
                            'category_id' => $category_name,
                            "description" => $this->input->post('description'),
                            "mrp" => $this->input->post('mrp'),
                            "status" => $this->input->post('status'),
                            "product_image" => $picture,
                            'created_at' => date("Y-m-d H:i:s"),
                        ];

                        $this->PermissionModel->insert('tbl_rental_products',$data);
                        $this->session->set_flashdata('success', "Products details updated successfully.");
                        redirect('admin/rental-products'); 
                    }
                }
                else
                {
                    $category_name = implode(',', $this->input->post('category_id'));
                    $data = [
                        "product_name" => $this->input->post('product_name'),
                        'slug' => slugify(trim($this->input->post('product_name')).' '.trim($this->input->post('sku'))),
                        'category_id' => $category_name,
                        "description" => $this->input->post('description'),
                        "mrp" => $this->input->post('mrp'),
                        "status" => $this->input->post('status'),
                        'created_at' => date("Y-m-d H:i:s"),
                    ];
                    $this->PermissionModel->insert('tbl_rental_products',$data);
                    $this->session->set_flashdata('success', "Products details updated successfully.");
                    redirect('admin/rental-products'); 
                }
            }
            else{
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['get_category'] = $this->Common_model->get_result("tbl_category",['status>='=> 0]);
        $views[] = 'admin/products/add';

        $this->admin_view($views);
    }

    public function edit_products() {
        $user = $this->session->userdata('admin_login_data');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('mrp', 'MRP', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() != false) {

                $this->load->library('upload');
                if($_FILES['file']['name']){
                    $config['encrypt_name']         = TRUE;   
                    $config['upload_path']          = 'assets/admin/image/product';
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
                        $category_name = implode(',', $this->input->post('category_id'));
                        $path =  $this->upload->data();
                        $picture = $path['file_name'];
                        $data = [
                            "product_name" => $this->input->post('product_name'),
                            'slug' => slugify(trim($this->input->post('product_name')).' '.trim($this->input->post('sku'))),
                            'category_id' => $category_name,
                            "description" => $this->input->post('description'),
                            "mrp" => $this->input->post('mrp'),
                            "status" => $this->input->post('status'),
                            "product_image" => $picture,
                        ];
                        $id =$this->input->post('id');
                        
                        $this->PermissionModel->Update($id,$data,'tbl_rental_products');
                        $this->session->set_flashdata('success', "Products details updated successfully.");
                        redirect('admin/rental-products'); 
                    }
                }
                else
                {
                        $category_name = implode(',', $this->input->post('category_id'));
                        $data = [
                            "product_name" => $this->input->post('product_name'),
                            'slug' => slugify(trim($this->input->post('product_name')).' '.trim($this->input->post('sku'))),
                            'category_id' => $category_name,
                            "description" => $this->input->post('description'),
                            "mrp" => $this->input->post('mrp'),
                            "status" => $this->input->post('status')
                        ];
                        $id =$this->input->post('id');
                    
                    $this->PermissionModel->Update($id,$data,'tbl_rental_products');
                    $this->session->set_flashdata('success', "Products details updated successfully.");
                    redirect('admin/rental-products'); 
                }
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
            }
        }
        $this->data['active'] = 'permission';
        $this->data['title'] = 'permission';
        $this->data['products'] = $this->Common_model->get_result($this->table,['id'=>$this->uri->segment(3)]);
        $this->data['get_category'] = $this->Common_model->get_result("tbl_category",['status>='=> 0]);
        $views[] = 'admin/products/edit';

        $this->admin_view($views);
    }

    public function delete_products() {

        $this->data['products'] = $this->Common_model->delete($this->table,['id'=> $this->uri->segment(4)]);
        $this->session->set_flashdata('success', "Products Deleted successfully.");
        redirect('admin/rental-products'); 
    }

    public function change_status()
    {
        return $this->PermissionModel->Update($this->input->post('id'),['status' => $this->input->post('status')],'tbl_rental_products',);

        
    }

    
}
