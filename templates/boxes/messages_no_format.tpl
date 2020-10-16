{if $errors.value|count > 0}
    {foreach from=$errors.value item="error" key="key"}
       {$error}
       {if $errors.field.$key}: {$errors.field.$key}
       {/if}<br>
    {/foreach}
{/if}