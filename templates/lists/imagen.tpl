<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Nombre </th>
            <th>Tipo </th>
            <th>Descripcion</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$item.nombre}</td>
            <td>{$item.tipo}</td>
            <td>{$item.descripcion}</td>
            <td><div align="center">
                {if in_array('edit_producto',$privilegios) or $typeUser==1}
				<!-- <a href="javascript:void(0)" onClick="EditReg({$item.categoriaId})" title="Editar producto">
					<img src="{$WEB_ROOT}/images/png-icon/big/glyphicons_150_edit.png" border="0">
				</a> -->
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