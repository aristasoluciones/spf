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
				<a href="#">{$translates.menu.encuestaaplicada.label}</a>
				<i class="fa fa-circle"></i>
			</li>
			<li><a href="#">{$translates.menu.encuestaaplicada.child.geolocalizacion.label}</a></li>
		</ul>
		</div>
	</div>
	 <!-- BEGIN PAGE TITLE-->
		<h1 class="page-title"><p style="red">{$translates.menu.encuestaaplicada.child.geolocalizacionTitle.label}</p>
			<small></small>
		</h1>
	 <!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-sm-12">
			<div class="portlet light portlet-fit portlet-datatable bordered">
				<div class="portlet-title">
					<div class="caption">
					   <i class="icon-settings font-green"></i>
					   <span class="caption-subject font-green sbold">{$translates.menu.encuestaaplicada.child.geolocalizacion.label}</span>
					 </div>
				</div>
				<div class="portlet-body" id="tblContent">
				 <div id="contact-map" style="position: relative">
				 <div id="map_canvas" style="width:100%; height:600px"></div>
				 <div style="position: absolute; top: 60px; left: 16px; width: 250px; height: 100px; background-color: white; padding: 16px">
					 <ul class="list-unstyled">
						 <li><i class="fa fa-circle" style="color:#808080"></i> Pendiente por finalizar</li>
						 <li><i class="fa fa-circle" style="color:#ffff00"></i> Riesgo de violencia baja</li>
						 <li><i class="fa fa-circle" style="color:#ffa500"></i> Riesgo de violencia moderada</li>
						 <li><i class="fa fa-circle" style="color:#ff0000"></i> Riesgo de violencia severa</li>
					 </ul>
				 </div>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->
