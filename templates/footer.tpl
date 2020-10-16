{if $page == "login"}
	<div class="copyright"><!--
		<img src="{$WEB_ROOT}/images/poweredby8.png" border="0" width="85" height="" />-->
		&nbsp;&nbsp;&nbsp;&nbsp;{$smarty.const.FOOTER}
		
	</div>
{else}
    <div class="page-footer">
        <div class="page-footer-inner"><!--
			 <img src="{$WEB_ROOT}/images/poweredby.png" border="0" width="85" height="" />-->
           <small>{$FOOTER}</small>
        </div>
        <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
        </div>
    </div>
{/if}