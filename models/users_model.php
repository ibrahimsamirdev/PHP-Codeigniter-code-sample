<?php
class Users_model extends Model {

	function add(){
		$this->db->insert('users',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND userid =".$id);
		$this->db->update('users',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND userid =".$id);
		return $this->db->delete('users');
	}
	
	function get_user($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND userid =".$id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_users(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('users');
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_users_table(){
		$this->db->select('name , email');
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){
			$this->load->library('table');
			$this->table->set_heading('Name', 'Email');
			
			return $this->table->generate($query);
		}
	}
	
}
?>