var AJAX_PATH = WEB_ROOT+"/ajax/rol.php";

$(document).on('click','.spanConfig',function () {
	$.ajax({
		type: "POST",
		url: AJAX_PATH,
		data:{id:this.id,type:'open_config'},
		success: function(response) {
			$("#draggable").html(response);
			$('#saveConfig').on('click',function(){
				SaveConfig();
			});
			TogglePermisos();
		},
		error:function(){
			alert(msgError);
		}
	});
	$("#draggable").modal("show");
});
function TogglePermisos(){
	$('.deepList').on('click',function(){
		if($("ul#"+this.id).is(':visible')){
			$("#"+this.id).html('[+]-');
			$("ul#"+this.id).removeClass('siShow');
		}
		else
		{
			$('#'+this.id).html('[-]-');
			$("ul#"+this.id).addClass('siShow');
		}

	});
}
function SaveConfig(){
	var fd =  new FormData(document.getElementById("frmPermisos"));
	$.ajax({
		url:AJAX_PATH,
		method:'post',
		data:fd,
		processData: false,
		contentType: false,
		type: 'POST',
		beforeSend: function(){
			$("#loader").html(LOADER);
			$("#txtErrMsg").hide(0);
			$('#saveConfig').hide();
		},
		success: function(response){
			var splitResp = response.split("[#]");
			if(splitResp[0]=='ok'){
				$("#draggable").modal("hide");
			}
			else{
				$("#loader").hide();
				$('#saveConfig').show();
				$("#txtErrMsg").show();
				$("#txtErrMsg").html(splitResp[1]);
			}
		}
	});
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
	  	data: "type=edit&id="+id,		
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
	
}//EditReg
function DeleteReg(id){
	bootbox.confirm("¿ Esta seguro de eliminar este rol ?",function(res){
	  if(!res)
	  	 return;

        $.ajax({
            type:"POST",
            url:AJAX_PATH,
            data:"type=deleteRol&id="+id,
            success:function(response){
                var splitResp = response.split("[#]");
                if(splitResp[0] == "ok")
               	{
					$("#message_success").html(splitResp[1]);
					$("#tblContent").html(splitResp[2]);
				}
                else
                 alert(msgFail);
            },
            error:function(){
                alert(msgError)
            }
        });
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
				$("#message_success").html(splitResp[1]);
				$("#tblContent").html(splitResp[2]);
				
			}else if(splitResp[0] == "fail"){
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


