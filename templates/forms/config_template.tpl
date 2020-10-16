<script src="{$WEB_ROOT}/assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<div class="row-fluid">
  <div class="tab-pane active" id="tab_0">
	<div style="margin:-11px" class="portlet" >
 <!-- <div class="portlet-title">
         <div class="caption"><i class="icon-reorder"></i>{if !$info.view}Ingrese los {/if}Datos</div>                
      </div>-->
      <div class="portlet-body form">
       <!-- BEGIN FORM-->
		<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped">
			{if $info}
			<input type="hidden" name="type" value="saveConfig" />
			<input type="hidden" name="id" value="{$row.catalogo_tramite_id}" />
            {else}
			<input type="hidden" name="type" value="save" />
			{/if}
		  <div class="form-body">
		     {foreach from=$listReq item=item key=key}
              <div class="form-group">
               <label class="control-label col-md-9"><span class="reqIcon"></span>{$item.nombre}</label>
				<div class="col-md-3">
				<div class="make-switch">
				<input class="make-switch" type="checkbox" data-off-color="warning" data-on-color="success">
				<input checked data-toggle="toggle" type="checkbox">
                </div>
				</div>
			  </div>
		     {/foreach}
		  </div>         
         </form>                  
         </div>
       </div>
    </div>
</div>