<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-green-haze">
            <i class="icon-user font-green-haze"></i>
            <span class="caption-subject bold uppercase"> {$translates.personal_data.title.label}</span>
        </div>
    </div>
    <div class="portlet-body">
        <form enctype="multipart/form-data" name="frmDatosPersonales" id="frmDatosPersonales" method="post" onsubmit="return false" >
            {if $Usr.municipio_id}<input type="hidden"  id="municipioLimited" value="{$Usr.municipio_id}">{/if}
            {if $post}
                <input type="hidden" name="type" id="type" value="updateVictima">
                <input type="hidden" name="id" id="id" value="{$post.victimaId}">
            {else}
                <input type="hidden" name="type" id="type" value="saveVictima">
            {/if}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>{$translates.personal_data.nombre.label}</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{$post.nombre}" autocomplete="off" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>{$translates.personal_data.firstLastName.label}</label>
                            <input class="form-control" name="firstLastName" id="firstLastName" value="{$post.apaterno}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>{$translates.personal_data.secondLastName.label}</label>
                            <input class="form-control" name="secondLastName" id="secondLastName" value="{$post.amaterno}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.edad.label}</label>
                            <input class="form-control spinner" name="edad" id="edad" value="{$post.edad}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.estadoCivil.label}</label>
                            <select class="form-control" name="estadoCivil" id="estadoCivil">
                                <option>Seleccionar...</option>
                                <option value="Soltero(a)" {if $post.estadoCivil|lower eq 'soltero(a)'}selected{/if}>Soltero(a)</option>
                                <option value="Casado(a)" {if $post.estadoCivil|lower eq 'casado(a)'}selected{/if}>Casado(a)</option>
                                <option value="Union libre" {if $post.estadoCivil|lower eq 'union libre'}selected{/if}>Union libre</option>
                                <option value="Divorciado(a)" {if $post.estadoCivil|lower eq 'divorciado(a)'}selected{/if}>Divorciado(a)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.nacionalidad.label}</label>
                            <select class="form-control" name="nacionalidad" id="nacionalidad">
                                <option>Seleccionar...</option>
                                <option value="Mexicana" {if $post.nacionalidad|lower eq 'mexicana'}selected{/if}>Mexicana</option>
                                <option value="Extranjera" {if $post.nacionalidad|lower eq 'extranjera'}selected{/if}>Extranjera</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.gradoEstudio.label}</label>
                            <select class="form-control" name="gradoEstudio" id="gradoEstudio">
                                <option>Seleccionar..</option>
                                <option value="sin estudios" {if $post.gradoEstudio|lower eq 'sin estudios'}selected{/if}>Sin estudios</option>
                                <option value="primaria trunca" {if $post.gradoEstudio|lower eq 'primaria trunca'}selected{/if}>Primaria trunca</option>
                                <option value="primaria" {if $post.gradoEstudio|lower eq 'primaria'}selected{/if}>Primaria</option>
                                <option value="secundaria trunca" {if $post.gradoEstudio|lower eq 'secundaria trunca'}selected{/if}>Secundaria trunca</option>
                                <option value="secundaria" {if $post.gradoEstudio|lower eq 'secundaria'}selected{/if}>Secundaria</option>
                                <option value="preparotoria trunca" {if $post.gradoEstudio|lower eq 'preparatoria trunca'}selected{/if}>Preparatoria trunca</option>
                                <option value="preparatoria" {if $post.gradoEstudio|lower eq 'preparatoria'}selected{/if}>Peparatoria</option>
                                <option value="carrera tecnica trunca" {if $post.gradoEstudio|lower eq 'carrera tecnica trunca'}selected{/if}>Carrera tecnica trunca</option>
                                <option value="carrera tecnica" {if $post.gradoEstudio|lower eq 'carrera tecnica'}selected{/if}>Carrera tecnica</option>
                                <option value="licenciatura trunca" {if $post.gradoEstudio|lower eq 'licenciatura trunca'}selected{/if}>Licenciatura trunca</option>
                                <option value="licenciatura" {if $post.gradoEstudio|lower eq 'licenciatura'}selected{/if}>Licenciatura</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.ocupacion.label}</label>
                            <input class="form-control" name="ocupacion" id="ocupacion" value="{$post.ocupacion}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.lugarDeNacimiento.label}</label>
                            <input type="hidden" id="currentLugarNacimiento" value="{$post.lugarNacimiento}">
                            <select  class="form-control" name="lugarDeNacimiento" id="lugarDeNacimiento">
                            </select>
                            <small>Lugar capturado: {$post.lugarNacimiento}</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.municipio.label}</label>
                            <input type="hidden" id="currentMunicipio" value="{$post.municipio_id}">
                            <select class="form-control select2" name="municipio" id="municipio">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label  class="control-label"><span class="reqIcon"> * </span> {$translates.personal_data.colonia.label}</label>
                            <input type="hidden" id="currentColonia" value="{$post.colonia}">
                            <select class="form-control select2 " name="colonia" id="colonia">
                            </select>
                            <small>Lugar capturado: {$post.colonia}</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><span class="reqIcon"> * </span> {$translates.personal_data.fechaIncidente.label}</label>
                            <input class="form-control" name="fechaIncidente" id="fechaIncidente" onclick="Calendario(this)" value="{$post.fechaIncidente}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><span class="reqIcon"> * </span> {$translates.personal_data.timeRelacion.label}</label>
                            <input class="form-control" name="timeRelacion" id="timeRelacion" value="{$post.timeRelacion}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label"><span class="reqIcon"> * </span> {$translates.personal_data.numHijo.label}</label>
                            <input class="form-control" name="numHijo" id="numHijo"  value="{$post.numHijo}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="latLng" id="latLng" value="{$post.cordenada}">
                    <label for=""><span class="reqIcon">* </span> {$translates.personal_data.latLng.label}</label>
                    <div class="col-md-12" id="map" style="height:500px; width: 100%">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <span class="reqIcon">*</span> {$translates.personal_data.fieldRequired.label}
                        <div align="center" id="loader"></div>
                        <div align="center" id="txtErrMsg" class="alert alert-danger" style="display:none"></div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn green " id="btnSaveDataVictima" >{if $post}{$translates.personal_data.updateButton.label}{else}{$translates.personal_data.saveButton.label}{/if}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
