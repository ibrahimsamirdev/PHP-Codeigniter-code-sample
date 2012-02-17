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
		//var querystr = $("#form").serialize();//+"&is_ajax=1";
		$.ajax({
			url		:	"<?=site_url('login/submit')?>",
			type	:	"POST",
			dataType:	"json",
			data	:	querystr,
			success	:	function(data){
			//hide loading
			$("#loading div").fadeOut(300);
				if(!data.is_valid){
					$.validationEngine.buildPrompt('#pass','Invalid Password','error');
				}else{
					/*if("<=$ref?>"){
						window.location.replace("<=$ref?>");
					}*/
					$("#container").fadeOut("fast",function(){
						$("#container").html(data.content);
						$("#container").fadeIn("slow");
					});
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
  <div class="form_block" id="login_form">
	<div class="form_title">Admin Login</div>
	<div class="form">
	<form action="<?=site_url('login/submit')?>" method="post" onsubmit="return false" id="form">
		<br />
		<div class="sepa">
		  <label for="email">Email</label>
		<input type="text" name="email" id="email" class="validate[required,custom[email]]" />
		</div>
		
		<div class="sepa">
		<label for="pass">Password</label>
		<input type="password" name="pass" id="pass" class="validate[required]" />
		</div>
		
		<div class="sepa">
		<label for="submit">&nbsp;</label>
		<input type="submit" value="Submit" /></div>
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
