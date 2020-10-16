<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Nombre </th>
            <th>Tipo </th>
            <th>Descripcion</th>
            <th>Vista Previa</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$item.nombre}</td>
            <td>{$item.tipo}</td>
            <td>{$item.descripcion}</td>
            <td>
				<img src="{$WEB_ROOT}/images/slider/{$item.ruta}?{$rand}"  style=" height: auto; 
					width: auto; 
					max-width: 100px; 
					max-height: 100px;" >
			</td>
            <td><div align="center">
                {if in_array(38,$privilegios) or $Usr.rolId eq 1}
				<a class="btn btn-xs red" href="javascript:void(0)" onClick="EditReg({$item.imagenId})" title="Editar">
					<i class="fa fa-pencil-square-o" ></i>
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
<!-- {include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info} -->