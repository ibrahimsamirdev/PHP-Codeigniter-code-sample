<?php
class Areas_model extends Model {

	function add(){
		$this->db->insert('areas',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update('areas',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		return $this->db->delete('areas');
	}
	
	function get_area($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('areas');
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_areas($city_id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND cityid =".$city_id);
		$query = $this->db->get('areas');
		if ($query->num_rows() > 0){
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_areas_table(){
		$this->db->where("accountid ='".sess_var('accountid')."'");
		$query = $this->db->get('areas');
		if ($query->num_rows() > 0)
		{
			$this->load->library('table');
			return $this->table->generate($query);
		}
	}
	
}
?>