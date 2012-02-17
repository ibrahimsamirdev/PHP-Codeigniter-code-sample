<?php
class Projects extends Controller {
	
	function Projects(){
		parent::Controller();
		if(!sess_var('logged_in')){
			//redirect('login/index/'.uri_string());
			redirect('login');
		}
		$this->load->model('projects_model');
	}
	
	function index()
	{
		//$this->get_projects();
	}//END INDEX
	
	function get_projects(){
		$result	=	$this->projects_model->get_projects();
		$data	=	array(
			'main_content'	=>	'projects',
			'projects'			=>	$result
		);
		$this->load->view("loader", $data);
	}//END GET_PROJECTS
	
	function add(){
		$this->load->view("loader",array('main_content'=>"add_project"));
	}//END ADD
	
	function edit($id=''){
		if( ! $id)
		{
			echo "Project Id required";
			return;
		}
		$result	=	$this->projects_model->get_project($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_project";
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($id=''){
		if($id){
			$this->load->model('units_model');
			if($this->units_model->get_units($id))
			{
				$msg	=	"Project NOT empty!<br><br>Please delete all the units in this project before delete";
				$this->load->view("warning",array('msg'=>$msg));
				return;
			}
			
			$this->projects_model->delete($id);
			$this->get_projects();
		}else
			echo "Project Id required";
	}//END DELETE
	
	function submit($id=''){
		$_POST['accountid']	=	sess_var('accountid');

		//validate form
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		
		if ($this->form_validation->run() == FALSE){
			//ajax data array
			$data	=	array(
				'server_validation'		=>	validation_errors()
			);
			echo json_encode($data);
		}
		else{
			if($id){
				$result		=	$this->projects_model->update($id);
				$content	=	"Project has been UPDATED successfully";
			}
			else{
				$result		=	$this->projects_model->add();
				$content	=	"Project has been CREATED successfully";
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