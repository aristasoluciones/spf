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
				<a href="#">Pagina Web</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Imagenes</a></li>
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">Imagenes
			<small></small>
		</h1>

		<a href="{$WEB_ROOT_P}/index_dev" target="_blank" style="background:#2196F3; color:white; font-size:20px">
		Vista Previa
		</a>
		</button>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="portlet light portlet-fit portlet-datatable bordered">
			<div class="portlet-title">
				<div class="caption">
				   <i class="icon-settings font-green"></i>
				   <span class="caption-subject font-green sbold">Imagenes</span>
				 </div>  
				<div class="actions">
				    <div class="btn-group btn-group-devided" data-toggle="buttons">
						{if in_array(37,$privilegios) or $Usr.rolId eq 1}
							<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
								Agregar <i class="fa fa-plus"></i>
							</a>
						{/if}
					</div>
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	