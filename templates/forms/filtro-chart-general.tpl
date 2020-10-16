<form id="frmFiltroChartGeneral" name="frmFiltroChartGeneral" method="post" onsubmit="return false;">
    <input type="hidden" name="type" value="searchGrafica">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Detallar grafica por</label>
                <select name="detail" id="detail" class="form-control">
                    <option value="">General</option>
                    <option value="month">Meses</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Año</label>
                <select name="year" id="year" class="form-control">
                    {for $init=2000 to $year}
                        <option value="{$init}" {if $init == $year} selected="selected" {/if}>{$init}</option>
                    {/for}
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Mes</label>
                <select name="mes" id="mes" class="form-control">
                    <option value="">Todos</option>
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="">Contexto</label>
                <select name="contexto" id="contexto" class="form-control">
                    <option value="">Todos</option>
                    <option value="Urbano">Urbano</option>
                    <option value="Indigena">Indigena</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button id="btnSearch" class="btn btn-success">Buscar</button>
        </div>
    </div>
</form>