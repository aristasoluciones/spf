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
			 <input type="hidden" name="categoria_id" value="{$info.categoria_id}" />
			 <input type="hidden" name="type" value="update_pcat" />
			 <input type="hidden" name="pcat_id" value="{$info.producto_categoria_id}" />
            {else}
            <input type="hidden" name="categoria_id" value="{$info2.categoriaId}" />
			<input type="hidden" name="type" value="save_pcat" />
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
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Sustancia Activa</label>
					<div class="col-md-9">
							<input type="text" class="form-control" name="sustancia" value="{$info.sustancia}"  />
					</div>	
				</div>
				<div class="form-group">
				 <label class="control-label col-md-3"><span class="reqIcon"> * </span> Descripcion</label>
					<div class="col-md-9">
					 {if !$info}
						<textarea  name="descripcion" class="form-control"></textarea>
					{else}
						<textarea name="descripcion" class="form-control" >{$info.descripcion}</textarea>
					{/if}
					</div>
				 </div>
				<div class="form-group">
				 <label class="control-label col-md-3"><span class="reqIcon"> * </span> Caracteristicas</label>
					<div class="col-md-9">
					 {if !$info}
						<textarea  name="caracteristica" class="form-control"></textarea>
					{else}
						<textarea  name="caracteristica" class="form-control" >{$info.caracteristica}</textarea>
					{/if}
					</div>
				 </div>
				 <div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"></span>Precio Anterior</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control input-small" name="panterior" value=""  />
						{else}
							<input type="text" class="form-control input-small" name="panterior" value="{$info.precioAnterior}"  />
						{/if}
					</div>
							
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"> * </span>Precio Actual</label>
					<div class="col-md-9">
						{if !$info}
							<input type="text" class="form-control input-small" name="pactual" value="" />
						{else}
							<input type="text" class="form-control input-small" name="pactual" value="{$info.precioActual}"  />
						{/if}
					</div>		
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><span class="reqIcon"></span>En promocion</label>
					<div class="col-md-9">
						{if !$info}
                        	<input type="checkbox"  name="promocion" />
                         {else}
                        	<input type="checkbox"  name="promocion" {if $info.promocion  eq 'si'}checked{/if} />
                        {/if}
					</div>		
				</div>
				 <div class="form-group">
				 <label class="control-label col-md-3"><span class="reqIcon"></span> Imagen del producto </label>
					<div class="col-md-9">
					<font color="red">Se recomiendan imagenes de 300 x 300 Píxeles</font>
					 {if !$info}
						<input type="file" name="img_pcat" id="img_pcat" class="form-control" />
					{else}
						<input type="file" name="img_pcat" id="img_pcat" class="form-control" />
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