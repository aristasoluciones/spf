{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover">
   <thead>
       <th>Nombre del producto</th>
       <th>Categoria</th>
       <th>Despcripcion del producto</th>
       <th>Caracteristicas</th>
       <th>Precio actual</th>
       <th>Precio anterior</th>
       <th>Promocion</th>
       <th>Status</th>
       <th>Imagen</th>
       <th>acciones</th>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$item.nombre}</td>
            <td>{$item.cat_name}</td>
            <td>{$item.descripcion}</td>
            <td>{$item.caracteristica}</td>
            <td>$ {$item.precioActual|number_format:2:".":","}</td>
            <td>$ {$item.precioAnterior|number_format:2:".":","}</td>
            <td>{if $item.promocion eq 'si'}En promocion{else}Sin promocion{/if}</td>
            <td>{$item.status}</td>
            <td>
              <div align="center">
               <a href="{$WEB_ROOT_IMG}/productos_categorias/{$item.nombre_archivo}.{$item.extension}"  title="Ver imagen" target="_blank">
                <img src="{$WEB_ROOT_IMG}/productos_categorias/{$item.nombre_archivo}.{$item.extension}" height="50px" width="100px">
                </a>
              </div>

            </td>
            <td><div align="center">
                {if in_array('edit_pcat',$privilegios) or $usr.role_id==1}
                    <a class="btn btn-xs yellow" href="javascript:void(0)" onClick="EditReg({$item.producto_categoria_id})" title="Editar producto">
                        <i class="fa fa-pencil-square-o" ></i>
                    </a>
                {/if}
                {if in_array('active_pcat',$privilegios) or $usr.role_id==1}
                    {if $item.status=="Baja"}
                        <a class="btn btn-xs green-jungle" href="javascript:void(0)" onClick="ActiveReg({$item.producto_categoria_id})" title="Activar producto">
                            <i class="fa fa-arrow-circle-up"></i>
                        </a>
                    {else}
                        <a class="btn btn-xs red" href="javascript:void(0)" onClick="RemoveReg({$item.producto_categoria_id})" title="Desactivar producto">
                            <i class="fa fa-arrow-circle-down"></i>
                        </a>
                    {/if}
                {/if}
               
            </div>
            </td>
        </tr>
        {foreachelse}
        <tr>
        	<td colspan="10"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
        {/foreach}
    </tbody>
</table>
<!-- {include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info} -->