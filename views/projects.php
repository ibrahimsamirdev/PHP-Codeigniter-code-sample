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
		conf=confirm("Are you sure you want to delete this Project?");
		if(conf)
		{
			load_content('projects/delete/'+recid);
		}
	}
</script>
<div id="container">
  <div class="form_block">
  <div class="form_title">
    <div style="float:right"><a href="javascript:load_content('projects/add')">+ Add</a></div>
  PROJECTS</div>
  <div style="height:1px"></div>
  <?php
		if($projects){
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      
      <tr>
        <td width="9%" align="center" valign="middle" class="tabletitles" style="border-left:#8CADBD solid 1px">Status</td>
        <td width="69%" height="24" align="center" valign="middle" class="tabletitles">Project Name </td>
        <td width="8%" align="center" valign="middle" class="tabletitles">Units</td>
        <td width="6%" align="center" valign="middle" class="tabletitles">Edit</td>
        <td width="8%" align="center" valign="middle" class="tabletitles">Delete</td>
      </tr>
      <?php
	  	$colorflag	= FALSE;
		//display the result (records)
		foreach($projects as $project){
	  ?>
      <tr style="background-color:<?php if($colorflag){echo "#e8ebee"; $colorflag=false;}else{echo "#f4f5f6"; $colorflag=true;}?>">
        <td align="center" valign="middle" class="text1" >
		<img <?=$project->status?"src='images/active.png' title='Active'":"src='images/notactive.png' title='Not Active'"?> width="16" height="16" /></td>
        <td height="38" valign="middle" ><div style="padding-left:10px" class="link1"> <a href="javascript:load_content('units/<?=$project->id?>')">
            <?=$project->name?>
        </a></div></td>
        <td align="center" valign="middle"><a href="javascript:load_content('units/<?=$project->id?>')"><img src="images/search2.png" width="29" height="30" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:load_content('projects/edit/<?=$project->id?>')"><img src="images/edit.png" width="24" height="24" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:delconfirm(<?=$project->id?>)"><img src="images/del.png" width="24" height="24" border="0" /></a></td>
      </tr>
      <?
			}//end foreach
		?>
      <tr>
        <td></td>
        <td height="25"></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
	<?php
		}//end if ($projects)
		else{
	?>
		<div style="text-align:center; padding:50px">No Projects defined. Please add one.</div>
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
