<?php
class Countries_model extends Model {

	function add(){
		$this->db->insert('countries',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update('countries',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->delete('countries');
	}
	
	function get_country($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('countries');
		if ($query->num_rows() > 0){
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_countries(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('countries');
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_countries_table(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('countries');
		if ($query->num_rows() > 0)
		{
			$this->load->library('table');
			return $this->table->generate($query);
		}
	}
	
	function select_fields($id, $fields='id'){
		$this->db->select($fields);
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('countries');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
	}
	
}
?>