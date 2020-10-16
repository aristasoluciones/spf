<div class="row">
    {if $complete}
    <div class="col-md-6">
        <a href="{$WEB_ROOT}/poll-result-pdf/id/{$victimaId}" class="btn yellow" target="_blank" title="Ver reporte">
            Ver reporte <i class="fa fa-file-pdf-o"></i>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{$WEB_ROOT}/done-polls" class="btn green-dark btn-finalizar" id="{$victimaId}" title="Finalizar" >
            Finalizar <i class="fa fa-check-circle"></i>
        </a>
    </div>
    {else}
        <div class="aler alert-danger">
            Faltan encuestas por finalizar.
        </div>
    {/if}
</div>