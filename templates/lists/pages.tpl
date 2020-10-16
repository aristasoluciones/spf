{if $registros.result|count > 0}
<div class="fLeft">
    {$info}
</div>
{/if}

{if $search == 1}
    {assign var="function" value="Search"}
{else}
    {assign var="function" value="LoadPage"}
{/if}


{if count($pages.numbers)}
<div class="btn-toolbar margin-bottom-10">
    <ul>
        {if $pages.first}
         <button class="btn btn-default" type="button" onclick="{$function}({$pages.first})"> &laquo; </button>
        {/if}
        {if $pages.prev}
         <button class="btn btn-default" type="button" onclick="{$function}({$pages.prev})"> &lt; </button>
        {/if}
        
        {foreach from=$pages.numbers item=page key=key}
            {if $pages.current == $key}
               <button class=" active btn btn-default" type="button">{$key}</button>
            {else}
               <button class="btn btn-default"  onclick="{$function}({$key-1})">{$key}</button>
            {/if}
        {/foreach}
        
        {if $pages.next}
            <button class="btn btn-default" onclick="{$function}({$pages.next})"> &gt; </button>
        {/if}
        {if $pages.last}
             <button class="btn btn-default" onclick="{$function}({$pages.last})"> &raquo; </button>
        {/if}
    </ul>
</div>
<input type="hidden" name="page" id="page" value="{$pages.current-1}" />
{/if}
 
<div class="clearfix"></div>