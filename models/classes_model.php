<?php
class Classes_model extends Model {

	function add(){
		$this->db->insert('classes',$_POST);

		return $this->db->_error_number();
	}
	
	function update($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update('classes',$_POST);

		return $this->db->_error_number();
	}
	
	function delete($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->delete('classes');
	}
	
	function get_class_data($id){
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get('classes');
		if ($query->num_rows() > 0){
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_classes($entity_type){
		$this->db->where("accountid ='".sess_var('accountid')."' AND entitytype =".$entity_type);
		$query = $this->db->get('classes');
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
}
?>