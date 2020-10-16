<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Clave</th>
            <th>Nombre </th>
            <th>Fecha de Registro</th>
            <th>Vigencia de la Encuesta</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros.result item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombre}</td>
            <td>{$item.fechaRegistro}</td>
            <td>{$item.inicio} - {$item.fin}</td>
			<td><div align="center">
				<a href="javascript:void(0)" class="btn btn-xs yellow"  onClick="EditReg({$item.encuestaId})" title="Editar">
					<i class="fa fa-pencil-square-o" ></i> 
				</a>
				
				 <a class="btn btn-xs red" href="javascript:void(0)" onClick="DeleteReg({$item.encuestaId})" title="Eliminar">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>
								
				<a class="btn btn-xs blue" href="{$WEB_ROOT}/question/x/{$item.encuestaId}"  title="AGREGAR PREGUNTAS">
					<i class="fa fa-plus" aria-hidden="true"></i>
				</a>
				
				<a class="btn btn-xs green" href="{$WEB_ROOT}/poll-analytics/x/{$item.encuestaId}" title="Ver Resultados">
					<i class="fa fa-bar-chart" aria-hidden="true"></i>
				</a>
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
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->