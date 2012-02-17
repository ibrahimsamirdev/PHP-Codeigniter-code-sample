<?php
class Classes extends Controller {
	
	function Classes(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('classes_model');
	}
	
	function index()
	{
		//$this->get_classes();
	}//END INDEX
	
	function get_classes($entity_type=''){
		if( ! $entity_type)
		{
			echo "Entity type required";
			return;
		}
		$result	=	$this->classes_model->get_classes($entity_type);
		$data	=	array(
			'main_content'	=>	'classes',
			'entity_type'	=>	$entity_type,
			'classes'		=>	$result
		);
		$this->load->view("loader", $data);
	}//END GET_CLASSES
	
	function add($entity_type='')
	{
		if( ! $entity_type)
		{
			echo "Entity type required";
			return;
		}
		$data	=	array(
			'main_content'	=>	'add_class',
			'entity_type'	=>	$entity_type
		);
		$this->load->view("loader",$data);
	}//END ADD
	
	function edit($entity_type='', $id=''){
		if( ! $entity_type || ! $id)
		{
			echo "missing data, Class Id required";
			return;
		}
		$result	=	$this->classes_model->get_class_data($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_class";
		$result['entity_type']	=	$entity_type;
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($entity_type='', $id=''){
		if( ! $entity_type || ! $id)
		{
			echo "missing data, Class Id required";
			return;
		}
		$this->classes_model->delete($id);
		$this->get_classes($entity_type);
	}//END DELETE
	
	function submit($entity_type='', $id=''){
		$_POST['accountid']	=	sess_var('accountid');
		if( ! $id)	//if not edit (i.e. add)
		{
			$_POST['entitytype']	=	$entity_type;
		}

		//validate form
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
				$result		=	$this->classes_model->update($id);
				$content	=	"Class has been UPDATED successfully";
			}
			else{
				$result		=	$this->classes_model->add();
				$content	=	"Class has been CREATED successfully";
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