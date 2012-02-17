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
			url		:	"<?=site_url('classes/submit/'.$entity_type.'/'.@$id)?>",
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
						$.validationEngine.buildPrompt('#name','Class already exists','error');
					}
					else{
						load_content('classes/<?=$entity_type?>');
					}
				}
			}
		});
	}
	
	//form validation
	$("#form").validationEngine({
		unbindEngine	:	false,
		validationEventTriggers	:	"keyup blur",
		success	:	function(formData) { submit_form(formData) }
	})

});
</script>

<div id="container">
	<div class="form_block" id="add_country">
	<div class="form_title"><?=@$id?"Edit Class":"Create Class"?></div>
	<div class="form">
	<form action="<?=site_url('classes/submit/'.$entity_type.'/'.@$id)?>" method="post" onsubmit="return false" id="form">
		<br />
		<div class="sepa">
		  <label for="name">Name</label>
		<input name="name" type="text" id="name" value="<?=@$name?>" class="validate[required]" />
		</div>
		
		<div class="sepa">
		  <label for="description">Description</label>
		  <textarea name="description" id="description"><?=@$description?></textarea>
		</div>
		
		<div class="sepa">
		<label for="submit">&nbsp;</label>
		<input type="submit" value="Submit" />
		&nbsp;&nbsp;
		<input name="cancel" type="button" id="cancel" value="Cancel" onclick="load_content('classes/<?=$entity_type?>')" />
		</div>
	</form>
	</div>
	</div>
</div>
<?php
if(0){
?>
</body>
</html>
<?php
}
?>
