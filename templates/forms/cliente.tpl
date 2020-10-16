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
			<input type="hidden" name="id" value="{$info.clienteId}" />
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
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Apellido paterno</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="apaterno" value=""  />
						{else}
							<input type="text" class="form-control" name="apaterno" value="{$info.apaterno}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Apellido materno</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="amaterno" value=""  />
						{else}
							<input type="text" class="form-control" name="amaterno" value="{$info.amaterno}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Email</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control" name="email" value=""  />
						{else}
							<input type="text" class="form-control" name="email" value="{$info.email}"  />
						{/if}
					</div>
							
				</div>

			</div>     
             </form>
                <!-- END FORM-->                  
            </div>
       </div>
    </div>
</div>