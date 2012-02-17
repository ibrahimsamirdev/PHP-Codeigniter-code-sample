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
<script type="text/javascript">
	//deletion confirmation
	function delconfirm(recid)
	{
		conf=confirm("Are you sure you want to delete this Country?");
		if(conf)
		{
			load_content('countries/delete/'+recid);
		}
	}
</script>
<div id="container">
  <div class="form_block">
  <div class="form_title">
    <div style="float:right"><a href="javascript:load_content('countries/add')">+ Add</a></div>
  COUNTRIES</div>
  <div style="height:1px"></div>
  <?php
		if($countries){
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      
      <tr>
        <td width="70%" height="24" align="center" valign="middle" class="tabletitles" style="border-left:#8CADBD solid 1px">Country Name</td>
        <td width="7%" align="center" valign="middle" class="tabletitles">Cities</td>
        <td width="6%" align="center" valign="middle" class="tabletitles">Edit</td>
        <td width="8%" align="center" valign="middle" class="tabletitles">Delete</td>
      </tr>
      <?php
	  	$colorflag	= FALSE;
		//display the result (records)
		foreach($countries as $country){
	  ?>
      <tr style="background-color:<?php if($colorflag){echo "#e8ebee"; $colorflag=false;}else{echo "#f4f5f6"; $colorflag=true;}?>">
        <td height="38" valign="middle" ><div style="padding-left:10px" class="link1"> <a href="javascript:load_content('cities/<?=$country->id?>')">
            <?=$country->name?>
        </a></div></td>
        <td align="center" valign="middle"><a href="javascript:load_content('cities/<?=$country->id?>')"><img src="images/search2.png" width="29" height="30" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:load_content('countries/edit/<?=$country->id?>')"><img src="images/edit.png" width="24" height="24" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:delconfirm(<?=$country->id?>)"><img src="images/del.png" width="24" height="24" border="0" /></a></td>
      </tr>
      <?
			}//end foreach
		?>
      <tr>
        <td height="25"></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
	<?php
		}//end if ($countries)
		else{
	?>
		<div style="text-align:center; padding:50px">No Countries defined. Please add one.</div>
	<?php
		}//end else
	?>
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
