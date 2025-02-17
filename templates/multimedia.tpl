<!-- BEGIN PAGE HEADER-->
	<div class="page-bar">
		<div class="span12">
			<h3 class="page-title">
				<!--Dependencia-->
			</h3>
		 <ul class="page-breadcrumb">
			 <li>
				 <i class="icon-home"></i>
				 <a href="{$WEB_ROOT}">{$translates.menu.inicio.label}</a>
				 <i class="fa fa-circle"></i>
			 </li>
			 <li>
				 <a href="#">{$translates.menu.documentation.label}</a>
				 <i class="fa fa-circle"></i>
			 </li>
			 <li>
				 <a href="#">{$translates.menu.documentation.child.videoTutorial.label}</a>
			 </li>
		</ul>
		</div>
	</div>
	<!-- BEGIN PAGE TITLE-->
	<h1 class="page-title">
		<small></small>
	</h1>
<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-sm-4">
			<div class="portlet light portlet-fit portlet-datatable bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings font-green"></i>
						<span class="caption-subject font-green sbold">Introduccion al sistema</span>
					</div>
				</div>
				<div class="portlet-body" id="tblContent">
					<video loop muted controls style="width: 100%">
						<source src="{$WEB_ROOT}/videos/introduccion.mp4" />
					</video>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="portlet light portlet-fit portlet-datatable bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings font-green"></i>
						<span class="caption-subject font-green sbold">Configuraciones</span>
					</div>
				</div>
				<div class="portlet-body" id="tblContent">
					<video loop muted controls style="width: 100%">
						<source src="{$WEB_ROOT}/videos/configuracion.mp4" />
					</video>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="portlet light portlet-fit portlet-datatable bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings font-green"></i>
						<span class="caption-subject font-green sbold">Catalogos</span>
					</div>
				</div>
				<div class="portlet-body" id="tblContent">
					<video loop muted controls style="width: 100%">
						<source src="{$WEB_ROOT}/videos/catalogo.mp4" />
					</video>
				</div>
			</div>
		</div>
	</div>
<div>
	<div class="col-sm-4">
		<div class="portlet light portlet-fit portlet-datatable bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="icon-settings font-green"></i>
					<span class="caption-subject font-green sbold">Encuestas aplicadas</span>
				</div>
			</div>
			<div class="portlet-body" id="tblContent">
				<video loop muted controls style="width: 100%">
					<source src="{$WEB_ROOT}/videos/encuesta.mp4" />
				</video>
			</div>
		</div>
	</div>
</div>
	<!-- END PAGE CONTENT-->
