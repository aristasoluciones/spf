<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-green-haze">
            <i class="icon-user font-green-haze"></i>
            <span class="caption-subject bold uppercase"> {$info.nombre}</span>
        </div>
    </div>
    <div class="portlet-body">
        <form action="" class="form-horizontal" name="poll_{$info.encuestaId}" id="poll_{$info.encuestaId}" onsubmit="return false;">
            <input type="hidden" id="victimaId"  name="victimaId" value="{$victimaId}">
            <input type="hidden" id="type" name="type" value="saveEncuestaVictima">
            <input type="hidden" id="pollId" name="pollId" value="{$info.encuestaId}">
            <input type="hidden" id="pollVictimaId_{$info.encuestaId}" name="pollVictimaId" value="{if $pollVictimaId}{$pollVictimaId}{/if}">
            <div class="form-body">
                {foreach from=$preguntas item=item key=key}
                   <div class="form-group">
                   <label class="font-hg">{$key+1}.- {$item.pregunta}</label>
                   {if $item.tiporespuesta eq 'punto'}
                       {$item.rango1}
                       {$item.rango2}
                       <div id="slider"></div>
                   {elseif $item.tiporespuesta eq 'opcional'}
                           <div class="form-group form-md-radios has-success">
                               <div class="col-md-12">
                                   <div class="md-radio-inline">
                                       {foreach from=$item.opciones item=item2 key=key}
                                           <div class="md-radio">
                                               <input type="radio" name="question_{$item.preguntaId}" id="question_{$item.preguntaId}_{$key}" value='{$item2}' class="md-radiobtn" {if $item.currentAnswer eq $item2}checked{/if}>
                                               <label for="question_{$item.preguntaId}_{$key}">
                                                   <span class="inc"></span>
                                                   <span class="check"></span>
                                                   <span class="box"></span>
                                                   {$item2}
                                               </label>
                                           </div>
                                       {/foreach}
                                   </div>
                               </div>
                           </div>
                       </div>
                   {else}
                   <textarea name='check_{$item.preguntaId}'  class="form-control"></textarea>
                   {/if}
                {/foreach}
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6" id="notificaciones">
                            <div align="center" id="loader"></div>
                            <div align="center" id="txtErrMsgQuestion{$info.encuestaId}" class="alert alert-danger" style="display:none"></div>
                            <div align="center" id="txtSuccMsgQuestion{$info.encuestaId}" class="alert alert-success" style="display:none"></div>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn green btnPoll" >{if $post}Actualizar{else}Guardar{/if}</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>