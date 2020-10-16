<div class="row-fluid">
    <div class="tab-pane active" id="tab_0">
        <div style="margin:-11px" class="portlet">
            <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">

                    <input type="hidden" name="encuestaId" id="encuestaId" value="{$encuestaId}"/>
                    <input type="hidden" name="preguntaId" id="preguntaId" value="{$preguntaId}"/>
                    <input type="hidden" name="type" value="SaveQuestions"/>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3"><span class="reqIcon"> * </span>Pregunta</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nombre" value="{$info.pregunta}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><span class="reqIcon"> * </span>Tipo de Riesgo</label>
                            <div class="col-md-9">
                                <select name="riesgo" id="riesgo" class="form-control">
                                    <option value=""></option>
                                    <option value="Severo" {if $info.riesgo eq 'Severo'} selected {/if}>Severo</option>
                                    <option value="Moderado" {if $info.riesgo eq 'Moderado'} selected {/if}>Moderado
                                    </option>
                                    <option value="Bajo" {if $info.riesgo eq 'Bajo'} selected {/if}>Baja</option>
                                </select>
                            </div>
                        </div>
						<div class="form-group">
							<label class="control-label col-md-3"><span class="reqIcon"> * </span>Orden</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="orden" value="{$info.orden}"/>
							</div>
						</div>

                        <div class="form-group">
                            <label class="control-label col-md-3"><span class="reqIcon"> * </span>Tipo</label>
                            <div class="col-md-9">
                                <select name="tipo" id="tipo" onChange="checaTipopregunta()" class="form-control">
                                    <option value=""></option>
                                    <option value="punto" {if $info.tiporespuesta eq 'punto'} selected {/if}>Puntos
                                    </option>
                                    <option value="opcional" {if $info.tiporespuesta eq 'opcional'} selected {/if}>
                                        Opcional
                                    </option>
                                    <option value="abierta" {if $info.tiporespuesta eq 'abierta'} selected {/if}>
                                        Abierta
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"
                             id="div_rango" {if $info.tiporespuesta ne "punto"} style="display:none" {/if}>
                            <label class="control-label col-md-3"><span class="reqIcon">*</span> Rango:</label>
                            <div class="col-md-9">
                                DE:<input type="text" name="de" value="{$de}" style="width:50px" class="form-control">
                                A:<input type="text" name="a" value="{$a}" style="width:50px" class="form-control">
                            </div>
                        </div>


                        <div class="form-group"
                             id="div_par" {if $info.tiporespuesta ne "opcional"} style="display:none" {/if}>
                            <label class="control-label col-md-3"><span class="reqIcon">*</span> Parametros
                                Opcional:</label>
                            <div class="col-md-9">
                                Opcion 1.<input type="text" name="res_1" value="{$o1}" class="form-control">
                                Opcion 2.<input type="text" name="res_2" value="{$o2}" class="form-control">
                                Opcion 3.<input type="text" name="res_3" value="{$o3}" class="form-control">
                                Opcion 4.<input type="text" name="res_4" value="{$o4}" class="form-control">
                            </div>
                        </div>


                        <div class="form-group"
                             id="div_car" {if $info.tiporespuesta ne "abierta"} style="display:none" {/if}>
                            <label class="control-label col-md-3"><span class="reqIcon">*</span>Num. Caracteres:</label>
                            <div class="col-md-9">
                                <input type="text" name="caracter" class="form-control" value="{$info.numCaracter}">
                            </div>
                        </div>

                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>