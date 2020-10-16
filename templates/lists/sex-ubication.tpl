<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>#</th>
            <th>Colonia </th>
            <th>Hombre  </th>
            <th>Mujer</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombreColonia}</td>
            <td>{$item.hombres}</td>
            <td>{$item.mujeres}</td>
            <td>{$item.total}</td>
			
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