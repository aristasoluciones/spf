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
				<a href="{$WEB_ROOT}/done-polls">{$translates.menu.encuestaaplicada.label}</a>
				<i class="fa fa-circle"></i>
			</li>
			 <li>
				 <a href="{$WEB_ROOT}/done-polls">{$translates.menu.encuestaaplicada.child.encuestarealizada.label}</a>
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
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-layers font-red"></i>
						<span class="caption-subject font-red bold uppercase">{$translates.menu.encuestaaplicada.child.encuestarealizada.label}</span>
					</div>
				</div>
				<div class="portlet-body">
					{include file="{$DOC_ROOT}/templates/lists/{$page}.tpl"}
				</div>
		</div>
	</div>
