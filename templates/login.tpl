<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]--><head>
	{include file="{$DOC_ROOT}/templates/1-default-meta.tpl"}
    {include file="{$DOC_ROOT}/templates/2-default-css.tpl"}
	
    {if $page == "login"}
	 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
     <!-- END PAGE LEVEL PLUGINS -->
	   <link href="assets/pages/css/login-3.min.css" rel="stylesheet" type="text/css" />
    {/if}
    
</head>

<body class="login"  style="background: url({$WEB_ROOT}/images/body2.jpg) !important;  background-repeat: no-repeat;">
	    
	<div class="logo">
    
		
	</div>
	<div class="content" style="background-color: rgba(255,255,255, 0.3); height:450px">
		{include file="{$DOC_ROOT}/templates/forms/login.tpl"}
		
	</div>
    	    
	{include file="{$DOC_ROOT}/templates/footer.tpl"}	
    {include file="{$DOC_ROOT}/templates/3-default-js.tpl"}
    
	<!-- <script src="assets/scripts/app.js" type="text/javascript"></script>   -->  
	<script type="text/javascript">
		jQuery(document).ready(function() {     
		  App.init();
		});
	</script>

</body>
</html>