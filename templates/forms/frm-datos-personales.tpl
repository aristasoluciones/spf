<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-green-haze">
            <i class="icon-user font-green-haze"></i>
            <span class="caption-subject bold uppercase"> Datos personales</span>
        </div>
    </div>
    <div class="portlet-body">
        <form enctype="multipart/form-data" name="frmDatosPersonales" id="frmDatosPersonales" method="post" onsubmit="return false" >
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
                            <label><span class="reqIcon"> * </span>Nombre</label>
                            <input class="form-control spinner" name="nombre" id="nombre" value="{$post.nombre}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>Apellido Paterno</label>
                            <input class="form-control" name="firstLastName" id="firstLastName" value="{$post.apaterno}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>Apellido Materno</label>
                            <input class="form-control" name="secondLastName" id="secondLastName" value="{$post.amaterno}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span>Edad</label>
                            <input class="form-control spinner" name="edad" id="edad" value="{$post.edad}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Estado Civil</label>
                            <input name="estadoCivil" id="estadoCivil" class="form-control" placeholder="Soltera, Casada u Otro(especifique)" value="{$post.estadoCivil}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Nacionalidad</label>
                            <input class="form-control" name="nacionalidad" id="nacionalidad" value="{$post.nacionalidad}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Grado de Estudios</label>
                            <input class="form-control spinner" name="gradoEstudio" id="gradoEstudio" value="{$post.gradoEstudio}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Ocupacion</label>
                            <input class="form-control" name="ocupacion" id="ocupacion" value="{$post.ocupacion}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Lugar de nacimiento</label>
                            <input class="form-control" name="lugarDeNacimiento" id="lugarDeNacimiento" value="{$post.lugarNacimiento}" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Municipio donde habita</label>
                            <input class="form-control spinner" name="municipio" id="municipio" value="{$post.municipio}" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Colonia , ejido o localidad donde vive</label>
                            <input class="form-control" name="colonia" id="colonia" value="{$post.colonia}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Fecha incidente</label>
                            <input class="form-control" name="fechaIncidente" id="fechaIncidente" onclick="Calendario(this)" value="{$post.fechaIncidente}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> tiempo de reación con su pareja</label>
                            <input class="form-control" name="timeRelacion" id="timeRelacion" value="{$post.timeRelacion}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><span class="reqIcon"> * </span> Cuantos Hijos tiene</label>
                            <input class="form-control" name="numHijo" id="numHijo"  value="{$post.numHijo}">
                        </div>
                    </div>
                </div>                
                <div class="row">
                    <input type="hidden" name="latLng" id="latLng" value="{$post.cordenada}">
                    <label for=""><span class="reqIcon">* </span> Ubicar en el mapa el lugar aproximado de los hechos.</label>
                    <div class="col-md-12" id="map" style="height:500px; width: 100%">
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-6">
                        <span class="reqIcon">*</span> Campos requeridos
                        <div align="center" id="loader"></div>
                        <div align="center" id="txtErrMsg" class="alert alert-danger" style="display:none"></div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn green " id="btnSaveDataVictima" >{if $post}Actualizar{else}Guardar{/if}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
