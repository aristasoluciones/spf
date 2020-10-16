<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	{include file="{$DOC_ROOT}/templates/1-default-meta.tpl"}
	{include file="{$DOC_ROOT}/templates/2-default-css.tpl"}
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAnqTo73i_KpH32wfpQbFVZOTUPuSIZ1A&sensor=true"></script>
</head>
<body  class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-boxed"> --> <!-- agregar container para page boxed-->
    <!-- BEGIN WRAPPER-->
	<div class="page-wrapper">
	<!-- BEGIN HEADER -->
	{include file="{$DOC_ROOT}/templates/header.tpl"}
	<!-- END HEADER -->
	<!-- BEGIN HEADER & CONTENT DIVIDER -->
     <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
	
	<!-- <div class="container"> --> <!-- agregar container para page boxed-->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<div class="page-sidebar-wrapper">
		  <!-- BEGIN SIDEBAR -->
			{include file="{$DOC_ROOT}/templates/menus/main.tpl"}
			
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
		 <div id="draggable" class="modal fade draggable-modal" tabindex="-1" role="dialog"  aria-hidden="true">
         </div>
         <div class="modal fade bs-modal-lg" id="large" tabindex="-1" role="dialog" aria-hidden="true">
         </div>
		  <!-- BEGIN CONTENT BODY -->
         <div class="page-content">
		  {include file="{$DOC_ROOT}/templates/{$page}.tpl"}
		  </div>
		  <!-- END CONTENT BODY-->
        </div>
	  </div>
	<!-- </div> -->
	<!-- END CONTAINER-->
    <!-- <div class="container"> -->
	{include file="{$DOC_ROOT}/templates/footer.tpl"}
    <!-- </div> -->
	{include file="{$DOC_ROOT}/templates/3-default-js.tpl"}
    
	<script type="text/javascript">
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins		   
		});
	</script>
   
   </div> 
   <!-- END WRAPPER-->   
</body>
</html>