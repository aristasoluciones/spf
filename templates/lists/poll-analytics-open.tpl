<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="">
    <thead>
        <tr>
            <th>#</th>
            <th>Pregunta </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$lstAbiertas item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.respuesta}</td>
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