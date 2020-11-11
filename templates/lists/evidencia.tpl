<div class="table-container">
<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th>Archivo</th>
            <th>Acci&oacute;n </th>
        </tr>
    </thead>
    <tbody>
    	{foreach from=$files item=item key=key}
        <tr>
            <td>{$item.name}</td>
            <td>
                <a href="{$WEB_ROOT}/util/download.php?file={$item.filePath}" class="btn btn-xs green-dark">
                    <i class="fa fa-download"></i>
                </a>
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
