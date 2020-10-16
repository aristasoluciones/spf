<div class="table-container">
    {include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
    <table class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
        <tr>
            <th>Clave</th>
            <th>Pregunta</th>
            <th>Tipo</th>
            <th>Parametros</th>
            <th>Acci&oacute;n</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$registros.result item=item key=key}
            <tr>
                <td>{$item.orden}</td>
                <td>{$item.pregunta}</td>
                <td>{$item.tiporespuesta}</td>
                <td>
                    {$item.parametros}
                    {if $item.tiporespuesta eq "punto"}
                        {$item.rango}
                    {else if $item.tiporespuesta eq "opcional"}
                        {$item.opcional}
                    {else if $item.tiporespuesta eq "abierta"}
                        {$item.numCaracter}
                    {/if}

                </td>
                <td>
                    <div align="center">
                        {if in_array(41,$privilegios) or $Usr.rolId eq 1}
                            <a href="javascript:void(0)" class="btn btn-xs yellow" onClick="EditReg({$item.preguntaId})"
                               title="Editar">
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                        {/if}
                        {if in_array(42,$privilegios) or $Usr.rolId eq 1}
                            <a class="btn btn-xs red" href="javascript:void(0)"
                               onClick="DeleteQuestion({$item.preguntaId})" title="Eliminar">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        {/if}
                    </div>
                </td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="7">
                    <div align="center">Ning&uacute;n registro encontrado.</div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>
<!--
{include file="{$DOC_ROOT}/templates/lists/pages.tpl" pages=$registros.pages info=$registros.info}-->