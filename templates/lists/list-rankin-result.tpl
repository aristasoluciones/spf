<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
    <tr>
        <th width="200"><div align="center">{if $nameField eq "cliente"}Cliente{elseif $nameField eq "hora"}Hora{else}Cliente{/if}</div></th>
        <th width="200"><div align="center">Total de pedidos</div></th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$result item=item key=key}
        <tr class="odd gradeX">
            <td>{$item.nameField}</td>
            <td>{$item.pedidosTotal}</td>
        </tr>
    {foreachelse}
        <tr class="odd gradeX">
            <td colspan="2"><div align="center">Ning&uacute;n registro encontrado.</div></td>
        </tr>
    {/foreach}
    </tbody>
</table>
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$result.pages info=$result.info}