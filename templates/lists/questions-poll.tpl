<form action="" class="form-horizontal" name="poll_{$info.encuestaId}" id="poll_{$info.encuestaId}" onsubmit="return false;">
    <input type="hidden" id="victimaId"  name="victimaId" value="{$victimaId}">
    <input type="hidden" id="type" name="type" value="saveEncuestaVictima">
    <input type="hidden" id="pollId" name="pollId" value="{$info.encuestaId}">
    <input type="hidden" id="pollVictimaId_{$info.encuestaId}" name="pollVictimaId" value="{if $pollVictimaId}{$pollVictimaId}{/if}">
    <div class="mt-element-list">
        <div class="mt-list-head list-default green-seagreen">
            <div class="list-head-title-container">
                <h3 class="list-title uppercase sbold">{if $local_language > 0}{$info.translate_name}{else}{$info.nombre}{/if}</h3>
            </div>
        </div>
        <div class="mt-list-container list-default">
            <div class="panel-collapse collapse in" id="completed">
                <ul>
                    {foreach from=$preguntas item=item key=key}
                    <li class="mt-list-item done">
                        <div class="list-icon-container">
                            <a href="javascript:;">
                                <i class="icon-symbol-female"></i>
                            </a>
                        </div>
                        <div class="list-datetime">
                            {if $item.audio}
                                <a class="btn-icon-only control-audio" href="javascript:;" title="Reproducir audio" id="control_{$item.preguntaId}">
                                    <i class="fa fa-volume-up fa-2x" style="color:#878585; opacity: .5"></i>
                                </a>
                                <audio
                                        src="{$item.path_file}"
                                        hidden
                                        id="src_audio_{$item.preguntaId}"
                                ></audio>
                            {/if}
                        </div>
                        <div class="list-item-content">
                            <h3 class="uppercase">
                                <a href="javascript:;">{$item.pregunta}</a>
                            </h3>
                            <p>
                            <div class="form-group form-md-radios has-success">
                                <div class="col-md-12">
                                    <div class="md-radio-inline">
                                        {foreach from=$item.opciones item=item2 key=key}
                                            <div class="md-radio">
                                                <input type="radio" name="question_{$item.preguntaId}" id="question_{$item.preguntaId}_{$key}" value='{$item2.value}' class="md-radiobtn" {if $item.currentAnswer eq $item2.value}checked{/if}>
                                                <label for="question_{$item.preguntaId}_{$key}">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    {$item2.label}
                                                </label>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                    </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12" id="notificaciones">
                <div align="center" id="loader"></div>
                <div align="center" id="txtErrMsgQuestion{$info.encuestaId}" class="alert alert-danger" style="display:none"></div>
                <div align="center" id="txtSuccMsgQuestion{$info.encuestaId}" class="alert alert-success" style="display:none"></div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn green btnPoll" >{if $post}{$translates.personal_data.saveButton.label}{else}{$translates.personal_data.updateButton.label}{/if}</button>
            </div>
        </div>
    </div>
</form>
