var AJAX_PATH = WEB_ROOT+"/ajax/customer-basic.php";


function buscarCliente(){	
	  
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmFiltro").serialize(true),
		beforeSend: function(){			
			$("#tblContent").html(LOADER3);
			$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {
			console.log(response)		
			// var splitResp = response.split("[#]");

			$("#tblContent").html("");
			
			
			$("#tblContent").html(response);
				
			
		},
    });
		
}//SaveReg
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


function fechaPick(id){
	
	$.datepicker.setDefaults( $.datepicker.regional['es'] );
		$('#fecha_'+id).datepicker({
		 dateFormat: 'yy-mm-dd',
		}).focus();
}
