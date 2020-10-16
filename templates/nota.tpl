<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		<div class="span12">           
			<h3 class="page-title">
				<!--Dependencia-->
			</h3>
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Configuracion</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Notal del mes</a></li>
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Nota del mes
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="portlet light portlet-fit portlet-datatable bordered">			
			 {include file="{$DOC_ROOT}/templates/forms/add-nota-mes.tpl"}	
		</div>		  
	</div>
	<div class="clearfix"></div>
	<div class="portlet light portlet-fit portlet-datatable bordered">
	 <div class="portlet-title">
		<div class="caption">
			<h2><b>Nota actual</b><h2>
		</div>
	 </div>
	 <div class="blog-page blog-content-2">
		 <div class="row">
		 	{include file="{$DOC_ROOT}/templates/forms/nota-actual.tpl"}	
		 </div>
	 </div>
	 </div>
	<!-- END PAGE CONTENT-->	