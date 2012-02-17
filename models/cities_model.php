<?php
class Cities_model extends Model {

	function add(){
		$this->db->insert('cities',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update('cities',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		return $this->db->delete('cities');
	}
	
	function get_city($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('cities');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_cities($country_id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND countryid =".$country_id);
		$query = $this->db->get('cities');
		if ($query->num_rows() > 0){
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_cities_table(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('cities');
		if ($query->num_rows() > 0)
		{
			$this->load->library('table');
			return $this->table->generate($query);
		}
	}
	
}
?>