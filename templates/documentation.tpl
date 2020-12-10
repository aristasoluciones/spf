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
		</ul>
		</div>
	</div>
<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-sm-12">
			<div class="portlet light portlet-fit portlet-datatable bordered">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-settings font-green"></i>
						<span class="caption-subject font-green sbold">{$translates.menu.documentation.label}</span>
					</div>
				</div>
				<div class="portlet-body" id="tblContent">
					<a  href="{$WEB_ROOT}/download.php?file={$translates.menu.documentation.child.userDoc.file}"class="btn btn-success btn-lg" title="{$translates.menu.documentation.child.userDoc.label}">
						{$translates.menu.documentation.child.userDoc.label}
						<i class="fa fa-cloud-download fa-2x" style="vertical-align: middle"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT-->
