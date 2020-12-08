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
                            <input name="estadoCivil" id="estadoCivil" class="form-control" value="{$post.estadoCivil}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.nacionalidad.label}</label>
                            <input class="form-control" name="nacionalidad" id="nacionalidad" value="{$post.nacionalidad}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> {$translates.personal_data.gradoEstudio.label}</label>
                            <input class="form-control spinner" name="gradoEstudio" id="gradoEstudio" value="{$post.gradoEstudio}">
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
                    <div class="col-md-12" id="map_canvas" style="height:500px; width: 100%">
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
