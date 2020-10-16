<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		<div class="span12">           
			<h3 class="page-title">
				<!--Dependencia-->
			</h3>
		 <ul class="page-breadcrumb">
			<li>
				<i class="icon-home"></i>
				<a href="{$WEB_ROOT}">Inicio</a>
				<i class="fa fa-circle"></i>
			</li>
			<li>
				<a href="#">Encuestas</a>
				<i class="fa fa-circle"></i>
			</li>
		 </ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title">
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
				   <span class="caption-subject font-green sbold">Encuesta </span>
				 </div>  
				<div class="actions">
				    <div class="btn-group btn-group-devided" data-toggle="buttons">
					{if in_array(21,$privilegios) or $Usr.rolId eq 1}
						<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg()">
							<i class="fa fa-plus"></i>Agregar
						</a>
					{/if}
					</div>
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/poll.tpl"}
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->	