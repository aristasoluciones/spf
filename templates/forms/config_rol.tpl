<form id="frmPermisos" name="frmPermisos" method="post">
    <input type="hidden" id="type" name="type" value="save_config"/>
    <input type="hidden" id="id" name="id" value="{$info.rolId}"/>
    <div class="formLine" style="width:100%; text-align:left">
        {function name=draw_permiso level=0 father=''}
            <ul class="noShow level{$level}" id="level{$level}">
                {foreach from=$data item=item key=key}
                    {if $item.children|@count > 0}
                        <li>
                            <a href="javascript:void(0);" class="deepList" id="level{$key}{$item.permisoId}">[+]-</a>
                            <label class="mt-checkbox mt-checkbox-outline">
                                {$item.titulo}
                                <input type="checkbox" name="permisos[]" value="{$item.permisoId}" class="father-{$item.permisoId} child-{$father}" {if $item.letMe}checked{/if}/>
                                <span></span>
                            </label>
                        </li>
                        {draw_permiso data=$item.children level="{$key}{$item.permisoId}" father="{$item.permisoId}"}
                    {else}
                        <li>
                            <a href="javascript:void(0);">[<small>{'x'|lower}</small>]-</a>
                            <label class="mt-checkbox mt-checkbox-outline">
                                {$item.titulo}
                                <input type="checkbox" name="permisos[]" value="{$item.permisoId}" class="father-{$item.permisoId} child-{$father}" {if $item.letMe}checked{/if}/>
                                <span></span>
                            </label>
                        </li>
                    {/if}
                {/foreach}
            </ul>
        {/function}
        <ul id="lista-main">
            {foreach from=$modulos item=item key=key}
                {if $item.children|@count > 0}
                    <li>
                        <a href="javascript:void(0);" class="deepList " id="level{$key}{$item.permisoId}">[+]-</a>
                        <label class="mt-checkbox mt-checkbox-outline">
                            {$item.titulo}
                            <input type="checkbox" name="permisos[]" class="father-{$item.permisoId}" value="{$item.permisoId}" {if $item.letMe}checked{/if}/>
                            <span></span>
                        </label>
                    </li>
                    {draw_permiso data=$item.children level="{$key}{$item.permisoId}" father="{$item.permisoId}"}
                {else}
                    <li>
                        <a href="javascript:void(0);">[<small>{'x'|lower}</small>]-</a>
                        <label class="mt-checkbox mt-checkbox-outline">
                            {$item.titulo}
                            <input type="checkbox" name="permisos[]" value="{$item.permisoId}"  class="father-{$item.permisoId}" {if $item.letMe}checked{/if}/>
                            <span></span>
                        </label>
                    </li>
                {/if}
            {/foreach}
        </ul>
    </div>
</form>