$(window).load(function() {
    var initMunicipio = $('#municipioLimited').length ? $('#municipioLimited').val() : '';
    var options = {
        placeholder: 'Seleccionar un elemento',
        search: false,
        width: '100%',
        minimumResultsForSearch: Infinity,
        ajax: {
            type: 'get',
            url: 'https://gaia.inegi.org.mx/wscatgeo/mgem/07' + initMunicipio,
            dataType: 'json',
            processResults: function (data) {
                var data = $.map(data.datos, function (obj) {
                    return {id: obj.cve_agem, text: obj.nom_agem};
                })
                data.sort(function (a, b) {
                    if (a.text > b.text) {
                        return 1;
                    }
                    if (a.text < b.text) {
                        return -1;
                    }
                    return 0;
                })
                return {
                    results:data
                }
            }
        },
    }
    var optionsChild =  {
        placeholder: 'Seleccionar un elemento',
        search: false,
        width: '100%',
        minimumResultsForSearch: Infinity,
    }
    var placeNacimiento = $('#lugarDeNacimiento');
    var currentNacimiento = $('#currentLugarNacimiento');
    placeNacimiento.select2(options);
    if (currentNacimiento.val()) {
        $.ajax({
            type: 'GET',
            url: 'https://gaia.inegi.org.mx/wscatgeo/mgem/07/' + currentNacimiento.val()
        }).then(function (data) {
            var datos = data.datos;
            var option = new Option(datos[0].nom_agem, datos[0].cve_agem, true, true);
            placeNacimiento.append(option).trigger('change');
            placeNacimiento.trigger({
                type: 'select2:select',
                params: {
                    data: data.datos
                }
            });
        })
    }

    $('#colonia').select2( { width: '100%', search: false,  minimumResultsForSearch: Infinity });
    Select2Cascade($('#municipio'), $('#colonia'), 'https://gaia.inegi.org.mx/wscatgeo',optionsChild, options)
});
$(function () {
    $('.nav-pills > li a[title]').tooltip()
    var AJAX_PATH = WEB_ROOT+"/ajax/poll.php";
    $("ul.steps a").on("click",function () {
        var id = $(this).data("id");
        var victimaId  = $('#id').length ? $("#id").val() : "";
        var name = $(this).data("name");
        $.ajax({
            type: "POST",
            url: AJAX_PATH,
            data: "type=getQuestions&id="+id+"&victimaId="+victimaId,
            beforeSend: function(){
            },
            success: function(response) {
                $("#"+name).html(response);
                $('a.control-audio[title]').tooltip()
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
              dataType: 'json',
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
