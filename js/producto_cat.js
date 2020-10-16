var AJAX_PATH = WEB_ROOT+"/ajax/producto.php";

function AddReg(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=add_pcat&id="+id,		
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
	  	data: "type=edit_pcat&id="+id,		
	  	success: function(response) {	
		console.log(response)		
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
	
}//EditReg
function SaveReg(){		  
	var ele  =document.getElementById('frmGral');
     var frm = new FormData(ele);
	$.ajax({
	  	type: "POST",
	  	 url: AJAX_PATH,
	  	 data: frm,
  processData: false,  // tell jQuery not to process the data
  contentType: false,
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
	


