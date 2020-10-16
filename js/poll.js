var AJAX_PATH = WEB_ROOT+"/ajax/poll.php";

function dateInicio(Id)
	{
		// alert("hola")
		$.datepicker.setDefaults( $.datepicker.regional['es'] );
		$('#inicio').datepicker({
		 dateFormat: 'yy-mm-dd',
		}).focus();

	}

	
	
function cargaDate(Id)
	{
		// alert("hola")
		$.datepicker.setDefaults( $.datepicker.regional['es'] );
		$('#fecha_'+Id).datepicker({
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
	  	url: AJAX_PATH,
	  	data: "type=add&id="+id,
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
			console.log(response)		
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
function DeleteReg(id){
	
	var resp = confirm("Esta seguro de eliminar este registro?");
	
	if(!resp)
		return;
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=DeleteReg&id="+id,		
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


