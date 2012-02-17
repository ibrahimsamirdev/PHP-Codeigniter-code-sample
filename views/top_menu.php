<div class="menu">
<script type="text/javascript"> 
$(document).ready(function(){
	
	$(".mi").hover(function() {
			var timeout = $(this).data("timeout");
    		if(timeout) clearTimeout(timeout);
      
			$(this).find("span").addClass("subhover");
			$(this).find("ul.subnav").slideDown('fast').show();
		},
		function(){
				//$(this).find("ul.subnav").slideUp('slow'); 
				//$(this).find("span").removeClass("subhover");
				$(this).data("timeout", setTimeout($.proxy(function() 
				{ 
					$(this).find("ul.subnav").slideUp('slow'); 
					$(this).find("span").removeClass("subhover");
				}, this), 500)); 
			}
	);

});
</script>
<ul class="topnav">
      <li><a href="javascript:load_content('projects')">Home</a></li>
      <li class="mi">
          <a href="javascript:load_content('projects')">Projects</a>
          <ul class="subnav">
              <li><a href="javascript:load_content('projects')">Projects List</a></li>
              <li><a href="javascript:load_content('projects/add')">Create Project</a></li>
          </ul>
		  <span></span>
      </li>
      <li class="mi">
          <a href="#">Units</a>
          <ul class="subnav">
              <li><a href="javascript:load_content('units/0')">Units List</a></li>
              <li><a href="javascript:load_content('units/add/0')">Create Unit</a></li>
          </ul>
		  <span></span>
      </li>
      <li class="mi">
          <a href="#">Classes</a>
          <ul class="subnav">
              <li><a href="javascript:load_content('countries')">Manage Countries</a></li>
              <li><a href="#">Manage Cities</a></li>
              <li><a href="#">Manage Areas</a></li>
              <li><a href="javascript:load_content('classes/6')">Unit Types</a></li>
          </ul>
		  <span></span>
      </li>
      <li class="mi">
          <a href="#">Admin</a>
          <ul class="subnav">
              <li><a href="#">Admin Profile</a></li>
              <li><a href="javascript:load_content('users')">Manage Users</a></li>
              <li><a href="javascript:load_content('users/add')">Create User</a></li>
          </ul>
		  <span></span>
      </li>
      <li><a href="#">Help</a></li>
</ul>
<div class="login_welcome">
  welcome <strong><?=sess_var('name')?></strong> <a href="login/logout">logout</a>
</div>
<div style="clear:both"></div>
</div>