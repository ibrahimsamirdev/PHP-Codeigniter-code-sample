<?php
class Login extends Controller {
	
	function Login(){
		parent::Controller();
	}
	
	function index()
	{
		//check if the page is redirected
		//$ref	=	$this->uri->uri_to_assoc(3);
		//$ref	=	$this->uri->assoc_to_uri($ref);
		//$this->load->view("loader",array('main_content'=>"login", 'ref'=>$ref));
		
		$this->load->view("login_loader",array('main_content'=>"login"));
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
	function submit(){
		
		if ( ! $this->validate_login()){
			//ajax data array
			$data	=	array(
				'is_valid'	=>	0
			);
			echo json_encode($data);
		}
		else{
			//view data array
			$data	=	array(
				'email'		=>	$_POST['email']
			);
			$content	=	$this->load->view("login_success",$data,TRUE);
			//ajax data array
			$data		=	array(
				'is_valid'	=>	1,
				'content'	=>	$content
			);
			echo json_encode($data);
		}
	}
	
	function validate_login(){
		$this->load->model('login_model');
		$result	=	$this->login_model->validate_login();
		if($result === FALSE){
			return FALSE;
		}else{
			$result['logged_in']	=	TRUE;
			$this->session->set_userdata($result);
			return TRUE;
		}
	}
}
?>