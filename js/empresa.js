var AJAX_PATH = WEB_ROOT+"/ajax/config.php";

function SaveReg()
		{   
		// $("#type").val("changeLogo");
		// En esta var va incluido $_POST y $_FILES
			var fd = new FormData(document.getElementById("frmDatos"));
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