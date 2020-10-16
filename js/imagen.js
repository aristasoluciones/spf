var AJAX_PATH = WEB_ROOT+"/ajax/imagen.php";

function AddReg(){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: "type=add",		
	  	success: function(response) {			
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok")
			{
				$("#add_new_image").html(splitResp[1]);
				$("#add_new_image").show();	
			}
			else
				alert(msgFail);
		},
		error:function(){
			alert(msgError);
		}
    });	
}//AddReg
function hidenForm(){
   $("#descripcion").val("");	 
   $("#add_new_image").hide();	
}
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
function SaveReg(){	
	 var ele  =document.getElementById('frmImg');
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
				/*$("#draggable").modal("hide");*/
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

	
function verForm(id)
{
  switch(id.value){
 		case 'empty':
 			  $("#row_detail").hide();
 		break;
 		case 'slider':
 		 	  $("#row_detail").hide();
 		break;
       
       case 'producto':
 		 	  $("#row_detail").show();
 		break;
       
   }
 }