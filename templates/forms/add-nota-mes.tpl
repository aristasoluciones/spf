<div class="portlet-title">
	<div class="caption">
		<i class="icon-settings font-green"></i>
		Subir o actualizar nota del mes
	</div>
</div>
<div class="portlet-body form">
	<form  enctype="multipart/form-data" id="frmImg" action="#" method="post" class="form-horizontal form-bordered form-label-stripped">
	 	{if $infox}
		<input type="hidden" name="type" value="update" />
		<input type="hidden" name="id" value="{$info.imagenId}" />
		{else} 
		<input type="hidden" name="type" value="save" />
		{/if}

		<div class="form-body">
		    <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> * </span>Titulo de la nota</label>
                        <div class="col-md-9">
                           <input class="form-control" name="tituloNota" id="tituloNota">
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                 	 <div class="form-group">
					 <font color="red">Se recomiendan imagenes de 600 x 300 Píxeles</font>
                 	 	<label class="control-label col-md-3"><span class="reqIcon"> * </span>Archivo adjunto</label>
                        <div class="col-md-9">
						 	<input type="file" id="doc_file" name="doc_file">
							<p class="help-block">Subir archivos</p>
						</div>
					</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3" align="left"><span class="reqIcon"> * </span>Descripcion</label>
                        <div class="col-md-9">
                           <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
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
                    <button type="button" class="btn green"  onclick="SaveReg()">Guardar cambios</button>
                    <!-- <button type="button" class="btn default" onclick="hidenForm()">Cancel</button> -->
                </div>
            </div>
        </div>
	</form>
</div>