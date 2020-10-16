{if $page == "login"}
	<section id="login" class="container_12 clearfix">
		{include file="login.tpl"}
	</section>
  
{else}

    <!-- The container of the sidebar and content box -->
    <div role="main" id="main" class="container_12 clearfix">
   	 	<!-- The top menu blue bar -->
			{include file="boxes/blue-bar.tpl"}

   	 	<!-- The side menu bar -->
			{include file="menus/main.tpl"}
      
      	<!-- Here goes the content. -->
      	<section id="content" class="container_12 clearfix" data-sort=true>      
			{include file="templates/{$pageTpl}.tpl"}	
        </section>
      

    </div>
{/if}