<div class="table-container">
    {include file="{$DOC_ROOT}/templates/boxes/messages.tpl"}
    <table class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
        <tr>
            <th>Lenguage</th>
            <th>Pregunta traducida</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        {foreach from=$result item=item key=key}
            <tr>
                <td>{$localLanguageLineal[$item.language_id]}</td>
                <td>{$item.text}</td>
                <td>
                    <a class="btn btn-xs red" href="javascript:void(0)"
                       onClick="deleteTranslateQuestion({$key})" title="Eliminar">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                </td>

            </tr>
        {foreachelse}
            <tr>
                <td colspan="7">
                    <div align="center">Ning&uacute;n registro encontrado</div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>
</div>
