<div class="row-fluid">
    <div class="tab-pane active" id="tab_0">
        <div class="portlet"  style="margin:-11px">
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">

                {if $info}
                    <input type="hidden" name="type" value="update" />
                    <input type="hidden" name="id" value="{$info.usuarioId}" />
                {else}
                   <input type="hidden" name="type" value="save" />
                {/if}
                <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
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
                             </div>
                             <div class="col-md-6">
            					 <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Apellido Paterno</label>
                                    <div class="col-md-9">
                                    	{if !$info}
                                        <input type="text" class="form-control" name="apaterno" />
                                        {else}
                                        	 <input type="text" class="form-control" name="apaterno" value="{$info.apaterno}" />
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Apellido Materno</label>
                                    <div class="col-md-9">
                                        {if !$info}
                                        <input type="text" class="form-control" name="amaterno" />
                                        {else}
                                             <input type="text" class="form-control" name="amaterno" value="{$info.amaterno}" />
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Fecha Nacimiento</label>
                                    <div class="col-md-9">
                                             <input type="text" class="form-control" name="fechanacimiento" id="fechanacimiento" value="{$info.fechaNacimiento}" onclick="Calendario(this)"  />
                                    </div>
                                </div>
                            </div>
                        </div>
					   <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Tel&eacute;fono</label>
                                    <div class="col-md-9">
                                        {if !$info}
                                        <input type="text" class="form-control" name="telefono" />
                                        {else}
                                             <input type="text" class="form-control" name="telefono" value="{$info.telefono}" />
                                        {/if}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Email</label>
                                    <div class="col-md-9">
                                        {if !$info}
                                        <input type="text" class="form-control" name="email" />
                                        {else}
                                             <input type="text" class="form-control" name="email" value="{$info.email}" />
                                        {/if}
                                    </div>
                                </div>
                            </div>
                       </div>
                       <div class="row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Usuario</label>
                                    <div class="col-md-9">
                                        {if !$info}
                                        <input type="text" class="form-control" name="usuario" maxlength="13"  />
                                        {else}
                                             <input type="text" class="form-control" name="usuario" value="{$info.usuario}" maxlength="13" />
                                        {/if}
                                    </div>
                                </div>
                           </div>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">{if !$info}*{/if}</span> Contrase&ntilde;a</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" value="{$info.passwd}" maxlength="13" />
                                    </div>
                                </div>
                           </div>
                       </div>
                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Municipio</label>
                                    <div class="col-md-9">
                                        <input type="hidden" id="currentCiudad" value="{$info.municipio_id}"/>
                                        <select class="form-control select2" name="ciudad" id="ciudad">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Tipo / Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="tipo" id="tipo">
                                        <option value=""></option>
                                        {foreach from=$registros_roles item=item key=key}
                                           <option value="{$item.rolId}" {if $info.role_id == $item.rolId}selected{/if}>{$item.name}</option>}
                                        {/foreach}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3"><span class="reqIcon">*</span> Estatus</label>
                                    <div class="col-md-9">
                                        {if !$info}
                                            <input type="checkbox" name="activo" />
                                        {else}
                                            <input type="checkbox" name="activo" {if $info.activo ==1}checked{/if} />
                                        {/if}
                                    </div>
                                </div>
                            </div>
                       </div>
				    </div><!-- END FORM-BODY -->
                </form><!-- END FORM-->
            </div>
        </div>
    </div>
</div>
