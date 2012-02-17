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

	$("#form input").keypress(function (e) {
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
			$("#form").submit();
		}
    });
	
	function submit_form(querystr){
		//display loading
		$("#loading div").fadeIn(300);
		
		$.ajax({
			url		:	"<?=site_url('users/submit/'.@$userid)?>",
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
						$.validationEngine.buildPrompt('#email','Email already exists','error');
					}
					else{
						//window.location.replace("test");
						load_content('users');
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
	<div class="form_block" id="add_user">
	<div class="form_title"><?=@$userid?"Edit User":"Create User"?></div>
	<div class="form">
	<form action="<?=site_url('users/submit/'.@$userid)?>" method="post" onsubmit="return false" id="form">
		<br />
		<div class="sepa">
		  <label for="name">Name</label>
		<input name="name" type="text" id="name" value="<?=@$name?>" class="validate[required,length[4,32]]" />
		</div>
		
		<div class="sepa">
		  <label for="email">Email</label>
		<input name="email" type="text" id="email" value="<?=@$email?>" class="validate[required,custom[email]]" />
		</div>
		
		<div class="sepa">
		  <label for="pass">Password</label>
		<input name="pass" type="password" id="pass" <?=@$userid?'':'class="validate[required,length[6,32]]"'?>  />
		</div>
		
		<div class="sepa">
		  <label for="repass">Retype Password</label>
		<input type="password" name="repass" id="repass" class="validate[equals[pass]]" />
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
		<input name="cancel" type="button" id="cancel" value="Cancel" onclick="load_content('users')" />
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
