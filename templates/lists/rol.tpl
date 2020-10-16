<div class="table-container">
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$roles item=item key=key}
        <tr>
            <td>{$item.name}</td>
            <td>
                <div align="center">
                    {if in_array(31,$privilegios) or $Usr.rolId eq 1}
                        <a class="btn btn-xs yellow-gold" href="javascript:void(0)" onClick="EditReg({$item.rolId})" title="Editar">
                            <i class="fa fa-edit" aria-hidden="true"></i>
                        </a>
                    {/if}
                    {if in_array(33,$privilegios) or $Usr.rolId eq 1}
                        <a class="btn btn-xs blue-dark spanConfig" href="javascript:;" title="Configurar" id="{$item.rolId}">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                    {/if}
                    {if in_array(32,$privilegios) or $Usr.rolId eq 1}
                        <a class="btn btn-xs red" href="javascript:void(0)" onClick="DeleteReg({$item.rolId})" title="Eliminar">
                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
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