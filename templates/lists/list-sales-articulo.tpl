<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
    <tr>
        <th width="200"><div align="center">Producto</div></th>
        <th width="200"><div align="center">Categoria</div></th>
        <th width="200"><div align="center">Total de ventas</div></th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$result item=item key=key}
        <tr class="odd gradeX">
            <td>{$item.articulo}</td>
            <td>{$item.categoria}</td>
            <td>{$item.totalVenta}</td>
        </tr>
    {foreachelse}
        <tr class="odd gradeX">
            <td colspan="2"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
    {/foreach}
    </tbody>
</table>
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$result.pages info=$result.info}