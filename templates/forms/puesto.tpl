<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmRole" action="#" class="form-horizontal form-bordered form-label-stripped">
			{if $info}
			<input type="hidden" name="type" value="update" />
			<input type="hidden" name="id" value="{$info.puestosid}" />
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
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Cargo</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="cargo" value=""  />
						{else}
							<input type="text" class="form-control" name="cargo" value="{$info.cargo}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Profesion</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="profesion" value=""  />
						{else}
							<input type="text" class="form-control" name="profesion" value="{$info.profesion}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Direccion / Oficinas</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="oficina" value=""  />
						{else}
							<input type="text" class="form-control" name="oficina" value="{$info.oficina}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span> Status</label>
					<div class="col-md-9">
						<select class="form-control" name="activo" id="activo">
						   <option value="">Seleccionar...</option>
						   <option value="Si" {if $info.activo=='Si'}selected{/if}>Activo</option>
						   <option value="No" {if $info.activo=='No'}selected{/if}>Baja</option>
							
						</select>
					</div>
							
				</div>
				
				
           </div>         
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>