<div class="table-container">
{include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>#</th>
            <th>Descripcion </th>
            <th>Nombre corto </th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$registros item=item key=key}        	
        <tr>
            <td>{$key+1}</td>
            <td>{$item.Description}</td>
            <td>{$item.Title}</td>
			<td><div align="center">
				<a href="javascript:void(0)" onClick="EditReg({$item.ID})" title="Editar permiso">
					<img src="{$WEB_ROOT}/images/png-icon/big/glyphicons_150_edit.png" border="0">
				</a>
				<!-- <a href="javascript:void(0)" onClick="EditReg({$item.requisito_id})" title="Configurar tramite">
					<img src="{$WEB_ROOT}/images/png-icon/big/glyphicons_136_cogwheel.png">
				</a> -->
				
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