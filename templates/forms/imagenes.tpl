<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">

			<input type="hidden" name="id" value="{$info.imagenId}" />
			<input type="hidden" name="type" value="save" />

		  <div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Nombre</label>
					<div class="col-md-9">
							<input type="text" class="form-control" name="nombre" value="{$info.nombre}"  />
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Descripcion</label>
					<div class="col-md-9">
							<textarea name="descripcion" class="form-control">{$info.descripcion}</textarea>
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Activo</label>
					<div class="col-md-9">
						<select name="activo" id="activo" class="form-control" >
							<option {if $info.activo eq "no"} selected {/if}>no</option>
							<option {if $info.activo eq "si"} selected {/if}>si</option>
						</select>
					</div>	
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Archivo</label>
					<div class="col-md-9">
						<font color="red">Importante: Solo imagenenes de tamaño 1400px x 420px</font>
						<input type="file" name="img" id="img">
					</div>	
				</div>
				
				
           </div>         
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>