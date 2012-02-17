<?php
class Units_model extends Model {

	function add(){
		$this->db->insert('units',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update('units',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		return $this->db->delete('units');
	}
	
	function get_unit($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('units');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_units($project_id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND projectid =".$project_id);
		$query = $this->db->get('units');
		if ($query->num_rows() > 0){
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_units_table(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('units');
		if ($query->num_rows() > 0)
		{
			$this->load->library('table');
			return $this->table->generate($query);
		}
	}
	
}
?>