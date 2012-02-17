<?php

//manage media types [images, videos, files]
class Media extends Controller {
	
	function Media(){
		parent::Controller();
		if(!sess_var('logged_in')){
			redirect('login');
		}
		$this->load->model('media_model');
	}
	
	function index()
	{
	}//END INDEX
	
	function get_media($media_type='', $entity_type='', $entity_id='')
	{
		if( ! $media_type || ! $entity_type ||  !$entity_id)
		{
			echo "missing data";
			return;
		}
		$result	=	$this->media_model->get_media_list($media_type, $entity_type, $entity_id);
		$data	=	array(
			'main_content'	=>	$media_type,
			'entity_type'	=>	$entity_type,
			'entity_id'		=>	$entity_id,
			"$media_type"	=>	$result
		);
		$this->load->view("loader",$data);
	}//END GET_MEDIA

	function add($media_type='', $entity_type='', $entity_id='')
	{
		if( ! $media_type || ! $entity_type ||  !$entity_id)
		{
			echo "missing data";
			return;
		}
		$data	=	array(
			'main_content'	=>	'add_'.$media_type,
			'entity_type'	=>	$entity_type,
			'entity_id'		=>	$entity_id
		);
		$this->load->view('loader',$data);
	}//END ADD
	
	function edit($media_type='', $entity_type=0, $entity_id=0, $id='')
	{
		if( ! $media_type || ! $id)
		{
			echo "missing data, Media Id required";
			return;
		}
		$result	=	$this->media_model->get_media($media_type, $id);
		if( ! $result)
		{
			echo "nothing to edit";
			return;
		}
		$result['main_content']	=	'add_'.$media_type;
		$result['entity_type']	=	$entity_type;
		$result['entity_id']	=	$entity_id;
		
		$this->load->view("loader",$result);
	}//END EDIT
	
	function delete($media_type='', $id='')
	{
		if( ! $media_type || ! $id)
		{
			echo "missing data, Media Id required";
			return;
		}
		//get old file name
		$result		=	$this->media_model->get_name($media_type, $id);
		$file_path	=	'resources/'.$media_type.'/';
		
		if($this->media_model->delete($media_type, $id))
		{
			if(is_file($file_path.$result['name']))unlink($file_path.$result['name']);
			if($media_type == "images")
			{
				if(is_file($file_path."thumbs/".$result['name']))unlink($file_path."thumbs/".$result['name']);
				if(is_file($file_path."med/".$result['name']))unlink($file_path."med/".$result['name']);
			}
			else
			if($media_type == "videos")
			{
				if(is_file($file_path."thumbs/".$result['thumb']))unlink($file_path."thumbs/".$result['thumb']);
			}
			//ajax data array
			$data	=	array(
				'is_valid'	=>	1,
				'content'	=>	"file deleted successfully"
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
	
	function upload_media($media_type, $entity_type='', $entity_id='', $id='')
	{
		//prep form data
		$_POST['accountid']		=	sess_var('accountid');
		if( ! $id)	//if not edit (i.e. add)
		{
			$_POST['entitytype']	=	$entity_type;
			$_POST['entityid']		=	$entity_id;
		}
		
		//if not edit (i.e add) or there is upload file then upload else just insert
		if( !$id || $_FILES['userfile']['name'])
		{
			$config['upload_path'] = 'resources/'.$media_type.'/';
			switch ($media_type)
			{
				case "files":
					$allowed_types	=	"*";
					$max_size		=	"16384";
					break;
				case "images":
					$allowed_types	=	"jpg|png|gif";
					$max_size		=	"3072";
					break;
				case "videos":
					$allowed_types	=	"flv|mp4|mov";
					$max_size		=	"16384";
					break;
			}
			$config['allowed_types']=	$allowed_types;
			$config['max_size']		=	$max_size;
			
			$this->load->library('upload', $config);
			
			//if error upload return error
			if ( ! $this->upload->do_upload())
			{
				//ajax data array
				$data	=	array(
					'is_valid'	=>	0,
					'error'		=>	$this->upload->display_errors()
				);
				//echo str_replace('\\/', '/', json_encode($data));
				echo json_encode($data);
				return;
			}
			else
			{
				$file_data		=	$this->upload->data();
				$_POST['path']	=	base_url().$config['upload_path'];
				$_POST['name']	=	$file_data['file_name'];
				$_POST['size']	=	$file_data['file_size'];
				
				//reize images
				$this->load->helper("resize_image");
				if($media_type == "images")
				{
					resizeimage($file_data['full_path'], 136, 102, 80, "crop", $config['upload_path']."thumbs/".$_POST['name']);
					//so that not to enlarge the image in medium version
					if($file_data['image_width']> 800 || $file_data['image_height']> 600)
						resizeimage($file_data['full_path'], 800, 600, 80, "scale", $config['upload_path']."med/".$_POST['name']);
					else
						copy($file_data['full_path'], $config['upload_path']."med/".$_POST['name']);
				}
				else
				if($media_type == "videos" && $_FILES['userfile2']['name'])
				{
					$config2['upload_path']		=	'resources/videos/thumbs/';
					$config2['allowed_types']	=	'jpg|png|gif';
					$config2['max_size']		=	'1024';
					
					$this->upload->initialize($config2);
					//if error upload return error
					if ( ! $this->upload->do_upload('userfile2'))
					{
						//ajax data array
						$data	=	array(
							'is_valid'	=>	0,
							'error2'		=>	$this->upload->display_errors()
						);
						echo json_encode($data);
						//delete the video file if it was uploaded
						if(is_file($config['upload_path'].'/'.$_POST['name']))unlink($config['upload_path'].'/'.$_POST['name']);
						return;
					}
					else
					{
						$file_data		=	$this->upload->data();
						$_POST['thumb']	=	$file_data['file_name'];
						//resize thumbnail image
						resizeimage($file_data['full_path'], 90, 65, 80, "crop", $file_data['full_path']);
					}
				}
				
				//if edit (get old file name then delete after the insert)
				if($id)
				{
					$result		=	$this->media_model->get_name($media_type, $id);
					$file_name	=	$result['name'];
					$thumb		=	$result['thumb'];
				}
			}
		}//end if
		
							/*********** insert record into database ***********/
		//if edit
		if($id){
			$error		=	$this->media_model->update($media_type, $id);
			$content	=	$media_type." has been UPDATED successfully";
		}
		else{
			$error		=	$this->media_model->add($media_type);
			$content	=	$media_type." has been ADDED successfully";
		}
		if( ! $error){
			//if edit then delete old file
			if($id && $_FILES['userfile']['name'])
			{
				if(is_file($config['upload_path'].$file_name))unlink($config['upload_path'].$file_name);
				if($media_type == "images")
				{
					if(is_file($config['upload_path']."thumbs/".$file_name))unlink($config['upload_path']."thumbs/".$file_name);
					if(is_file($config['upload_path']."med/".$file_name))unlink($config['upload_path']."med/".$file_name);
				}
				if($media_type == "videos" && $_FILES['userfile2']['name'])
				{
					if(is_file($config['upload_path']."thumbs/".$thumb))unlink($config['upload_path']."thumbs/".$thumb);
				}
			}
			//ajax data array
			$data	=	array(
				'is_valid'	=>	1,
				'content'	=>	$content
			);
			echo json_encode($data);
		}
	}//END UPLOAD_IMAGE
}
?>