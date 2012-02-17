<?php
//this condition to add page tags for dreamweaver preview only
if(0){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
<body>
<?php
}
?>
<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script> 
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
$(document).ready(function() {
	function submit_form(querystr){
		//display loading
		$("#loading div").fadeIn(300);
		$.ajax({
			url		:	"<?=site_url('projects/submit/'.@$id)?>",
			type	:	"POST",
			dataType:	"json",
			data	:	querystr,
			success	:	function(data){
			//hide loading
			$("#loading div").fadeOut(300);
				if(data.server_validation)
				{
					$.validationEngine.buildPrompt('#form',data.server_validation,'error');
				}else{
					$.validationEngine.closePrompt('#form');
					if(!data.is_valid)
					{
						$.validationEngine.buildPrompt('#name','Project already exists','error');
					}
					else{
						//window.location.replace("test");
						/*$("#container").fadeOut("fast",function(){
							$("#container").html(data.content);
							$("#container").fadeIn("slow");
						});*/
						load_content('projects');
					}
				}
			}//END SUCCESS
		});
	}
	
	//form validation
	$("#form").validationEngine({
		unbindEngine	:	false,
		validationEventTriggers	:	"keyup blur",
		success	:	function(formData) { submit_form(formData) }
	})

});

//this process of tab_load processes as follows:
//1- hide the form_loader (which contains the form)
//2- load the tab page into tab_loader div
//3- when go back to the form_loader tab gust show that form again
//4- hide the tab_loader div

$('#info').click(function (){
	$('#tab_loader').fadeOut(300, function(){
		$('#form_loader').fadeIn('slow');
	});
});
</script>

<div id="container">
<?php
	if(@$id){
?>
<div class="toolbar"><a href="javascript:load_content('projects')"><img src="images/ico-back.png" width="48" height="40" border="0" align="left" style="padding-top:13px" /></a><a href="javascript://" title="Project Info." id="info"><img src="images/imgs_2x2.png" width="50" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/images/1/<?=@$id?>','#tab_loader','#form_loader')" title="Images"><img src="images/imgs_2x4.png" width="61" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/videos/1/<?=@$id?>','#tab_loader','#form_loader')" title="Videos"><img src="images/imgs_2x5.png" width="54" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/files/1/<?=@$id?>','#tab_loader','#form_loader')" title="Files"><img src="images/imgs_2x6.png" width="57" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/links/1/<?=@$id?>','#tab_loader','#form_loader')" title="Links"><img src="images/imgs_2x7.png" width="52" height="51" border="0" /></a>
  <div style="clear:both"></div>
</div>
<?php
	}//end if id
?>
<div id="form_loader">
	<div class="form_block" id="add_project">
	<div class="form_title"><?=@$id?"Edit Project":"Create Project"?></div>
	<div class="form" style="background:url(images/ico-projects.png) no-repeat top right">
	<form action="<?=site_url('projects/submit/'.@$id)?>" method="post" onsubmit="return false" id="form">
		<br />
		<div class="sepa">
		  <label for="name">Name</label>
		<input name="name" type="text" id="name" value="<?=@$name?>" class="validate[required,length[4,160]]" />
		</div>
		
		<div class="sepa">
		  <label for="description">Description</label>
		  <textarea name="description" id="description"><?=@$description?></textarea>
		</div>
		
		<div class="sepa">
		<label for="status">Status</label>
		<select name="status" id="status">
		  <option value="1" selected="selected" >Active</option>
		  <option value="0" <?=(isset($status) && ! @$status)? "selected='selected'":"" ?> >Not Active</option>
		  </select>
		</div>
		
		<div class="sepa">
		<label for="submit">&nbsp;</label>
		<input type="submit" value="Submit" />
		&nbsp;&nbsp;
		<input name="cancel" type="button" id="cancel" value="Cancel" onclick="load_content('projects')" />
		</div>
	</form>
	</div>
	</div>
</div>

<div id="tab_loader" style="display:none"></div>

</div>
<?php
if(0){
?>
</body>
</html>
<?php
}
?>
