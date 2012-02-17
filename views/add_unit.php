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
			url		:	"<?=site_url('units/submit/'.$project_id.'/'.@$id)?>",
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
						$.validationEngine.buildPrompt('#name','Unit already exists','error');
					}
					else{
						/*$("#container").fadeOut("fast",function(){
							$("#container").html(data.content);
							$("#container").fadeIn("slow");
						});*/
						load_content('units/<?=$project_id?>');
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
<div class="toolbar"><a href="javascript:load_content('units/<?=$project_id?>')"><img src="images/ico-back.png" width="48" height="40" border="0" align="left" style="padding-top:13px" /></a><a href="javascript://" title="Unit Info." id="info"><img src="images/imgs_2x3.png" width="53" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/images/2/<?=@$id?>','#tab_loader','#form_loader')" title="Images"><img src="images/imgs_2x4.png" width="61" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/videos/2/<?=@$id?>','#tab_loader','#form_loader')" title="Videos"><img src="images/imgs_2x5.png" width="54" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/files/2/<?=@$id?>','#tab_loader','#form_loader')" title="Files"><img src="images/imgs_2x6.png" width="57" height="51" border="0" /></a><a href="javascript:load_content('media/get_media/links/2/<?=@$id?>','#tab_loader','#form_loader')" title="Links"><img src="images/imgs_2x7.png" width="52" height="51" border="0" /></a>
  <div style="clear:both"></div>
</div>
<?php
	}//end if id
?>
<div id="form_loader">
  <div class="form_block" id="add_unit">
    <div class="form_title">
      <?=@$id?"Edit Unit":"Create Unit"?>
    </div>
    <div class="form" style="background:url(images/ico-units.png) no-repeat top right">
      <form action="<?=site_url('units/submit/'.$project_id.'/'.@$id)?>" method="post" onsubmit="return false" id="form">
        <br />
        <div class="sepa">
          <label for="name">Name</label>
          <input name="name" type="text" id="name" value="<?=@$name?>" class="validate[required]" />
        </div>
        <div class="sepa">
          <label for="status">Status</label>
          <select name="status" id="status">
            <option value="1" selected="selected" >Active</option>
            <option value="0" <?=(isset($status) && ! @$status)? "selected='selected'":"" ?> >Not Active</option>
          </select>
        </div>
        <div class="sepa">
          <label for="label">Availability</label>
          <select name="availability" id="label">
            <option value="forsale" selected="selected">For sale</option>
            <option value="notforsale">Not for sale</option>
            <option value="reserved">Reserved</option>
            <option value="sold">Sold</option>
          </select>
        </div>
        <div class="sepa">
          <label for="label2">Price</label>
          <input name="price" type="text" id="label2" value="<?=@$price?@$price:''?>" class="validate[optional,custom[onlyNumber]] textbox1" />
        </div>
        <div class="sepa">
          <label for="label3">Country</label>
          <select name="country" id="label3">
            <option value="0" selected="selected"></option>
            <option value="1">Egypt</option>
            <option value="2">Lybia</option>
            <option value="3">Saudi Arabia</option>
          </select>
        </div>
        <div class="sepa">
          <label for="label4">City</label>
          <select name="city" id="label4">
            <option value="0" selected="selected"></option>
            <option value="1">Alexandria</option>
            <option value="2">Cairo</option>
          </select>
        </div>
        <div class="sepa">
          <label for="label5">Area</label>
          <select name="area" id="label5">
            <option value="0" selected="selected"></option>
            <option value="1">Ain Shams</option>
            <option value="2">Mohandseen</option>
          </select>
        </div>
        <div class="sepa">
          <label for="label6">Address</label>
          <input name="address" type="text" id="label6" value="<?=@$address?>" />
        </div>
        <div class="sepa">
          <label for="label7">Unit Area </label>
          <input name="unitarea" type="text" id="label7" value="<?=@$unitarea?@$unitarea:''?>" class="validate[optional,custom[onlyNumber]] textbox1" />
        </div>
        <div class="sepa">
          <label for="label8">Bed Rooms</label>
          <input name="bedrooms" type="text" id="label8" value="<?=@$bedrooms?@$bedrooms:''?>" class="validate[optional,custom[onlyNumber]] textbox1" />
        </div>
        <div class="sepa">
          <label for="label9">Bath Rooms</label>
          <input name="bathrooms" type="text" id="label9" value="<?=@$bathrooms?@$bathrooms:''?>" class="validate[optional,custom[onlyNumber]] textbox1" />
        </div>
        <div class="sepa">
          <label for="label10">Link</label>
          <input name="link" type="text" id="label10" value="<?=@$link?>" class="validate[optional,custom[url]]" />
        </div>
        <div class="sepa">
          <label for="email">Description</label>
          <textarea name="description" id="description"><?=@$description?>
</textarea>
        </div>
        <div class="sepa">
          <label for="submit">&nbsp;</label>
          <input type="submit" value="Submit" />
		  &nbsp;&nbsp;
		<input name="cancel" type="button" id="cancel" value="Cancel" onclick="load_content('units/<?=$project_id?>')" />
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
