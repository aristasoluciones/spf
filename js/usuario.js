var AJAX_PATH = WEB_ROOT+"/ajax/usuario.php";
function loadDropdown () {
	var options = {
		placeholder: 'Seleccionar un elemento',
		search: false,
		width: '100%',
		minimumResultsForSearch: Infinity,
		ajax: {
			type: 'get',
			url: 'https://gaia.inegi.org.mx/wscatgeo/mgem/07',
			dataType: 'json',
			processResults: function (data) {
				var data = $.map(data.datos, function (obj) {
					return {id: obj.cve_agem, text: obj.nom_agem};
				})
				data.sort(function (a, b) {
					if (a.text > b.text) {
						return 1;
					}
					if (a.text < b.text) {
						return -1;
					}
					return 0;
				})
				return {
					results:data
				}
			}
		},
	}
	var ciudad = $('#ciudad');
	var currentCiudad = $('#currentCiudad');
	ciudad.select2(options);
	if (currentCiudad.val()) {
		$.ajax({
			type: 'GET',
			url: 'https://gaia.inegi.org.mx/wscatgeo/mgem/07/' + currentCiudad.val()
		}).then(function (data) {
			var datos = data.datos;
			var option = new Option(datos[0].nom_agem, datos[0].cve_agem, true, true);
			ciudad.append(option).trigger('change');
			ciudad.trigger({
				type: 'select2:select',
				params: {
					data: data.datos
				}
			});
		})
	}
}
function fnFechaNa(Id) {
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $('#fechanacimiento').datepicker({
        dateFormat: 'yy-mm-dd',
    }).focus();
}
function AddReg(){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=add",
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok") {
                $("#large").html(splitResp[1]);
                loadDropdown();
            }
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

	$("#large").modal("show");

}//AddReg

function EditReg(id){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=edit&id="+id,
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok") {
                $("#large").html(splitResp[1]);
                loadDropdown();
            }
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

	$("#large").modal("show");

}

function SaveReg(){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmGral").serialize(true),
		beforeSend: function(){
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {
		console.log(response);
			var splitResp = response.split("[#]");

			$("#loader").html("");
			if(splitResp[0] == "ok"){
				$("#large").modal("hide");
				 location.reload();
			}else if(splitResp[0] == "fail"){
				$("#txtErrMsg").show();
				$("#txtErrMsg").show();
				$("#txtErrMsg").html(splitResp[1]);
			}else{
				alert(msgFail);
			}

		},
		error:function(){
			alert(msgError);
		}
    });

}

function DeleteReg(id){

	var p = $("#page").val();
	var resp = confirm("Esta seguro de eliminar este registro?");

	if(!resp)
		return;

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=delete&id="+id,
		beforeSend: function(){
		},
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok")
				location.reload();
			else if(splitResp[0] == "fail")
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

}//DeleteReg

function ViewReg(id){

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=view&id="+id,
	  	success: function(response) {
			var splitResp = response.split("[#]");

			if(splitResp[0] == "ok"){
				$("#frmModal").html(splitResp[1]);
			}else{
				alert(msgFail);
			}
		},
		error:function(){
			alert(msgError);
		}
    });

	$("#frmModal").modal("show");

}//ViewReg

function LoadMunicipios(){

	var id = $("#estadoId").val();

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=loadMunicipios&estadoId="+id,
		beforeSend: function(){
			$("#enumMunicipios").html(LOADER2);
		},
	  	success: function(response) {
			var splitResp = response.split("[#]");

			$("#enumMunicipios").html("");

			if(splitResp[0] == "ok"){
				$("#enumMunicipios").html(splitResp[1]);
			}else if(splitResp[0] == "fail"){
				alert(msgFail);
			}

		},
		error:function(){
			alert(msgError);
		}
    });

}//LoadMunicipios

function LoadPage(p){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=loadPage&p="+p,
		beforeSend: function(){
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {
console.log(response)
			var splitResp = response.split("[#]");

			if(splitResp[0] == "ok")
				$("#tblContent").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

}
