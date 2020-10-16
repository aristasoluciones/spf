<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="custom_table">
    <thead>
        <tr>
            <th>Folio</th>
            <th>Nombre cliente</th>
            <th>Fecha </th>
            <th>Hora </th>
			<th>Total </th>
			<th>Estado de pedido </th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros.result item=item key=key}        	
        <tr>
            <td>{$item.folio}</td>
            <td>{$item.cliente}</td>
            <td>{$item.fecha}</td>
            <td>{$item.hora}</td>
            <td>{$item.montoTotal}</td>
			<td>{$item.estatus}</td>
            <td><div align="center">
                
                {if in_array('del_pedido',$privilegios) or $Usr.role_id eq 1}
                    {if $item.estatus neq 'cancelado'}
                    <a class="btn btn-xs red" href="javascript:void(0)" onClick="DeleteReg({$item.ventaId})" title="Cancelar pedido">
                      <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </a>
                    {/if}
                {/if}
                {if in_array('ver_pedido',$privilegios) or $Usr.role_id eq 1}
                <a class="btn btn-xs green" href="{$WEB_ROOT}/detalle-pedido/id/{$item.ventaId}"  title="Ver pedido">
                   <i class="fa fa-external-link" aria-hidden="true"></i>
                </a>
                {/if}
                				
            </div>
            </td>
        </tr>
        {foreachelse}
        <tr>
        	<td colspan="7"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
        {/foreach}
    </tbody>
</table>
</div>
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}