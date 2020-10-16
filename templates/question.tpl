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
				<a href="#">Encuestas</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">Agregar Preguntas</a></li>
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
				   <span class="caption-subject font-green sbold">Nombre de la encuesta: {$info.nombre}</span>
				 </div>  
				<div class="actions">
				    <div class="btn-group btn-group-devided" data-toggle="buttons">
						{if in_array(40,$privilegios) or $Usr.rolId eq 1}
							<a href="javascript:;" class="btn btn-circle sbold green" onClick="AddReg({$encuestaId})">
								<i class="fa fa-plus"></i> Agregar
							</a>
						{/if}
					</div>
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
			 {include file="{$DOC_ROOT}/templates/lists/question.tpl"}
			</div>
		</div>
		<center>
		    <b>Este documento deberá resguardarse conforme a lo establecido bajo la Ley  General de Protección de Datos Personales en Posesión de Sujetos Obligados, Artículo 45 Fracción 1,  de la Constitución Política del Estado de Chiapas</b>
	    </center>
	</div>
	<!-- END PAGE CONTENT-->	