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
				<a href="#">SmartTest</a>
				<i class="fa fa-circle"></i>
			</li>
			
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Resultados
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="portlet light portlet-fit portlet-datatable bordered">
			<div class="portlet-title">
				<div class="caption">
				   <i class="icon-settings font-green"></i>
				   <span class="caption-subject font-green sbold">{$info.nombre}</span>
				 </div>  
				<div class="actions">
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
				<div class="tabbable portlet-tabs">
		<ul class="nav nav-tabs">
			
			<li class="active">
				
				<a href="#portlet_tabp_1" data-toggle="tab">Opción multiple</a>
			</li>
			<li >
				<a href="#portlet_tabp_2" data-toggle="tab">
					Preguntas abiertas
				</a>
			</li>
		</ul>
		<div class="tab-content">
		
			<div class="tab-pane active" id="portlet_tabp_1">				
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span12">           
							<h3 class="page-title">
							</h3>
						</div>
					</div>
				{include file="{$DOC_ROOT}/templates/lists/poll-analytics.tpl"}
				</div>	
			</div>
			<div class="tab-pane " id="portlet_tabp_2" >	
				{include file="{$DOC_ROOT}/templates/lists/poll-analytics-open.tpl"}
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	