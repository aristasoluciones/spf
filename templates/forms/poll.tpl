<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">
			<input type="hidden" name="encuestaId" value="{$info.encuestaId}" />
			<input type="hidden" name="type" value="save" />

		  <div class="form-body">
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Nombre</label>
					<div class="col-md-9">
							<input type="text" class="form-control" name="nombre" value="{$info.nombre}"  />
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Contexto</label>
					<div class="col-md-9">
							<select class="form-control" name="contexto">
								<option value="Todos" {if $info.tipo eq "Todos"}selected{/if}>Todos</option>	
								<option value="Urbano" {if $info.tipo eq "Urbano"}selected{/if}>Urbano</option>
								<option value="Indigena" {if $info.tipo eq "Indigena"}selected{/if}>Indigena</option>
							</select>	
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Inicio</label>
					<div class="col-md-9">
							<input type="text" class="form-control" name="inicio"  id="fecha_1" value="{$info.inicio}"  onClick='cargaDate(1)' />
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Fin</label>
					<div class="col-md-9">
							<input type="text" class="form-control" name="fin" id="fecha_2" value="{$info.fin}"  onClick='cargaDate(2)' />
					</div>
							
				</div>

			</div>     
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>