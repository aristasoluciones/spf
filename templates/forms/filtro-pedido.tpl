<div class="portlet-title">
    <div class="caption">
        <i class="icon-settings font-green"></i>
         Filtro de busqueda
    </div>
</div>
<div class="portlet-body form">
    <form  enctype="multipart/form-data" id="frmFiltroPedido" action="#" method="post" class="form-horizontal form-bordered form-label-stripped">
        <input type="hidden" name="type" value="buscarPedido">
         <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>Folio</label>
                        <div class="col-md-9">
                           <input class="form-control" name="folio" id="folio">
                        </div>
                    </div>
                 </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3"><span class="reqIcon"></span>Sucursal</label>
                        <div class="col-md-9">
                          {if $all_sucursales}
                           <select name="sucursalId" id="sucursalId" class="form-control">
                               <option value="">Seleccionar sucursal</option>
                               {foreach from=$sucursales item=item key=key}
                                <option value="{$item.sucursalId}">{$item.nombre}</option>
                               {/foreach}
                           </select>
                          {else}
                              <input type="text" name="namesucursal" class="form-control" value="{$suc.nombre}" readonly>
                              <input type="hidden" name="sucursalId" id="sucursalId" value="{$suc.sucursalId}">
                          {/if}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-">
            <div class="row">
                <div class="col-md-offset-4 col-md-9">
                    <button type="button" class="btn green"  onclick="buscarPedidos()">Buscar</button>
                </div>
            </div>
        </div>
    </form>
</div>