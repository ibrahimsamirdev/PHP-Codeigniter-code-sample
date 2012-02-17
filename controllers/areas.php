<?php
class Areas extends Controller {
	
	function Areas(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('areas_model');
	}
	
	function index()
	{
		
	}//END INDEX
	
	function get_areas($country_id='', $city_id='')
	{
		if( ! $country_id || ! $city_id)
		{
			echo "missing data, City Id required";
			return;
		}
		$result	=	$this->areas_model->get_areas($city_id);
		$data	=	array(
			'main_content'	=>	'areas',
			'areas'			=>	$result,
			'country_id'	=>	$country_id,
			'city_id'		=>	$city_id
		);
		$this->load->view("loader", $data);
	}//END GET_AREAS
	
	function add($country_id='', $city_id='')
	{
		if( ! $country_id || ! $city_id)
		{
			echo "missing data, City Id required";
			return;
		}
		$data	=	array(
			'main_content'	=>	'add_area',
			'country_id'	=>	$country_id,
			'city_id'		=>	$city_id
		);
		$this->load->view("loader",$data);
	}//END ADD
	
	function edit($country_id='', $city_id='', $id='')
	{
		if( ! $country_id || ! $city_id || ! $id)
		{
			echo "missing data, Area Id required";
			return;
		}
		$result	=	$this->areas_model->get_area($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_area";
		$result['country_id']	=	$country_id;
		$result['city_id']		=	$city_id;
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($country_id='', $city_id='', $id='')
	{
		if( ! $country_id || ! $city_id || ! $id)
		{
			echo "missing data, Area Id required";
			return;
		}
		$this->areas_model->delete($id);
		$this->get_areas($country_id, $city_id);
	}//END DELETE
	
	function submit($city_id='', $id='')
	{
		//prep form data
		$_POST['accountid']		=	sess_var('accountid');
		if( ! $id)	//if not edit (i.e. add)
		{
			$_POST['cityid']	=	$city_id;
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
				$result		=	$this->areas_model->update($id);
				$content	=	"Area has been UPDATED successfully";
			}
			else{
				$result		=	$this->areas_model->add();
				$content	=	"Area has been CREATED successfully";
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