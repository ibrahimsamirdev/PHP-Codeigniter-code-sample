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
	function delconfirm(country_id, city_id, recid)
	{
		conf=confirm("Are you sure you want to delete this Area?");
		if(conf)
		{
			load_content('areas/delete/'+country_id+'/'+city_id+'/'+recid);
		}
	}
</script>
<div id="container">
  <div class="form_block2"><a href="javascript:load_content('cities/<?=$country_id?>')"><img src="images/ico-back.png" width="48" height="40" border="0" /></a></div>
  <div class="form_block">
  <div class="form_title">
    <div style="float:right"><a href="javascript:load_content('areas/add/<?=$country_id?>/<?=$city_id?>')">+ Add</a></div>
  AREAS</div>
  <div style="height:1px"></div>
	<?php
		if($areas){
	?>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      
      <tr>
        <td width="82%" height="24" align="center" valign="middle" class="tabletitles" style="border-left:#8CADBD solid 1px">Area Name</td>
        <td width="9%" align="center" valign="middle" class="tabletitles">Edit</td>
        <td width="9%" align="center" valign="middle" class="tabletitles">Delete</td>
      </tr>
      <?php
	  	$colorflag	= FALSE;
		//display the result (records)
		
		foreach($areas as $area){
	  ?>
      <tr style="background-color:<?php if($colorflag){echo "#e8ebee"; $colorflag=false;}else{echo "#f4f5f6"; $colorflag=true;}?>">
        <td height="38" valign="middle" ><div style="padding-left:10px" class="link1"> <a href="javascript:load_content('areas/edit/<?=$country_id.'/'.$city_id.'/'.$area->id?>')">
            <?=$area->name?>
        </a></div></td>
        <td align="center" valign="middle"><a href="javascript:load_content('areas/edit/<?=$country_id.'/'.$city_id.'/'.$area->id?>')"><img src="images/edit.png" width="24" height="24" border="0" /></a></td>
        <td align="center" valign="middle"><a href="javascript:delconfirm('<?=$country_id?>','<?=$city_id?>',<?=$area->id?>)"><img src="images/del.png" width="24" height="24" border="0" /></a></td>
      </tr>
      <?
			}//end foreach
		?>
      <tr>
        <td height="25"></td>
        <td></td>
        <td></td>
      </tr>
    </table>
	<?php
		}//end if ($areas)
		else{
	?>
		<div style="text-align:center; padding:50px">No Areas defined in this City</div>
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
