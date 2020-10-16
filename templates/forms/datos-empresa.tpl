<div class="portlet-title">
	<div class="caption">
		<i class="icon-settings font-green"></i>
		Agregar o actualizar datos de la dependencia
	</div>
</div>
<div class="portlet-body form">
	<form  enctype="multipart/form-data" id="frmDatos" onsubmit="return false;" action="#" method="post" class="form-horizontal form-bordered form-label-stripped">
	 	{if $datosempresa}
		<input type="hidden" name="type" value="updateDatosEmpresa" />
		<input type="hidden" name="id" value="{$datosempresa.datoEmpresaId}" />
		{else} 
		<input type="hidden" name="type" value="saveDatosEmpresa" />
		{/if}
		<div class="form-body">
		    <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> * </span>Nombre</label>
                        <div class="col-md-9">
                            {if !$datosempresa}
                                <input class="form-control" name="nombre" id="nombre">
                            {else}
                                <input class="form-control" name="nombre" id="nombre" value="{$datosempresa.nombre}">
                            {/if}
                        </div>
                    </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>RFC</label>
                        <div class="col-md-9">
                            {if !$datosempresa}
                                <input class="form-control" name="rfc" id="rfc">
                            {else}
                                <input class="form-control" name="rfc" id="rfc" value="{$datosempresa.rfc}">
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> </span>Direccion</label>
                        <div class="col-md-9">
                           {if !$datosempresa}
                                <input class="form-control" name="direccion" id="direccion">
                            {else}
                                <input class="form-control" name="direccion" id="direccion" value="{$datosempresa.direccion}">
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> </span>Codigo postal</label>
                        <div class="col-md-9">
                           {if !$datosempresa}
                                <input class="form-control" name="cp" id="cp">
                            {else}
                                <input class="form-control" name="cp" id="cp" value="{$datosempresa.cp}">
                            {/if}
                        </div>
                    </div>
                </div>
                
            </div>
           
           <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> </span>Ciudad</label>
                        <div class="col-md-9">
                           {if !$datosempresa}
                                <input class="form-control" name="ciudad" id="ciudad">
                            {else}
                                <input class="form-control" name="ciudad" id="ciudad" value="{$datosempresa.ciudad}">
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>Estado</label>
                        <div class="col-md-9">
                            {if !$datosempresa}
                                <input class="form-control" name="estado" id="estado">
                            {else}
                                <input class="form-control" name="estado" id="estado" value="{$datosempresa.estado}">
                            {/if}
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>Pais</label>
                        <div class="col-md-9">
                            {if !$datosempresa}
                                <input class="form-control" name="pais" id="pais">
                            {else}
                                <input class="form-control" name="pais" id="pais" value="{$datosempresa.pais}">
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"> </span>Email</label>
                        <div class="col-md-9">
                           {if !$datosempresa}
                                <input class="form-control" name="email" id="email">
                            {else}
                                <input class="form-control" name="email" id="email" value="{$datosempresa.email}">
                            {/if}
                        </div>
                    </div>
                </div>
               
            </div>
           
           <div class="row">
                 <div class="col-md-6">
                     <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>Telefonos</label>
                        <div class="col-md-9">
                            {if !$datosempresa}
                                <input class="form-control" name="telefono" id="telefono">
                            {else}
                                <input class="form-control" name="telefono" id="telefono" value="{$datosempresa.telefono}">
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
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
                </div>
            </div>
        </div>
	</form>
</div>