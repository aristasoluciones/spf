<div class="portlet-title">
	<div class="caption">
		<i class="icon-settings font-green"></i>
		Agregar nueva imagen
	</div>
</div>
<div class="portlet-body form">
	<form  enctype="multipart/form-data" id="frmImg" action="#" method="post" class="form-horizontal form-bordered form-label-stripped">
	 	{if $info}
		<input type="hidden" name="type" value="update" />
		<input type="hidden" name="id" value="{$info.imagenId}" />
		<input type="hidden" name="rol_actual" value="{$info.role_id}" />
		{else} 
		<input type="hidden" name="type" value="save" />
		{/if}

		<div class="form-body">
		    <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> * </span>Tipo</label>
                        <div class="col-md-9">
                            <select onChange='verForm(this)' name="tipo_imagen" id="tipo_imagen" class="form-control">
                                <option value="empty">Selecccione una opcion...</option>
                            	<option value="slider">Slider</option>
                            	<option value="producto">Imagen producto</option>
                            </select>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                 	 <div class="form-group">
                 	 	<label class="control-label col-md-3"><span class="reqIcon"> * </span>Archivo imagen</label>
                        <div class="col-md-9">
						 	<input type="file" id="image_file" name="image_file">
							<p class="help-block">Subir archivos</p>
						</div>
					</div>
                </div>
            </div>
            <div class="row" id="row_detail" style="display:none">
            	<div class="col-md-6">
            		<div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon">*</span>Asignar a producto</label>
                        <div class="col-md-9">
                        	<select class="form-control" name="producto_id" id="producto_id">
                                <option value="">Seleccione.....</option>
                                {foreach from=$listp item=item key=key}
                                     <option value="{$item.categoriaId}">{$item.nombre}</option>    
                                {/foreach}
                            </select>
                        </div>
                    </div>
            	</div>
            	<div class="col-md-6">
            		<div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon">*</span>Descripcion imagen</label>
                        <div class="col-md-9">
                            {if !$info}
                             <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
                            {else}
                             <textarea class="form-control" name="descripcion" id="descripcion">{$info.descripcion}</textarea>
                            {/if}
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
                    <button type="button" class="btn default" onclick="hidenForm()">Cancel</button>
                </div>
            </div>
        </div>
	</form>
</div>