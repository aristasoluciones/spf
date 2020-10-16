<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Nombre </th>
            <th>Telefono </th>
            <th>Email </th>
            <th>Usuario </th>
            <th>Tipo </th>
            <th>Activo</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$registros item=item key=key}          
        <tr>
            <td>{$item.nombre}</td>
            <td>{$item.telefono}</td>
            <td>{$item.email}</td>
            <td>{$item.usuario}</td>
            <td>{$item.role_id}</td>
            <td>{if $item.activo}S&iacute;{else}No{/if}</td>
    
            <td><div align="center">
            {if in_array(35,$privilegios) or $Usr.rolId eq 1}
            <a class="btn btn-xs yellow" href="javascript:void(0)" onClick="EditReg({$item.usuarioId})" title="Editar">                
				<i class="fa fa-pencil-square-o" ></i> 
            </a>
            {/if}
            {if in_array(36,$privilegios) or $Usr.rolId eq 1}
            <a class="btn btn-xs red" href="javascript:void(0)" onClick="DeleteReg({$item.usuarioId})" title="Eliminar">
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