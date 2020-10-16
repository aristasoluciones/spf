<form  enctype="multipart/form-data" id="frmFiltroRankin" action="#" method="post" class="form-horizontal">
    <input type="hidden" name="type" value="doSearchRankin">
     <div class="form-body">
        <div class="row" align="center">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span class="reqIcon"></span>Periodo</label>
                    <div class="input-group input-large">
                       <input class="form-control" name="finicial" id="finicial" onclick="Calendario(this)">
                        <span class="input-group-addon">al</span>
                        <input class="form-control" name="ffinal" id="ffinal" onclick="Calendario(this)">
                    </div>
                </div>
             </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label"><span class="reqIcon"></span>Detallar por</label>
                    <select name="tipoDetalle" id="tipoDetalle" class="form-control input-medium">
                       <option value="">Seleccionar...</option>
                       <option value="cliente">Cliente</option>
                       <option value="hora">Hora</option>

                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col-md-offset-5 col-md-9">
                <button type="button" class="btn green"  onclick="doSearch()">Buscar</button>
            </div>
        </div>
    </div>
</form>
