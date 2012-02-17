<?php
class Login_model extends Model {

	function validate_login(){
	
		$this->db->select('userid, accountid , name, is_admin');
		$this->db->where("email ='".$_POST['email']."' AND pass ='".md5($_POST['pass'])."' AND status =1");
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){
		   return $query->row_array();
		}else
			return FALSE;
	}
	
}
?>