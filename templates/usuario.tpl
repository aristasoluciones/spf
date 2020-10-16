<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
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
			<li><a href="{$WEB_ROOT}/usuario">Usuarios</a></li>
		</ul>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title"> Usuarios
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
				   <span class="caption-subject font-green sbold">Lista usuarios</span>
				 </div>  
				<div class="actions">
				    <div class="btn-group btn-group-devided" data-toggle="buttons"> 
					<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
						Agregar <i class="fa fa-plus"></i>
					</a>
					</div>
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	