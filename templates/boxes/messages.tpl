{if $errors.value|count > 0}
<div class="alert alert-success">
    <button class="close" data-dismiss="alert"></button>
     {foreach from=$errors.value item="error" key="key"}
    	<strong>!Exito!</strong> {$error}  
	{/foreach}
</div>
{/if}