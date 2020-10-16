<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="index.html">Inicio</a> 
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Categoria de productos</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Producto por categoria</a></li>
		</ul>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title"> 
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row ">
	   <div class="portlet light portlet-fit bordered">
			<div class="portlet-title">
				<div class="caption">
				   <i class="icon-settings"></i>
				  Lista de productos de la categoria {$row.nombre}
				 </div>
				 <div class="actions">
                     {if in_array('add_producto_categoria',$privilegios) or $usr.role_id==1}
					 <div class="btn-group btn-group-devided">
						 <a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg({$row.categoriaId})">
							 Agregar <i class="fa fa-plus"></i>
						 </a>
					 </div>
					 {/if}
                     {if in_array('add_producto',$privilegios) or $usr.role_id==1}
						 <div class="btn-group btn-group-devided" data-toggle="buttons">

							 <a class="btn green-jungle btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
								 <i class="fa fa-files-o"></i>
								 <span class="hidden-xs">Importar</span>
								 <i class="fa fa-angle-down"></i>
							 </a>
							 <ul class="dropdown-menu pull-right">
								 <li>
									 <a href="javascript:;" data-action="0"  class="tool-action"  title="Importar desde excel(XLS,XLSX,CSV)" onClick="openImportarCsv('producto')">
										 <i class="fa green fa-file-excel-o"></i>Importar
									 </a>
								 </li>
								 <li>
									 <a href="javascript:;" data-action="false" class="tool-action" onclick="downloadFormat(2)" target="_blank"  title="Formato de importacion">
										 <i class="fa fa-file-o"></i>Descargar formato
									 </a>
								 </li>
							 </ul>
						 </div>
                     {/if}
			    </div>  
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
			</div>
	   </div>
    </div>
	<!-- END PAGE CONTENT-->	