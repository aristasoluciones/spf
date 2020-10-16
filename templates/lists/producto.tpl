<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Nombre </th>
            <th>Descripcion </th>
			<th>A quien va dirigido </th>
			<th>Ventas </th>
            <th>Imagen </th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$item.nombre}</td>
            <td>{$item.descripcion}</td>
            <td>{$item.aquien}</td>
			<td>{$item.ventajas}</td>
            <td>
            <a href="{$WEB_ROOT_IMG}/categorias/{$item.imagen}.{$item.tipo}"  title="Ver imagen" target="_blank">
                <img src="{$WEB_ROOT_IMG}/categorias/{$item.imagen}.{$item.tipo}" height="50px" width="100px">
                </a>
             </td>
            <td><div align="center">
                {if in_array('edit_categoria',$privilegios) or $Usr.role_id eq 1}
				<a class="btn btn-xs yellow" href="javascript:void(0)" onClick="EditReg({$item.categoriaId})" title="Editar categoria">
					<i class="fa fa-pencil-square-o" ></i> 
				</a>
                {/if}
                {if in_array('add_pcategoria',$privilegios) or $Usr.role_id eq 1}
                <a class="btn btn-xs green" href="{$WEB_ROOT}/producto_cat/id/{$item.categoriaId}"  title="Agregar producto">
                   <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
                {/if}
                 {if in_array('del_categoria',$privilegios) or $Usr.role_id eq 1}
                <a class="btn btn-xs red" href="javascript:void(0)" onClick="DeleteReg({$item.categoriaId})" title="Eliminar categoria">
                    <i class="fa fa-trash" aria-hidden="true"></i>
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