<form id="frmGral" action="#" class="form-horizontal form-bordered form-label-stripped" onsubmit="return false">
	<input type="hidden" name="encuestaId" value="{$info.encuestaId}" />
	<input type="hidden" name="type" value="save" />
	<div class="form-body">
	  <div class="row">
		  <div class="col-md-6">
			  <div class="form-group">
				  <label class="col-md-12"><span class="reqIcon"> * </span>Nombre</label>
				  <div class="col-md-12">
					  <input type="text" class="form-control" name="nombre" value="{$info.nombre}"  />
				  </div>

			  </div>
			  <div class="form-group">
				  <label class="col-md-12"><span class="reqIcon"> * </span>Contexto</label>
				  <div class="col-md-12">
					  <select class="form-control" name="contexto">
						  <option value="Todos" {if $info.tipo eq "Todos"}selected{/if}>Todos</option>
						  <option value="Urbano" {if $info.tipo eq "Urbano"}selected{/if}>Urbano</option>
						  <option value="Indigena" {if $info.tipo eq "Indigena"}selected{/if}>Indigena</option>
					  </select>
				  </div>
			  </div>
			  <div class="form-group">
				  <label class="col-md-12"><span class="reqIcon"> * </span>Inicio</label>
				  <div class="col-md-12">
					  <input type="text" class="form-control" name="inicio"  id="fecha_1" value="{$info.inicio}"  onClick='cargaDate(1)' />
				  </div>
			  </div>
			  <div class="form-group">
				  <label class="col-md-12"><span class="reqIcon"> * </span>Fin</label>
				  <div class="col-md-12">
					  <input type="text" class="form-control" name="fin" id="fecha_2" value="{$info.fin}"  onClick='cargaDate(2)' />
				  </div>
			  </div>
		  </div>
		  <div class="col-md-6">
			  <label>Traducir encuesta a las siguientes lenguas.</label>
			  <div class="row">
				  <div class="col-md-4">
					  <div class="form-group">
						  <label class="col-md-12"><span class="reqIcon">*</span> Lengua</label>
						  <div class="col-md-12">
							  <select name="language_id" id="language_id" class="form-control">
								  {foreach from=$localLanguage  item=item}
									  <option value="{$item.id}">{$item.name}</option>
								  {/foreach}
							  </select>
						  </div>
					  </div>
				  </div>
				  <div class="col-md-8">
					  <div class="form-group">
						  <label class="col-md-12"><span class="reqIcon">*</span> Encuesta traducida</label>
						  <div class="col-md-12">
							  <input name="translate_text" id="translate_text" class="form-control" />
						  </div>
					  </div>
				  </div>
				  <div class="col-md-3">
					  <button class="btn btn-primary" id="btnAddLanguage">Agregar</button>
				  </div>
			  </div>
			  <div class="margin-bottom-5"></div>
			  <div class="row">
				  <div class="col-md-12"  id="list_languages">
					  {include file="{$DOC_ROOT}/templates/lists/poll_translate.tpl" result=$translates localLanguageLineal=$localLanguageLineal}
				  </div>
			  </div>
		  </div>
	  </div>
	</div>
</form>
