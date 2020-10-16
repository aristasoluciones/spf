<div class="portlet-title">
	<div class="caption">
		<i class="icon-settings font-green"></i>
		Subir o actualizar catalogo electronico
	</div>
</div>
<div class="portlet-body form">
	<form  enctype="multipart/form-data" id="frmImg" action="#" method="post" class="form-horizontal form-bordered form-label-stripped">
	 	{if $infox}
		<input type="hidden" name="type" value="update" />
		<input type="hidden" name="id" value="{$info.imagenId}" />
		{else} 
		<input type="hidden" name="type" value="saveCatalogo" />
		{/if}

		<div class="form-body">
		    <div class="row">
                <!-- <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> * </span>Nombre catalogo</label>
                        <div class="col-md-9">
                           <input class="form-control" name="nameCat" id="nameCat">
                        </div>
                    </div>
                 </div> -->
                 <div class="col-md-6">
                 	 <div class="form-group">
					 <font color="red">Se recomiendan archivos en PDF</font>
                 	 	<label class="control-label col-md-3"><span class="reqIcon"> * </span>Archivo en PDF</label>
                        <div class="col-md-9">
						 	<input type="file" id="doc_file" name="doc_file">
							<p class="help-block">Subir archivos</p>
						</div>
					</div>
                </div>
            </div>
           
		</div>
		<div class="form-actions">
            <div class="row">
                 <span class="reqIcon">*</span> Campos requeridos
                 <div align="center" id="loader"></div>
                 <div align="center" id="txtErrMsg" class="alert alert-danger" style="display:none"></div>
                <div class="col-md-offset-4 col-md-9">
                    <button type="button" class="btn green"  onclick="SaveReg()">Guardar</button>
                </div>
            </div>
        </div>
	</form>
</div>