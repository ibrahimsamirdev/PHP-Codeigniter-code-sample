<?php
	//if the page is called from "load_content" function then just load the contents without header and footer
	if(@$_POST['is_loader'])
	{
		$this->load->view($main_content);
		exit;
	}
?>

<?php $this->load->view("header"); ?>
<?php $this->load->view("top_menu"); ?>

<script language="javascript" type="text/javascript">
	//load content(ex. page) into target(ex. form_loader) [called from any where]
	//target[the dive to load into], source_hide[the dive you want to hide before load(used to hide form in add project/unit)]
	function load_content(url, target, source_hide){
		if( ! target){
			target		=	'#content_panel';
		}
		//if there is no source to hide, or the target to hide is visible(i.e it's a visible tab)
		//then hide then display the target itself (ex. tab_loader)
		if( ! source_hide || $(target).is(":visible") ){
			source_hide	=	target;
		}
		//display loading
		if($("#loading div").css("display") == "none") {  
			$("#loading div").fadeIn(300);
			if($.validationEngine)
				$.validationEngine.closePrompt('.formError',true);
		} 
		$(source_hide).fadeOut(300, function(){
			$(target).load(url,{ 'is_loader': "1" }, function(){
						//hide loading
						$("#loading div").fadeOut(300);
						$(target).fadeIn("slow");
					}
			);
		});
	}// end function load_content
	
	
	//highslide popup
	hs.graphicsDir = 'css/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.align = 'center';
	//hs.objectType = 'ajax';
	hs.transitions = ["fade"];
	hs.dimmingOpacity = 0.01;
	hs.width = 570;
	hs.allowHeightReduction = false;
	hs.allowSizeReduction = false;
	hs.wrapperClassName = 'draggable-header';
	hs.onDimmerClick = function() {
      return false;
	}
	
	hs.Expander.prototype.onAfterClose = function(){
		if($.validationEngine)
			$.validationEngine.closePrompt('.formError',true);
	}
	//load form into hidden div then call popup function to show it
	function load_form(url, title){
		$("#loading div").fadeIn(300);
		$('.highslide-maincontent').load(url,{ 'is_loader': "1" }, function(){
				$("#loading div").fadeOut(300);
				//when loading finish
				$("#popup_init").click(function (){
					return hs.htmlExpand(this, { headingText: title} );
				}).trigger("click");
		});
	}//end function load_form
</script>
<div style="height:100%;">
	<div id="side_panel">
		<?php $this->load->view("side_panel"); ?>
    </div>
	<div style="float:left; width:80%">
		<?php $this->load->view("preloader"); ?>
		<div id="content_panel">
			<?php $this->load->view($main_content); ?>
		</div>
	</div>
</div>
<?php $this->load->view("footer"); ?>