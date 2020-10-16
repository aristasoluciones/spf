var AJAX_PATH = WEB_ROOT+"/ajax/usuario.php";

function fnFechaNa(Id)
	{
		// alert("hola")
		$.datepicker.setDefaults( $.datepicker.regional['es'] );
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
									
			if(splitResp[0] == "ok")
				$("#large").html(splitResp[1]);
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
	console.log(response);
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")	
				$("#large").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#large").modal("show");
	
}//EditReg

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
		
}//SaveReg

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

function ShowEstablo(value){
	if(value == "operacion"){
		$("#div_Establo").show();
	}else{
		$("#div_Establo").hide();
	}

}

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
	
}//LoadPage



//ciudadano



function AddRegCiudadano(){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
	  	data: "type=addCiudadano",		
	  	success: function(response) {			
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")
				$("#frmModal").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//AddReg

function EditRegCiudadano(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
	  	data: "type=editCiudadano&id="+id,
	  	success: function(response) {
	console.log(response);
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")	
				$("#frmModal").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//EditReg

function SaveRegCiudadano(){
	
	var p = $("#page").val();
	var id = $("#id").val();
			
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
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
				$("#frmModal").modal("hide");
				
				if(id == "") 
					p = 0;
					
				LoadPageCiudadano(p);
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
		
}//SaveReg

function DeleteRegCiudadano(id){
	
	var p = $("#page").val();
	var resp = confirm("Esta seguro de eliminar este registro?");
	
	if(!resp)
		return;
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
	  	data: "type=delete&id="+id,
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {			
			var splitResp = response.split("[#]");

			$("#tblContent2").html("");
			
			if(splitResp[0] == "ok")
				LoadPageCiudadano(p);
			else if(splitResp[0] == "fail")
				alert(msgFail);				
		},
		error:function(){
			alert(msgError);
		}
    });
		
}//DeleteReg

function ViewRegCiudadano(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
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

function LoadPageCiudadano(p){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATHCiuda,
	  	data: "type=loadPage&p="+p+'&page=ciudadano',
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {
				console.log(response)
			var splitResp = response.split("[#]");
			
			if(splitResp[0] == "ok")
				$("#tblContent2").html(splitResp[1]);
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
}//LoadPage