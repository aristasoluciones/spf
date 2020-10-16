var AJAX_PATH = WEB_ROOT+"/ajax/sucursal.php";

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
	
}//AddReg

function SaveReg(Id,reqId,tramiteId){
	
		// $("#type").val("SaveReg");
		$("#auxrequisito").val(reqId);

		// En esta var va incluido $_POST y $_FILES
			var fd = new FormData(document.getElementById("frmGral"));
			$.ajax({
				url: AJAX_PATH,
				data: fd,
				processData: false,
				contentType: false,
				type: 'POST',
				xhr: function(){
						var XHR = $.ajaxSettings.xhr();
						XHR.upload.addEventListener('progress',function(e){
							console.log(e)
							var Progress = ((e.loaded / e.total)*100);
							Progress = (Progress);
							console.log(Progress)
							$('#progress').val(Math.round(Progress));
							$('#porcentaje').html(Math.round(Progress));
							
						},false);
					return XHR;
				},
				beforeSend: function(){		
					$("#loader").html(LOADER);
					$("#erro").hide(0);
				},
				success: function(response){
					
					console.log(response);
					var splitResp = response.split("[#]");

					$("#loader").html("");
					
					if(splitResp[0] == "ok"){
						$("#draggable").modal("hide");
						location.reload();					
					}else if(splitResp[0] == "fail"){
						$("#erro"+reqId).show(0);
						$("#erro").html(splitResp[1]);		
						$("#txtErrMsg").show();
						$("#txtErrMsg").show();
						$("#txtErrMsg").html(splitResp[1]);				
					}else{
						alert(msgFail);
					}
				},
			})
			
		}
		
		
// function SaveReg(){	
	  
	// $.ajax({
	  	// type: "POST",
	  	// url: AJAX_PATH,
	  	// data: $("#frmGral").serialize(true),
		// beforeSend: function(){			
			// $("#loader").html(LOADER);
			// $("#txtErrMsg").hide(0);
		// },
	  	// success: function(response) {
			// console.log(response)		
			// var splitResp = response.split("[#]");

			// $("#loader").html("");
			
			// if(splitResp[0] == "ok"){
				// $("#draggable").modal("hide");
				// location.reload();
				
			// }else if(splitResp[0] == "fail"){
				// console.log(splitResp[0]);
				// $("#txtErrMsg").show();
				// $("#txtErrMsg").html(splitResp[1]);				
			// }else{
				// alert(msgFail);
			// }
			
		// },
		// error:function(){
			// alert(msgError);
		// }
    // });
		
// }//SaveReg

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


