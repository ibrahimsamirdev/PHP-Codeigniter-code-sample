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
<script language="javascript" type="text/javascript">
	setTimeout("window.location.href='<?=base_url()?>'",3000);
</script>
<div class="form_block" id="login_success">
  <div class="form_title">Login Successful</div>
  <div class="form"> <br />
    <br />
	welcome: <strong><?=sess_var('name')?></strong><br /><br />
    You are loged in as: <strong>
    <?=$email?>
    </strong><br />
    <br />
    You can now proceed to <a href="<?=base_url()?>">Admin control panel</a>.<br />
    <br />
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
