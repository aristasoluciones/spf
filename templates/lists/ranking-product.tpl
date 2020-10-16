<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="">
    <thead>
        <tr>
            <th>#</th>
            <th>Categoria </th>
            <th>Total Venta </th>
            <th>Monto </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombre}</td>
            <td>{$item.countProductos}</td>
            <td>{$item.suma}</td>
        </tr>
		
        {foreachelse}
        <tr>
        	<td colspan="7"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
        {/foreach}
    </tbody>
</table>
</div>
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->