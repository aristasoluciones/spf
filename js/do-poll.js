$(function () {
    var AJAX_PATH = WEB_ROOT+"/ajax/poll.php";
    $("ul.steps a").on("click",function () {
        var id = $(this).data("id");
        var victimaId  = $("#id").length ? $("#id").val() : "";
        var name = $(this).data("name");
        $.ajax({
            type: "POST",
            url: AJAX_PATH,
            data: "type=getQuestions&id="+id+"&victimaId="+victimaId,
            beforeSend: function(){
            },
            success: function(response) {
                $("#"+name).html(response);
            },
            error:function(){
                alert(msgError);
            }
        });
    });
    $("#btnSaveDataVictima").on(
        "click",
        function () {
          var form = $(this).parents("form:first");
          var frm =  new FormData(form[0]);
          frm.append("tipoContexto",$("#tipoContexto").val());
          $.ajax({
              type: "POST",
              url: AJAX_PATH,
              data: frm,
              processData:false,
              contentType:false,
              beforeSend: function(){
              },
              success: function(response) {
                  var splitResp = response.split("[#]");
                  if(splitResp[0] == "ok"){
                      location.href = WEB_ROOT+"/do-poll/id/"+splitResp[1];
                  }else{
                      $("#txtErrMsg").show();
                      $("#txtErrMsg").html(splitResp[1]);
                  }
              },
              error:function(){
                  alert(msgError);
              }
          });
        }
    );
    $("#showResultado").on(
        "click",
        function () {
            var victimaId  = $("#id").length ? $("#id").val() : "";
            var contexto  = $("#tipoContexto").length ? $("#tipoContexto").val() : "";
            $.ajax({
                type:"POST",
                url:WEB_ROOT+"/ajax/do-poll.php",
                data: "type=showResultado&victimaId="+victimaId+"&tipoContexto="+contexto,
                beforeSend: function () {

                },
                success:function (response) {
                    var splitResp = response.split("[#]")
                    $("#tabVerResultado").html(splitResp[1]);

                }
            });

        }
    );
    var resetTabPane = ()=>{
       var de =  document.querySelectorAll("div.tab-content div.dinamic-child");
       de.forEach((tab)=>{
        $(tab).html("");
       });
    };
    $("#tipoContexto").on(
        "change",
        function () {
            var tipo =  $(this).children("option:selected").val();
            switch(tipo){
                case 'Urbano':
                    $(".form-wizard").show();
                    $("."+tipo).show();
                    $(".Indigena").hide();

                break;
                case 'Indigena':
                    $(".form-wizard").show();
                    $("."+tipo).show();
                    $(".Urbano").hide();
                break;
                default:
                    $(".form-wizard").toggle();
                break;
            }
            resetTabPane();
        }
    );
    $('#frm-poll-wizard').bootstrapWizard();
});
$(document).on(
    "click",
    ".btnPoll",
    function(){
        var form = $(this).parents("form:first");
        $.ajax({
            type: "POST",
            url: WEB_ROOT+"/ajax/do-poll.php",
            data: form.serialize(true),
            beforeSend: function(){
                $("div#notificaciones > .alert").hide();
            },
            success: function(response) {
                var splitResp = response.split("[#]");
                if(splitResp[0] == "ok"){
                    $("#txtSuccMsgQuestion"+splitResp[2]).show();
                    $("#txtSuccMsgQuestion"+splitResp[2]).html(splitResp[1]);
                    if(splitResp[3])
                        $("#pollVictimaId_"+splitResp[2]).val(splitResp[3]);
                }else{
                    $("#txtErrMsgQuestion"+splitResp[2]).show();
                    $("#txtErrMsgQuestion"+splitResp[2]).html(splitResp[1]);
                }
            },
            error:function(){
                alert(msgError);
            }
        });
    }
);