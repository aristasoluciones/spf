var AJAX_PATH = WEB_ROOT+"/ajax/puesto.php";

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
	  	data: "type=edit&id="+id,		
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
function addRequisito(id,fila){
	$.ajax({
		type:"POST",
		 url:AJAX_PATH,
		data:"type=addRequisito&id="+id,
		success:function(response){

			var splitResp = response.split("[#]");
				console.log(fila);
			if(splitResp[0] == "ok")
			{

				$("#draggable").html(splitResp[1]);
			    $("#draggable").modal('show');
			}
			else
				alert(msgFail);
		},
		error:function(){
			console.log("error");
		}

	});

	

}
function SaveReg(){		  
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmRole").serialize(true),
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
			{ 
			  $("#tblContent").html(splitResp[1]);
			}
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });
	
}//LoadPage


