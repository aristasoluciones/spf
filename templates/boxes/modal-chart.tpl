<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a href="javascript:;" class="close" data-dismiss="modal" aria-hidden="true"></a>
            <h4 class="modal-title">Violentometro</h4>
        </div>
        <div class="modal-body">
            <div id="modal-chart" style="min-height: 250px"></div>
            <div class="row">
                <div class="col-md-4 text-justify" style="background: yellow;min-height: 39px">Riesgo bajo</div>
                <div class="col-md-4 text-justify" style="background: orange;min-height: 39px">Riesgo moderado</div>
                <div class="col-md-4 text-justify " style="background: red;min-height: 39px">Riesgo severo</div>
            </div>
            <hr class="clearfix" />
            <form action="" onsubmit="return false;" name="frmComentario" id="frmComentario" class="form-horizontal">
                <input type="hidden" id="type" name="type" value="saveComentario">
                <input type="hidden" id="vId" name="vId" value="{$info.victimaId}">
                <div class="form-group">
                    <label class="control-label col-md-3"><span class="reqIcon"></span>Observaciones:</label>
                    <div class="col-md-9">
                        <textarea name = "comentarioAdicional"  id="comentarioAdicional" class="form-control">{$info.comentarioAdicional}</textarea>
                    </div>
                </div>
            </form>
            <div class="row">
                <div id="txtMessage">

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div align="center" id="loader"></div>
            <button class="btn green"  id="btnComentario">Guardar comentario</button>
        </div>

    </div>
</div>