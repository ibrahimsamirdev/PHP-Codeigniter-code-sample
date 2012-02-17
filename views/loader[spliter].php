<?php
	//if the page is called from loader.php then just load the contents without header and footer
	if(@$_POST['is_loader'])
	{
		$this->load->view($main_content);
		exit;
	}
?>

<?php $this->load->view("header"); ?>

<script language="javascript" type="text/javascript">
	function load_content(url){
		//display loading
		if($("#loading div").css("display") == "none") {  
			$("#loading div").fadeIn(300);
			if($.validationEngine)
				$.validationEngine.closePrompt('.formError',true);
		} 
		$("#content_panel").fadeOut("fast", function(){
			$("#content_panel").load(url,{ 'is_loader': "1" }, function(){
						//hide loading
						$("#loading div").fadeOut(300);
						$("#content_panel").fadeIn("slow");
					}
			);
		});
	}
</script>
<div style="height:100%;">
	<div id="side_panel">
		<?php $this->load->view("side_panel"); ?>
    </div>
	<div style="float:left; width:80%; height:100%; background:#FFCC99; overflow:scroll">
		<?php $this->load->view("preloader"); ?>
		<div id="content_panel">
			<?php $this->load->view('welcome_message'); ?>
		</div>
	</div>
</div>
<?php $this->load->view("footer"); ?>