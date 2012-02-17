<?php
class Media_model extends Model {

	function add($media_type)
	{
		$this->db->insert($media_type,$_POST);
		return $this->db->_error_number();
	}
	
	function update($media_type, $id)
	{
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$this->db->update($media_type,$_POST);

		return $this->db->_error_number();
	}
	
	function delete($media_type, $id)
	{
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		return $this->db->delete($media_type);
	}
	
	function get_media($media_type, $id)
	{
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get($media_type);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	//get media name (used in update to delete old file)
	function get_name($media_type, $id)
	{
		$this->db->select('name');
		if($media_type == 'videos')
		{
			$this->db->select('thumb');
		}
		$this->db->where("accountid ='".sess_var('accountid')."' AND id =".$id);
		$query = $this->db->get($media_type);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
			return FALSE;
	}
	
	function get_media_list($media_type, $entity_type, $entity_id)
	{
		$this->db->where("accountid ='".sess_var('accountid')."' AND entitytype =$entity_type AND entityid =$entity_id");
		$query = $this->db->get($media_type);
		if ($query->num_rows() > 0){
			foreach($query->result() as $row)
			{
				$result[]	=	$row;
			}
			return $result;
		}
	}
	
	function get_media_table($media_type, $entity_type, $entity_id)
	{
		$this->db->where("accountid ='".sess_var('accountid')."' AND entitytype =$entity_type AND entityid =$entity_id");
		$query = $this->db->get($media_type);
		if ($query->num_rows() > 0)
		{
			$this->load->library('table');
			return $this->table->generate($query);
		}
	}
}
?>