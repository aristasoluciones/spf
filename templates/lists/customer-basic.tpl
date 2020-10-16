<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre </th>
            <th>Apellido paterno </th>
            <th>Apellido materno </th>
            <th>Email </th>
            <th>Activo </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros.result item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombre}</td>
            <td>{$item.apaterno}</td>
            <td>{$item.amaterno}</td>
            <td>{$item.email}</td>
            <td>{$item.activo}</td>

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