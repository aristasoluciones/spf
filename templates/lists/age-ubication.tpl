<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" >
    <thead>
        <tr>
            <th>#</th>
            <th>Colonia </th>
            <th>Fuera de Rango  </th>
            <th>18 - 24  </th>
            <th>25 - 59 </th>
            <th>60 - adelante </th>
            <th>Total Personas </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombreColonia}</td>
            <td>{$item.fuera}</td>
            <td>{$item.rango1}</td>
            <td>{$item.rango2}</td>
            <td>{$item.rango3}</td>
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