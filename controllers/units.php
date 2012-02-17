<?php
class Units extends Controller {
	
	function Units(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('units_model');
	}
	
	function index()
	{
		
	}//END INDEX
	
	function get_units($project_id=0)
	{
		$result	=	$this->units_model->get_units($project_id);
		$data	=	array(
			'main_content'	=>	'units',
			'units'			=>	$result,
			'project_id'	=>	$project_id
		);
		$this->load->view("loader", $data);
	}//END GET_UNITS
	
	function add($project_id=0)
	{
		$data	=	array(
			'main_content'	=>	'add_unit',
			'project_id'	=>	$project_id
		);
		$this->load->view("loader",$data);
	}//END ADD
	
	function edit($project_id=0, $id='')
	{
		if( ! $id)
		{
			echo "Unit Id required";
			return;
		}
		$result	=	$this->units_model->get_unit($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_unit";
		$result['project_id']	=	$project_id;
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($id='')
	{
		if(! $id)
		{
			echo "Id required";
			return;
		}
		if($this->units_model->delete($id))
		{
			//ajax data array
			$data	=	array(
				'is_valid'	=>	1,
				'content'	=>	"Unit deleted successfully"
			);
			echo json_encode($data);
		}
		else{
			$data	=	array(
				'is_valid'	=>	0
			);
			echo json_encode($data);
		}
	}//END DELETE
	
	function submit($project_id=0, $id='')
	{
		//prep form data
		$_POST['accountid']		=	sess_var('accountid');
		if( ! $id)	//if not edit (i.e. add)
		{
			$_POST['projectid']	=	$project_id;
		}
		//validate form [perform validation server-side to make sure of fields]
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		
		if ($this->form_validation->run() == FALSE){
			//ajax data array
			$data	=	array(
				'server_validation'		=>	validation_errors()
			);
			echo json_encode($data);
		}
		else{
			if($id){
				$result		=	$this->units_model->update($id);
				$content	=	"Unit has been UPDATED successfully";
			}
			else{
				$result		=	$this->units_model->add();
				$content	=	"Unit has been CREATED successfully";
			}
			//if duplicate key
			if($result == 1062){
				//ajax data array
				$data	=	array(
					'is_valid'	=>	0
				);
				echo json_encode($data);
			}else{
				//ajax data array
				$data	=	array(
					'is_valid'	=>	1,
					'content'	=>	$content
				);
				echo json_encode($data);
			}
		}//end ELSE form valid
	}//END SUBMIT
}
?>