var AJAX_PATH = WEB_ROOT+"/ajax/rol.php";


function SaveConfig(){		  
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmConfigRole").serialize(true),
		beforeSend: function(){			
			$("#loader").html(LOADER);
			//$("#txtErrMsg").hide(0);
		},
	  	success: function(response) {
			
			console.log(response)
	  		var splitResp = response.split("[#]");
			$("#loader").html("");
			
			if(splitResp[0] == "ok"){
				window.location.href = WEB_ROOT+"/rol"
				
			}else if(splitResp[0] == "fail"){
				console.log(splitResp[0]);
				$("#txtErrMsg").show();
				$("#txtErrMsg").html(splitResp[1]);				
			}else{
				console.log("dddd");
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

function verNivel(id){
	// alert(id)
	$("#td_"+id).toggle()
}
