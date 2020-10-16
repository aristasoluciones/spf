<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">
			{if $info}
			<input type="hidden" name="type" value="update" />
			<input type="hidden" name="id" value="{$info.sucursalid}" />
            {else}
			<input type="hidden" name="type" value="save" />
			{/if}
		  <div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Nombre</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="nombre" value=""  />
						{else}
							<input type="text" class="form-control" name="nombre" value="{$info.nombre}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Descripcion</label>
					<div class="col-md-9">
						{if !$info}
							<textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
						{else}
							<textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control">{$info.descripcion}</textarea>
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Encargado</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="encargado" value=""  />
						{else}
							<input type="text" class="form-control" name="encargado" value="{$info.encargado}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Direccion</label>
					<div class="col-md-9">
						{if !$info}
							<textarea name="direccion" id="direccion" cols="30" rows="10" class="form-control"></textarea>
						{else}
							<textarea name="direccion" id="direccion" cols="30" rows="10" class="form-control">{$info.direccion}</textarea>
						{/if}
					</div>
							
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5"><span class="reqIcon"></span>Cordenada X</label>
							<div class="col-md-7">
								{if !$info}
									<input type="text" class="form-control input-small" name="cordenadax" value=""  />
								{else}
									<input type="text" class="form-control" name="cordenadax" value="{$info.coordenadaX}"  />
								{/if}
							</div>
									
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-5" align="left"><span class="reqIcon"></span>Cordenada Y</label>
							<div class="col-md-7">
								{if !$info}
									<input type="text" class="form-control input-small" name="cordenaday" value=""  />
								{else}
									<input type="text" class="form-control" name="cordenaday" value="{$info.coordenadaY}"  />
								{/if}
							</div>
									
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"></span>Horario</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control input-small" name="horario" value=""  />
						{else}
							<input type="text" class="form-control input-small" name="horario" value="{$info.horario}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"></span>Municipio</label>
					<div class="col-md-9">
						<select name="municipio" id="municipio" class="form-control">
							<option></option>
							{foreach from=$lstM item=item key=key}
								
								<option value="{$item.municipioId}" {if $info.municipioId eq $item.municipioId} selected {/if}>{$item.nombre}</option>
							{/foreach}
						</select>
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"></span>Fachada</label>
					<div class="col-md-9">

							<input type="file" class="form-control input-small" name="img" id="img"  />
							{if $info.rutaFoto == null}
							<progress id="progress" value="0"></progress>
							{else}
							<progress id="progress" value="100"></progress>
							{/if}
							<div id="porcentaje"></div>
					</div>
							
				</div>
				
           </div>         
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>