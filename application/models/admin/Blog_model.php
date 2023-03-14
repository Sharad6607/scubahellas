<?php
	class Blog_model extends CI_Model{

		function getsubadmin(){
			$this->db->select('t1.*,t2.name');
			$this->db->from('tbl_admin t1');
			$this->db->join('tbl_role t2', 't1.role_id = t2.id');
			$this->db->where('t1.role_id >',0);
			$query = $this->db->get();
			return $query->result();
		}
	

		public function add_blog_data($blogData){

			if($this->db->insert('blog_posting',$blogData)){
				// echo  $this->db->last_query(); die;
				return $this->db->insert_id();

			}else{

				return 0;
			}

		}

		public function getBlogPostList(){

			$this->db->select('blog_posting.*,blog_category.blog_category');
			$this->db->from('blog_posting');
			$this->db->join('blog_category','blog_posting.category_id = blog_category.id','left');
			$q = $this->db->get()->result_array();
			// echo "<pre>"; print_r($q); die;
			return $q;

		}

		public function getBlogCategoryList(){

			$this->db->select('*');
			$this->db->from('blog_category');
			// $this->db->where('status','Active');
			$q = $this->db->get()->result_array();
			return $q;

		}

		public function update_student_data($studentId,$studentData){

			$this->db->where('id',$studentId);
			$q = $this->db->update('student',$studentData);
			return $q;

		}

		public function update_student_status($studentId,$studentStatusData){

			$this->db->where('id',$studentId);
			$q = $this->db->update('student',$studentStatusData);
			return $q;

		}

		public function addBlogCategory($blogData){

			if($this->db->insert('blog_category',$blogData)){
				// echo  $this->db->last_query(); die;
				return $this->db->insert_id();

			}else{

				return 0;
			}

		}

		public function getBlogCategoryListById($id){

			$this->db->select('*');
			$this->db->from('blog_category');
			$this->db->where('id',$id);
			$q = $this->db->get()->row_array();
			return $q;


		}
		
	}


?>
