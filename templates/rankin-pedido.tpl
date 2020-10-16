<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">SIV</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="">Analisis de pedidos</a></li>
		</ul>
	</div>
	 <!-- BEGIN PAGE TITLE-->
	<h1 class="page-title">Ranking de pedidos
		<small></small>
	</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">

			<div class="portlet light portlet-fit bordered">
				<div class="portlet-title">
                    {include file="{$DOC_ROOT}/templates/forms/filtro-rankin.tpl"}
				</div>
				<div class="portlet-body" id="tblContent">
						<center>Utilize el filtro para realizar la busqueda</center>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	