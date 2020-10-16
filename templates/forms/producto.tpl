<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped" >
			{if $info}
			<input type="hidden" name="type" value="update" />
			<input type="hidden" name="id" value="{$info.categoriaId}" />
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
				 <label class="control-label col-md-3"><span class="reqIcon"> * </span> A quien va dirigido</label>
					<div class="col-md-9">
					 {if !$info}
						<textarea  name="aquien" class="form-control"></textarea>
					{else}
						<textarea name="aquien" class="form-control" >{$info.aquien}</textarea>
					{/if}
					</div>
				 </div>
				 <div class="form-group">
				 <label class="control-label col-md-3"><span class="reqIcon"> * </span> Ventajas </label>
					<div class="col-md-9">
					 {if !$info}
						<textarea  name="ventaja" class="form-control"></textarea>
					{else}
						<textarea name="ventaja" class="form-control" >{$info.ventajas}</textarea>
					{/if}
					</div>
				 </div>
				  <div class="form-group">
				  <font color="red">Se recomiendan imagenes de 256 x 256 Píxeles</font>
				  <label class="control-label col-md-3"><span class="reqIcon">  </span> Imagen de categoria </label>
					<div class="col-md-9">
					 {if !$info}
						<input type="file" class="form-control" name="imgCategoria" id="imgCategoria">
					{else}

						<input type="file" class="form-control" name="imgCategoria" id="imgCategoria">
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