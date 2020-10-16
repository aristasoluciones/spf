<div class="row-fluid">
																				
    <div class="tab-pane" id="tab_5">
        <div class="portlet box blue"  style="margin-bottom:5px">
            <div class="portlet-title">
                <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <form id="frmGral" action="#" class="form-horizontal form-bordered">
                <input type="hidden" name="type" value="save" />
                <input type="hidden" name="id" id="id" value="{$info.idReg}" />
                    <div class="control-group">
                        <label class="control-label"><span class="reqIcon">*</span> Cliente:</label>
                        <div class="controls">
                        	{if !$info.view}
                            <select class="m-wrap span12" name="clienteId">
                                <option value="" {if $info.clienteId == ""}selected{/if}>Seleccione</option>                                {foreach from=$clientes item=item key=key}
                                <option value="{$item.clienteId}" {if $info.clienteId == $item.clienteId}selected{/if}>{$item.nombre}</option>                                
                                {/foreach}
                            </select> 
                            {else}
                            	{$info.cliente}
                            {/if}
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><span class="reqIcon">*</span> Fecha:</label>
                        <div class="controls">                        
                            {if !$info.view}
                            <div class="input-append" id="ui_date_picker_trigger">
                                <input type="text" class="m-wrap span12" name="fecha" id="fecha" maxlength="10" readonly="readonly" value="{$info.fecha|date_format:"%d-%m-%Y"}">
                                <span class="add-on">
                                    <i class="icon-calendar" onclick="ShowCalendar()"></i>
                                </span>
                            </div>                       	
                            {else}
                            	{$info.fecha|date_format:"%d-%m-%Y"}
                            {/if}
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label"><span class="reqIcon">*</span> Mensaje:</label>
                        <div class="controls">
                        	{if !$info.view}
                            <textarea class="m-wrap span12" name="mensaje" rows="6">{$info.mensaje}</textarea>
                             {else}
                            	{$info.mensaje|nl2br}
                            {/if}                            
                        </div>
                    </div>
                    
                    {if $info.view}
                    <div class="control-group last">
                        <label class="control-label">Usuario:</label>
                        <div class="controls">
                           	{$info.usuario}
                        </div>
                    </div>
                    {/if}
                     
                </form>
                <!-- END FORM-->                  
            </div>
        </div>
    </div>
    
    <span class="reqIcon">*</span> Campos requeridos
    
    <div align="center" id="loader"></div>
    <div align="center" id="txtErrMsg" class="alert alert-error hide"></div>
    
</div>

<script type="text/javascript">
	$("#fecha").datepicker({
		dateFormat: "dd-mm-yy"
	});
</script>