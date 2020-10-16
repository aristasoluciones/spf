var AJAX_PATH = WEB_ROOT+"/ajax/config.php";

function CambiarTema(id){
	
	$.ajax({
	  	type: "POST",
	  	url: AJAX_PATH,
	  	data: $("#frmGeneral").serialize(true)+"&type=CambiarTema&id="+id,
		beforeSend: function(){			
		},
	  	success: function(response) {	
	
			console.log(response);
			var splitResp = response.split("[#]");
									
			if(splitResp[0] == "ok"){
				// alert("ok")
				location.reload();
			}else{
				alert("no se puede realizar esta operacion")
			}
		},
		error:function(){
			alert(msgError);
		}
    });

}






function changeLogo(Id)
		{   
		// $("#type").val("changeLogo");
		// En esta var va incluido $_POST y $_FILES
			var fd = new FormData(document.getElementById("frmGral"));
			fd.append('type','changeLogo');
			fd.append('Id',Id);
			
			$.ajax({

				url: AJAX_PATH,
				data: fd,
				processData: false,
				contentType: false,
				type: 'POST',
				beforeSend: function(){
	
				},
				success: function(response){
							
					console.log(response)
					var splitResp = response.split('[#]');

					if($.trim(splitResp[0]) == 'ok'){	
								location.reload();
							// $(location).attr('href',WEB_ROOTDoc);
					}
					else if($.trim(splitResp[0]) == 'fail'){
							
							$("#txtErrMsg").show();
							$("#txtErrMsg").html(splitResp[1]);
					}
					else{
						
							$("#txtErrMsg").html(splitResp[1]);
					}
	
				},
			})
			
		}	