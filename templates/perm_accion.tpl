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
			<li><a href="#">Permisos del sistema</a></li>
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Permisos
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
				   <span class="caption-subject font-green sbold">Catalogo de acciones del sistema</span>
				 </div>  
				<div class="actions">
				    <div class="btn-group btn-group-devided" data-toggle="buttons"> 
					<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
						Agregar <i class="fa fa-plus"></i>
					</a>
					</div>
					<div class="btn-group" >
					 <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                       <i class="fa fa-share"></i>
                       <span class="hidden-xs">Acciones</span>
                       <i class="fa fa-angle-down"></i>
                     </a>
					 <ul class="dropdown-menu pull-right" id="sample_3_tools" >
						<li>
							<a href="javascript:;" data-action="0" class="tool-action">
							<i class="icon-printer"></i> Imprimir</a>
                        </li>
						<li>
							<a href="javascript:;" data-action="1" class="tool-action">
								<i class="icon-check"></i> Copiar</a>
						</li>
						<li>
							<a href="javascript:;" data-action="2" class="tool-action">
								<i class="icon-doc"></i> Exportar PDF</a>
						</li>
						<li>
							<a href="javascript:;" data-action="3" class="tool-action">
								<i class="icon-paper-clip"></i> Exportar Excel</a>
						</li>
						<li>
							<a href="javascript:;" data-action="4" class="tool-action">
								<i class="icon-cloud-upload"></i> Exportar CSV</a>
						</li>
					 </ul>
					</div>	
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	