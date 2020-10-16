{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}

<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead> 
        <tr>
            <th width="70"><div align="center">ID</div></th>
            <th width="100"><div align="center">Fecha</div></th>
            <th width="200"><div align="center">Cliente</div></th>
            <th><div align="center">Recordatorio</div></th>            
            <th width="200"><div align="center">Usuario</div></th>
            <th class="hidden-480" width="80"><div align="center">Acci&oacute;n</div></th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros.result item=item key=key}
        <tr class="odd gradeX">
        	<td><div align="center">{$item.idReg}</div></td>
            <td><div align="center">{$item.fecha|date_format:"%d-%m-%Y"}</div></td>
            <td><div align="left">{$item.cliente}</div></td>
            <td><div align="left">{$item.mensaje}</div></td>
            <td><div align="center">{$item.usuario}</div></td>
            <td><div align="center">
            <a href="javascript:void(0)" onClick="ViewReg({$item.idReg})" title="Ver Detalles">
            	<img src="{$WEB_ROOT}/images/icons/view.png" border="0">
            </a>
            <a href="javascript:void(0)" onClick="EditReg({$item.idReg})" title="Editar">
            	<img src="{$WEB_ROOT}/images/icons/edit.png" border="0">
            </a>
            {if $item.status == "Activo" && $item.tipo == "Recurrente"}
            <a href="javascript:void(0)" onClick="CancelReg({$item.idReg})" title="Cancelar">
            	<img src="{$WEB_ROOT}/images/icons/cancel.png" border="0">
            </a>
            {/if}
            <a href="javascript:void(0)" onClick="DeleteReg({$item.idReg})" title="Eliminar">
            	<img src="{$WEB_ROOT}/images/icons/delete.gif" border="0">
            </a>
            </div>
            </td>
        </tr>
        {foreachelse}
        <tr class="odd gradeX">
        	<td colspan="8"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
        {/foreach}
    </tbody>
</table>
 
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}