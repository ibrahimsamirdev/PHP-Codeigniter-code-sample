<?php
class Countries extends Controller {
	
	function Countries(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('countries_model');
	}
	
	function index()
	{
		//$this->get_countries();
	}//END INDEX
	
	function get_countries(){
		$result	=	$this->countries_model->get_countries();
		$data	=	array(
			'main_content'	=>	'countries',
			'countries'		=>	$result
		);
		$this->load->view("loader", $data);
	}//END GET_COUNTRIES
	
	function add(){
		$this->load->view("loader",array('main_content'=>"add_country"));
	}//END ADD
	
	function edit($id=''){
		if( ! $id)
		{
			echo "Country Id required";
			return;
		}
		$result	=	$this->countries_model->get_country($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_country";
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($id=''){
		if($id){
			$this->load->model('cities_model');
			if($this->cities_model->get_cities($id))
			{
				$msg	=	"Country NOT empty!<br><br>Please delete all cities in this country before delete";
				$this->load->view("warning",array('msg'=>$msg));
				return;
			}
			
			$this->countries_model->delete($id);
			$this->get_countries();
		}else
			echo "Country Id required";
	}//END DELETE
	
	function submit($id=''){
		$_POST['accountid']	=	sess_var('accountid');

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
				$result		=	$this->countries_model->update($id);
				$content	=	"Country has been UPDATED successfully";
			}
			else{
				$result		=	$this->countries_model->add();
				$content	=	"Country has been CREATED successfully";
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