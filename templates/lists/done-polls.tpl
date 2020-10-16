<div class="table-container">
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Status </th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$results item=item key=key}
        <tr>
            <td>{$item.nombre} {$item.apaterno} {$item.amaterno}</td>
            <td>{if $item.completePoll}Finalizado{else}Pendiente por finalizar{/if}</td>
			<td><div align="center">
				<a href="{$WEB_ROOT}/do-poll/id/{$item.victimaId}" class="btn btn-xs yellow"  title="Ir a Encuesta">
					<i class="fa fa-arrow-circle-right" ></i>
				</a>
                {if $item.completePoll}
                    <a href="javascript:;" class="btn btn-xs green btn-chart" id="{$item.victimaId}"  title="Ver grafica">
                        <i class="fa fa-bar-chart" ></i>
                    </a>
                    <a href="{$WEB_ROOT}/poll-result-pdf/id/{$item.victimaId}" class="btn btn-xs green-dark"  title="Ver reporte" target="_blank">
                        <i class="fa fa-file" ></i>
                    </a>

                {/if}
            </div>
            </td>
        </tr>
        {foreachelse}
        <tr>
        	<td colspan="3"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
        {/foreach}
    </tbody>
</table>
</div>