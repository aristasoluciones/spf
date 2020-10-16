<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre </th>
            <th>Apellido paterno </th>
            <th>Apellido materno </th>
            <th>Email </th>
            <th>Activo </th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros.result item=item key=key}
        <tr>
            <td>{$key+1}</td>
            <td>{$item.nombre}</td>
            <td>{$item.apaterno}</td>
            <td>{$item.amaterno}</td>
            <td>{$item.email}</td>
            <td>{$item.activo}</td>
			<td><div align="center">
                {* if in_array('edit_cliente',$privilegios) or $Usr.role_id eq 1}
				<a class="btn btn-xs yellow" href="javascript:void(0)" onClick="EditReg({$item.clienteId})" title="Editar cliente">
					<i class="fa fa-pencil-square-o" ></i> 
				</a>
                {/if *}
				{if in_array('active_cliente',$privilegios) or $Usr.role_id eq 1}
                    {if $item.activo=="no"}
                        <a class="btn btn-xs green" href="javascript:void(0)" onClick="ActiveReg({$item.clienteId})" title="Activar cliente">
                            <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                        </a>
                    {else}
                    <a class="btn btn-xs red" href="javascript:void(0)" onClick="RemoveReg({$item.clienteId})" title="Dar de baja cliente">
                        <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                    </a>
                    {/if}
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
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->