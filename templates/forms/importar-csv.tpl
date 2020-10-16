<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmImportarArchivo" action="#" class="form-horizontal form-bordered form-label-stripped">
			<input type="hidden" name="type" value="importar-csv" >
			<input type="hidden" name="table" value="{$post.table}">
		  <div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Adjuntar archivo</label>
					<div class="col-md-9">
							<input type="file" class="form-control" name="fileCsv" id="fileCsv" />
					</div>	
				</div> 
             </div>         
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>