<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmColonia" action="#" class="form-horizontal form-bordered form-label-stripped">
			<input type="hidden" name="type" value="{if $info}update{else}save{/if}" />
			<input type="hidden" name="id" value="{$info.coloniaId}" />
		  <div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Colonia</label>
					<div class="col-md-9">
					 <input type="text" class="form-control" name="colonia" value="{$info.nombreColonia}"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Municipio</label>
					<div class="col-md-9">
						<select name="municipioId" id="municipioId" class="bs-select form-control input-medium">
						<option value="">Seleccione ......</option>
						{foreach from=$municipios item=item  key=key}
                           <option value="{$item.municipioId}" {if $info.municipioId==$item.municipioId}selected{/if}>{$item.nombre}</option>
						{/foreach}
						</select>
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Coordenada X</label>
					<div class="col-md-9">
						<input type="text" class="form-control input-small" name="cordenadax" value="{$info.x}"  />
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Cordenada Y</label>
					<div class="col-md-9">
						<input type="text" class="form-control input-small" name="cordenaday" value="{$info.y}"  />
					</div>
							
				</div>
           </div>         
          </form>
		   <!-- END FORM-->
	      </div>
       </div>
    </div>
</div>