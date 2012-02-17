<?php
class Cities extends Controller {
	
	function Cities(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('cities_model');
	}
	
	function index()
	{
		
	}//END INDEX
	
	function get_cities($country_id='')
	{
		if( ! $country_id)
		{
			echo "Country Id required";
			return;
		}
		$result	=	$this->cities_model->get_cities($country_id);
		$data	=	array(
			'main_content'	=>	'cities',
			'cities'		=>	$result,
			'country_id'	=>	$country_id
		);
		$this->load->view("loader", $data);
	}//END GET_CITIES
	
	function add($country_id='')
	{
		if( ! $country_id)
		{
			echo "Country Id required";
			return;
		}
		$data	=	array(
			'main_content'	=>	'add_city',
			'country_id'	=>	$country_id
		);
		$this->load->view("loader",$data);
	}//END ADD
	
	function edit($country_id='', $id='')
	{
		if( ! $country_id || ! $id)
		{
			echo "missing data, City Id required";
			return;
		}
		$result	=	$this->cities_model->get_city($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_city";
		$result['country_id']	=	$country_id;
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($country_id='', $id=''){
		if( ! $country_id || ! $id)
		{
			echo "missing data, City Id required";
			return;
		}
		$this->load->model('areas_model');
		if($this->areas_model->get_areas($id))
		{
			$msg	=	"Country NOT empty!<br><br>Please delete all Areas in this City before delete";
			$this->load->view("warning",array('msg'=>$msg));
			return;
		}
		
		$this->cities_model->delete($id);
		$this->get_cities($country_id);
	}//END DELETE
	
	function submit($country_id='', $id='')
	{
		//prep form data
		$_POST['accountid']		=	sess_var('accountid');
		if( ! $id)	//if not edit (i.e. add)
		{
			$_POST['countryid']	=	$country_id;
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
				$result		=	$this->cities_model->update($id);
				$content	=	"City has been UPDATED successfully";
			}
			else{
				$result		=	$this->cities_model->add();
				$content	=	"City has been CREATED successfully";
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