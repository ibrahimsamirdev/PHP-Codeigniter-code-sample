<?php
class Test extends Controller {
	var $xx="hima";
	function Test(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
	}
	
	function index(){
		$this->load->view('add_files');
	}
	
	function tt(){
		$this->load->helper('resize_image');
		dodo();
	}
	
	function out($m=null,$n=null){
		echo $m;
		echo $n;
	}
}
?>