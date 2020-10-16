<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="{$WEB_ROOT}/pedido">Pedidos</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#"></a></li>
		</ul>
		<div class="page-toolbar">
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title"> Pedidos realizados
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-8  col-md-offset-2">
            {include file="{$DOC_ROOT}/templates/forms/filtro-pedido.tpl"}
		</div>
		<div class="col-md-12" id="tbl-content-pedido">
			<div class="portlet box ">
				<div class="portlet-title">
					<div class="caption">
					   <i class="icon-settings font-green"></i>Lista de pedidos
					 </div>  
				</div>
				<div class="portlet-body">
				 <div class="table-responsive" id="tblContent">
				 	{include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
				 </div>
				 
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	