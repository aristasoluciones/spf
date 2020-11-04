<div class="bs-stepper">
    <div class="bs-stepper-header">
        {foreach from=$preguntas item=item key=key}
            <div class="step" data-target="#step-{$key}">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">{$key +1}</span>
                    <span class="bs-stepper-label">{$item.pregunta}</span>
                </button>
            </div>
         {/foreach}
    </div>
    <div class="bs-stepper-content">
        <!-- your steps content here -->
        {foreach from=$preguntas item=item key=key}
            <div id="step-{$key}" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
                <button class="btn btn-primary" onclick="">Next</button>
            </div>
        {/foreach}
    </div>
</div>
