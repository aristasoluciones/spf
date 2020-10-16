<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Pagigna web</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Categorias de productos</a></li>
		</ul>
		<div class="page-toolbar">
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Categorias de productos
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
				   <span class="caption-subject font-green sbold">Lista de categorias de productos</span>
				 </div>  
				<div class="actions">
					<div class="btn-group btn-group-devided">
						<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
							Agregar <i class="fa fa-plus"></i>
						</a>
					</div>
                    {if in_array('add_producto',$privilegios) or $usr.role_id==1}
				    <div class="btn-group btn-group-devided" data-toggle="buttons">

						<a class="btn green-jungle btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
							<i class="fa fa-files-o"></i>
							<span class="hidden-xs">Importar</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:;" data-action="0"  class="tool-action"  title="Importar desde excel(XLS,XLSX,CSV)" onClick="openImportarCsv('categoria')">
									 <i class="fa green fa-file-excel-o"></i>Importar
								</a>
							</li>
							<li>
								<a href="javascript:;" data-action="false" class="tool-action" onclick="downloadFormat(1)" target="_blank"  title="Formato de importacion">
									 <i class="fa fa-file-o"></i>Descargar formato
								</a>
							</li>
						</ul>
					</div>
                    {/if}
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