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
				<a href="#">SIV</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Clientes</a></li>
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Clientes
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
				   <span class="caption-subject font-green sbold">Lista de clientes</span>
				 </div>  
				<div class="actions">
				    <!-- <div class="btn-group btn-group-devided" data-toggle="buttons"> 
					<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
						Agregar <i class="fa fa-plus"></i>
					</a>
					</div> -->
					<!--<div class="btn-group" >
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
					</div>	-->
				</div>
			</div>
			<form id="frmFiltro">
				<input type="hidden" name="type" value="buscarCliente">
				<div style="float:left">
				Nombre<input type="text" name="nombre" class="form-control" style="width:200px">
				</div>
				<div style="float:left">
				Sexo<select class="form-control" name="sexo"  class="form-control" style="width:200px">
					<option></option>
					<option>masculino</option>
					<option>femenino</option>
				</select>
				</div>
				<div style="float:left">
				Rango de fecha de nacimiento<br>
				<input type="text" name="inicio" id="fecha_1" class="form-control" style="width:100px; float:left" onClick="fechaPick(1)" >
				<input type="text" name="fin"   id="fecha_2" class="form-control" style="width:100px; float:left" onClick="fechaPick(2)">
				</div>
				<br>
				
			</form>
			<button class="btn green" onclick="buscarCliente()">Buscar</button>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	