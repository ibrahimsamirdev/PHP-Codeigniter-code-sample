<?php
class Users extends Controller {
	
	function Users(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('users_model');
	}
	
	function index()
	{
		$this->get_users();
	}//END INDEX
	
	function get_users()
	{
		$result	=	$this->users_model->get_users();
		$data	=	array(
			'main_content'	=>	'users',
			'users'			=>	$result
		);
		$this->load->view("loader", $data);
	}//END GET_USERS
	
	function add()
	{
		$this->load->view("loader",array('main_content'=>"add_user"));
	}//END ADD
	
	function edit($id='')
	{
		if(! $id)
		{
			echo "User Id required";
			return;
		}
		$result	=	$this->users_model->get_user($id);
		if( ! $result)
		{
			echo "Nothing to edit";
			return;
		}
		$result['main_content']	=	"add_user";
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($id='')
	{
		if(! $id)
		{
			echo "Id required";
			return;
		}
		$this->users_model->delete($id);
		$this->get_users();
	}//END DELETE
	
	function submit($id='')
	{
		$_POST['accountid']	=	sess_var('accountid');
			
		//validate form [perform validation server-side to make sure of fields]
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($id){
			$this->form_validation->set_rules('pass', 'Password', 'min_length[6]|max_length[32]|matches[repass]');
		}else{
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]|max_length[32]|matches[repass]');
		}
		$this->form_validation->set_rules('repass', 'Password Confirmation', '');
		
		if ($this->form_validation->run() == FALSE){
			//ajax data array
			$data	=	array(
				'server_validation'		=>	validation_errors()
			);
			echo str_replace('\\/', '/', json_encode($data));
		}
		else{
			//prep form data
			//remove unwanted elements from the form POST (to be inserted properly)
			unset($_POST['repass']);
			//the following is intended when UPDATE
			if($_POST['pass']){
				$_POST['pass']	=	md5($_POST['pass']);
			}else{
				unset($_POST['pass']);
			}
			
			if($id){
				$result		=	$this->users_model->update($id);
				$content	=	"User has been UPDATED successfully";
			}
			else{
				$result		=	$this->users_model->add();
				$content	=	"User has been CREATED successfully";
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