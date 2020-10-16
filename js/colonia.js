var AJAX_PATH = WEB_ROOT+"/ajax/colonia.php";
function AddReg(){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=add",		
	  	success: function(response) {

			console.log(response) 
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")
			{
                $("#draggable").modal("show");
                $("#draggable").html(splitResp[1]);
			}
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	

	
}//AddReg

function EditReg(id){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=edit&id="+id,
	  	success: function(response) {
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok"){
                $("#draggable").html(splitResp[1]);
                $("#draggable").modal("show");
			}
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
}//EditReg

function SaveReg(){	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmColonia").serialize(true)+"&page="+$('#page').val(),
		beforeSend: function(){			
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {	
		console.log(response);
			var splitResp = response.split("[#]");
			$("#loader").html("");
			if(splitResp[0] == "ok"){
				$("#draggable").modal("hide");
				$('#tblContent').html(splitResp[1]);
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
	  	data: "type=delete&id="+id+"&page="+p,
		beforeSend: function(){			
			// $("#tblContent").html(LOADER3);
		},
	  	success: function(response) {			
			var splitResp = response.split("[#]");
			if(splitResp[0] == "ok"){
				$('#tblContent').html(splitResp[1]);
			}
			else if(splitResp[0] == "fail")
				alert(msgFail);				
		},
		error:function(){
			alert(msgError);
		}
    });
		
}//DeleteReg
function LoadPage(p){
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=loadPage&p="+p,
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
		},
	  	success: function(response) {
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
	
}//LoadPag
function buscarSol(){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmFiltro").serialize(true)+"&type=buscarSol",
		beforeSend: function(){			
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) 
{			
			var splitResp = response.split("[#]");
				$("#loader").html('');					
			console.log(response)
				$("#tblContent").html(splitResp[1]);

		},
		error:function(){
			alert(msgError);
		}
    });
	
	$("#frmModal").modal("show");
	
}//buscarSol