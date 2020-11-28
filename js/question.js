var AJAX_PATH = WEB_ROOT+"/ajax/poll.php";
$(document).on('click','.control-audio', function () {
	var element = document.getElementById(this.id);
	var id_complete = this.id.split('_');
	var id = id_complete[1];

	if (element.classList.contains('play')) {
		document.getElementById('src_audio_' + id).pause();
		document.querySelector('a#' + this.id + '>i').style.opacity='0.5';
		element.classList.toggle('play');
	} else {
		document.getElementById('src_audio_' + id).play();
		document.querySelector('a#' + this.id + '>i').style.opacity='1';
		element.classList.toggle('play');
	}


})
function addTranslateQuestion() {

	var translate = {
		language_id: $('#language_id').val(),
		translate_text: $('#translate_text').val()
	}

	var form = new FormData();
	form.append('language_id',translate.language_id);
	form.append('translate_text', translate.translate_text);
	form.append('track_translate', $('#track_translate').prop('files')[0]);
	form.append('type','add_translate');

	$.ajax({
		type: "POST",
		url: WEB_ROOT +'/ajax/question.php',
		data: form,
		processData:false,
		contentType:false,
		beforeSend: function() {
			$('#txtErrMsg').hide();
		},
		success: function(data) {
			var response = JSON.parse(data);
			if(response.status === 'ok') {
				$('#translate_text').val('');
				$('#track_translate').val('');
				$('#list_languages').html(response.content)
			} else {
				$('#txtErrMsg').show();
				$('#txtErrMsg').html(response.message);
			}
		},
		error:function(){
			alert(msgError);
		}
	});
}
function deleteTranslateQuestion(id) {
	var translate = {
		language_id: $('#language_id').val(),
		translate_text: $('#translate_text').val()
	}
	$.ajax({
		type: "POST",
		url: WEB_ROOT +'/ajax/question.php',
		data: "type=delete_translate&id=" + id,
		datatype: 'json',
		beforeSend: function() {
			$('#txtErrMsg').hide();
		},
		success: function(data) {
			var response = JSON.parse(data);
			if(response.status === 'ok') {
				$('#list_languages').html(response.content)
			} else {
				$('#txtErrMsg').show();
				$('#txtErrMsg').html(response.message);
			}
		},
		error:function(){
			alert(msgError);
		}
	});
}
$(document).on('click', '#btnAddLanguage', addTranslateQuestion);

function checaTipopregunta(){

	// alert('hola')

	if($("#tipo").val()=="punto"){
		$("#div_rango").show();
		$("#div_par").hide();
		$("#div_car").hide();
	}else if($("#tipo").val()=="opcional"){
		$("#div_rango").hide();
		$("#div_par").show();
		$("#div_car").hide();
	}else if($("#tipo").val()=="abierta"){
		$("#div_rango").hide();
		$("#div_par").hide();
		$("#div_car").show();
	}
}

function dateInicio(Id)
	{
		// alert("hola")
		$.datepicker.setDefaults( $.datepicker.regional['es'] );
		$('#inicio').datepicker({
		 dateFormat: 'yy-mm-dd',
		}).focus();

	}

function AddReg(Id){
	$.ajax({
	  	type: "POST",
	  	url: WEB_ROOT +'/ajax/question.php',
	  	data: "type=addQuestion&Id="+Id,
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok")
				$("#draggable").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

	$("#draggable").modal("show");

}//AddReg
function EditReg(id){
	$.ajax({
	  	type: "POST",
	  	url: WEB_ROOT +'/ajax/question.php',
	  	data: "type=addQuestion&id="+id,
	  	success: function(response) {
			var splitResp = response.split("[#]");

			if(splitResp[0] == "ok")
			{
				$("#draggable").html(splitResp[1]);
			}
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });

	$("#draggable").modal("show");

}//AddReg
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
			var splitResp = response.split("[#]");
			$("#loader").html("");
			if(splitResp[0] == "ok"){
				$("#draggable").modal("hide");
				location.reload();
			}else if(splitResp[0] == "fail"){
				console.log(splitResp[0]);
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

}//SaveReg



function SaveQuestions(){

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmGral").serialize(true),
		beforeSend: function(){
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {
			var splitResp = response.split("[#]");
			$("#loader").html("");
			if(splitResp[0] == "ok"){
				$("#draggable").modal("hide");
				location.reload();
			}else if(splitResp[0] == "fail"){
				console.log(splitResp[0]);
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

}//SaveQuestions

function RemoveReg(id){

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=remove&id="+id,
	  	success: function(response) {
		console.log(response)
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok")
				location.reload();
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
}//RemoveReg
function ActiveReg(id){

	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=activar&id="+id,
	  	success: function(response) {
		console.log(response)
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok")
				location.reload();
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
}//ActiveReg




function DeleteQuestion(id){
	var resp = confirm("Esta seguro de eliminar este registro?");
	if(!resp)
		return;
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=DeleteQuestion&id="+id,
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok")
				location.reload();
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
}//RemoveReg
