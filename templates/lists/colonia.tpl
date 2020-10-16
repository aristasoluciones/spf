{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Colonia</th>
            <th>Municipio </th>            
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$registros.result item=item key=key}
        <tr>
            <td>{$item.nombreColonia}</td>
            <td>{$item.municipio}</td>
            <td><div align="center">
				<a class="btn btn-xs yellow" href="javascript:void(0)" onClick="EditReg({$item.coloniaId})" title="Editar">
					<i class="fa fa-pencil-square-o" ></i> 
			    </a>
				<a class="btn btn-xs red" href="javascript:void(0)" onclick="DeleteReg('{$item.coloniaId}')" title="Eliminar">
					<i class="fa fa-trash" aria-hidden="true"></i>
				</a>			
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
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}