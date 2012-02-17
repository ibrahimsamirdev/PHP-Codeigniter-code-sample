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
	$("table#result td .del").click(function () {
		conf=confirm("Are you sure you want to delete this Video?");
		if(conf)
		{
			//load_content('files/delete/'+$(this).attr('href'));
			$(this).parent().parent().remove();
		}
		return false;
	});
</script>
<div class="form_block">
  <div class="form_title">
  VIDEOS</div>
  <div style="background:url(images/ico-videos.png) no-repeat top right">
    <div class="add" >
		<a href="javascript://" id="add" onclick="load_form('media/add/videos/<?=$entity_type?>/<?=$entity_id?>', 'Add Video')">Add Video</a>
		<a href="javascript://" id="popup_init"></a>
		<div class="highslide-maincontent"></div>
	</div>
    <?php
		if($videos){
	?>
	
    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="result">
      <!--DWLayoutTable-->
      <?php
	  	$colorflag	= FALSE;
		//display the result (records)
		foreach($videos as $video){
	  ?>
      <tr style="<?php if($colorflag){echo "background-color:#e8ebee"; $colorflag=false;}else{$colorflag=true;}?>">
        <td width="9%" align="center" valign="middle" class="text1" ><img <?=$video->status?"src='images/active.png' title='Active'":"src='images/notactive.png' title='Not Active'"?> width="16" height="16" /></td>
        <td width="70%" height="38" valign="middle" >
			<div class="link1"><a href="<?=$video->path.$video->name?>" target="_blank">
            <?=$video->name?>
        	</a></div>
		</td>
        <td width="7%" align="center" valign="middle"><a href="<?=$video->path.$video->name?>" target="_blank"><img src="images/search2.png" width="29" height="30" border="0" /></a></td>
        <td width="6%" align="center" valign="middle"><a href="javascript://" onclick="load_form('media/edit/videos/<?=$entity_type?>/<?=$entity_id?>/<?=$video->id?>', 'Edit Video')"><img src="images/edit.png" width="24" height="24" border="0" /></a></td>
        <td width="8%" align="center" valign="middle"><a href="<?=$video->id?>" class="del"><img src="images/del.png" width="24" height="24" border="0" /></a></td>
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
		}//end if ($videos)
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
