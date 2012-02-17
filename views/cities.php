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
	function delconfirm(country_id, recid)
	{
		conf=confirm("Are you sure you want to delete this City?");
		if(conf)
		{
			load_content('cities/delete/'+country_id+'/'+recid);
		}
	}
</script>
<div id="container">
  <div class="form_block2"><a href="javascript:load_content('countries')"><img src="images/ico-back.png" width="48" height="40" border="0" /></a></div>
  <div class="form_block">
  <div class="form_title">
    <div style="float:right"><a href="javascript:load_content('cities/add/<?=$country_id?>')">+ Add</a></div>
  CITIES</div>
  <div style="height:1px"></div>
	<?php
		if($cities){
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      
      <tr>
        <td width="74%" height="24" align="center" valign="middle" class="tabletitles" style="border-left:#8CADBD solid 1px">City Name </td>
        <td width="10%" align="center" valign="middle" class="tabletitles">Areas</td>
        <td width="8%" align="center" valign="middle" class="tabletitles">Edit</td>
        <td width="8%" align="center" valign="middle" class="tabletitles">Delete</td>
      </tr>
      <?php
	  	$colorflag	= FALSE;
		//display the result (records)
		
		foreach($cities as $city){
	  ?>
      <tr style="background-color:<?php if($colorflag){echo "#e8ebee"; $colorflag=false;}else{echo "#f4f5f6"; $colorflag=true;}?>">
        <td height="38" valign="middle" ><div style="padding-left:10px" class="link1"> <a href="javascript:load_content('areas/<?=$country_id.'/'.$city->id?>')">
            <?=$city->name?>
        </a></div></td>
        <td align="center" valign="middle" ><a href="javascript:load_content('areas/<?=$country_id.'/'.$city->id?>')"><img src="images/search2.png" width="29" height="30" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:load_content('cities/edit/<?=$country_id.'/'.$city->id?>')"><img src="images/edit.png" width="24" height="24" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:delconfirm('<?=$country_id?>',<?=$city->id?>)"><img src="images/del.png" width="24" height="24" border="0" /></a></td>
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
		}//end if ($cities)
		else{
	?>
		<div style="text-align:center; padding:50px">No Cities defined in this Country</div>
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
