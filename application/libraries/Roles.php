<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Roles
{
    private $CI;
    
    function __construct()
    {
        $this->CI =& get_instance();
	}

    function getRoles()
    {
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_role');
        $this->CI->db->where('status',1);
        $query = $this->CI->db->get();
        $result = $query->result();
        return $result;   
    }

    function getRoles_by_id($id){
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_role');
        $this->CI->db->where('id',$id);
        $query = $this->CI->db->get();
        $result = $query->result();
        return $result; 

    }

    function getModules()
    {
        $this->CI->db->select('*');
        $this->CI->db->from('tbl_role_modules');
        $this->CI->db->where('status ',1);
        $this->CI->db->order_by('sorting ',"asc");
        $query = $this->CI->db->get();
        $result = $query->result();
        return $result;   
    }

    public function getModuleNameByRole(){
        if($this->CI->session->userdata('admin_login_data')){
            $sess =$this->CI->session->userdata('admin_login_data');
            if($sess['is_logged_in']==1 && isset($sess['role_id'])){
                if($sess['role_id'] == 0){
                    $query ="select id,name as module_name,urlkey,icon from tbl_role_modules where status=1 order by sorting ASC";
                }else{
                    $query ="select rp.role_id,m.id,m.name as module_name,m.urlkey,m.icon from tbl_role_permission rp left join tbl_role_modules m on rp.module_id = m.id  where rp.role_id='".$sess['role_id']." and m.status=1'  group by module_name order by m.sorting ASC";
                }
                $data = $this->CI->db->query($query)->result();
                $userModule=array();
                if(count($data) > 0){
                    foreach ($data as $key => $value) {
                        $userModule[] = array('m_id'=>$value->id,'module_name'=>$value->module_name,'urlkey'=>$value->urlkey,'icon'=>$value->icon);
                    }
                }
                $this->CI->session->set_userdata('userModule', $userModule);
                return true;
            }
            redirect('admin/logout');
        }    
        redirect('admin/logout');
    }

    function getRoleWiseAssignPermission($role_id,$id){
        if($this->CI->session->userdata('admin_login_data')){
            $sess =$this->CI->session->userdata('admin_login_data');
            if($sess['is_logged_in']==1){
                
                $query ="select m.id as moudule_id,mp.permission as name,mp.id as permission_id from tbl_role_permission rp left join tbl_role_modules m on rp.module_id = m.id left join tbl_role_permissions mp on rp.permission_id=mp.id where m.id='".$id."' and rp.role_id='".$role_id."'  ";
                $data = $this->CI->db->query($query)->result();
                $userPermissions=array();
                if(count($data) > 0){
                    foreach ($data as $key => $value) {
                        $userPermissions[] =$value->name;
                    }
                }
                
                return $userPermissions;
            }
            redirect('logout');
        }    
        redirect('logout');
    }

    function getGoUserRoles(){
        if($this->CI->session->userdata('admin_login_data')){
            $sess =$this->CI->session->userdata('admin_login_data');
            if($sess['is_logged_in']==1){
                
                $query ="select m.id as moudule_id,mp.permission as name,mp.id as permission_id from tbl_role_permission rp left join tbl_role_modules m on rp.module_id = m.id left join tbl_role_permissions mp on rp.permission_id=mp.id where role_id='".$sess['role_id']."'  ";
                $data = $this->CI->db->query($query)->result();
                $userPermissions=array();
                if(count($data) > 0){
                    foreach ($data as $key => $value) {
                        $userPermissions[$value->moudule_id][] =$value->name;
                    }
                }
                $this->CI->session->set_userdata('userPermissions', $userPermissions);
                return 1;
            }
            redirect('logout');
        }    
        redirect('logout');
    }
}
        
    