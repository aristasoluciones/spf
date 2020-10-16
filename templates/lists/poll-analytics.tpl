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
    	{foreach from=$lstResutado item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.pregunta}</td>
        </tr>
		<tr>
            <td colspan="2">
				
				<center>
					<table>
						<tr>
							<td>Respuesta</td>
							<td>Total</td>
						</tr>
						{foreach from=$item.resultados item=item2 key=key} 
						<tr>
							<td>{$item2.respuesta}</td>
							<td>{$item2.total}</td>
						</tr>
						 {/foreach}
					</table>
				</center>
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
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->