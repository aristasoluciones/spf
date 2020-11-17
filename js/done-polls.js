var TableDonePolls = function () {
    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }
    var handleDemo1 = function () {
        var grid = new Datatable();
        grid.init({
            src: $("#datatable_ajax"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error
            },
            onDataLoad: function(grid) {
                // execute some code on ajax data load
            },
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options

                // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/scripts/datatable.js).
                // So when dropdowns used the scrollable div should be removed.
                "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'<'table-group-actions pull-right'>>r>t<'row'<'col-md-8 col-sm-12'i><'col-md-4 col-sm-12'p>>",

                // save datatable state(pagination, sort, etc) in cookie.
                "bStateSave": true,
                "columns": [
                    { "title": "Nombre", "data": "nombre" },
                    { "title": "Apellido paterno","data": "apaterno" },
                    { "title": "Apellido materno", "data": "amaterno" },
                    { "title": "Municipio", "data": "municipio.nom_agem" },
                    { "title": "Comentarios", "data": "comentarioAdicional" },
                    { "title": "", "data": null },
                ],
                "columnDefs": [
                    {
                        "targets": -1,
                        "render": function (data) {
                            var content = '<div class="center">';
                            content = content +  '<a class="btn btn-xs yellow" href="'+WEB_ROOT+'/do-poll/id/' + data.victimaId +'"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
                            if (data.completePoll) {
                                content = content + '<a class="btn btn-xs green btn-chart" href="javascript:;" title="Ver grafica" id="' + data.victimaId + '"><i class="fa fa-bar-chart" aria-hidden="true"></i></a>';
                                content = content + '<a class="btn btn-xs green-dark" href="'+WEB_ROOT+'/poll-result-pdf/id/' + data.victimaId +'" title="Ver reporte" target="_blank"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
                            }
                            content = content + '</div>';
                            return content;
                        }
                    }
                ],
                // save custom filters to the state
                "fnStateSaveParams":    function ( oSettings, sValue ) {
                    $("#datatable_ajax tr.filter .form-control").each(function() {
                        sValue[$(this).attr('name')] = $(this).val();
                    });
                    return sValue;
                },

                // read the custom filters from saved state and populate the filter inputs
                "fnStateLoadParams" : function ( oSettings, oData ) {
                    //Load custom filters
                    $("#datatable_ajax tr.filter .form-control").each(function() {
                        var element = $(this);
                        if (oData[element.attr('name')]) {
                            element.val( oData[element.attr('name')] );
                        }
                    });

                    return true;
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    "url": WEB_ROOT + '/ajax/poll.php', // ajax source
                    "data": {type: 'enumerate'}
                },
                "order": [
                    [1, "asc"]
                ],// set first column as a default sort by asc
                "language": {
                    "url":WEB_ROOT + '/properties/i18n/Spanish.json',
                },
                "pagingType": "bootstrap_number",
            }
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'Please select an action',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                App.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: 'No record selected',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
            }
        });
        $(document).on("click","#btnComentario",function () {
            $.ajax({
                type: "POST",
                url: WEB_ROOT+"/ajax/do-poll.php",
                data: $("#frmComentario").serialize(),
                beforeSend:function(){
                    $("#txtMessage").html("");
                    $("#loader").html(LOADER);
                    $("#btnComentario").hide();
                },
                success: function(response) {
                    var splitResp = response.split("[#]");
                    $("#loader").hide();
                    $("#btnComentario").show();
                    if(splitResp[0] == "ok") {
                        $("#txtMessage").html(splitResp[1]);
                        grid.getDataTable().ajax.reload();
                    }
                },
                error:function(){
                    alert(msgError);
                }
            });
        });

        //grid.setAjaxParam("customActionType", "group_action");
        //grid.getDataTable().ajax.reload();
        //grid.clearAjaxParams();
    }
    return {
        init: function () {
            initPickers();
            handleDemo1();
        },
    };
}();

$(function() {
    TableDonePolls.init();

    $(document).on(
        "click",
        '.btn-chart',
        function () {
            var id = this.id;
            $.ajax({
                type: "POST",
                url: WEB_ROOT+"/ajax/do-poll.php",
                data: "type=showChart&id="+id,
                success: function(response) {
                    var splitResp = response.split("[#]");
                    if(splitResp[0] == "ok") {
                        $("#draggable").modal("show");
                        $("#draggable").html(splitResp[1]);
                        drawChart(splitResp[2]);
                    }
                },
                error:function(){
                    alert(msgError);
                }
            });
        }
    );
});

function drawChart(value) {
    am4core.ready(function() {
// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end
// create chart
        // Create chart
        var chart = am4core.createFromConfig({

            // Set inner radius
            "innerRadius": -20,

            // Create axis
            "xAxes": [{
                "type": "ValueAxis",
                "min": 0,
                "max": 100,
                "strictMinMax": true,

                // Add ranges
                "axisRanges": [{
                    "value": 0,
                    "endValue": 20,
                    "axisFill": {
                        "fillOpacity": 1,
                        "fill": "#ffff00",
                        "zIndex": -1
                    }
                }, {
                    "value": 20,
                    "endValue": 40,
                    "axisFill": {
                        "fillOpacity": 1,
                        "fill": "#ffa500",
                        "zIndex": -1
                    }
                }, {
                    "value": 40,
                    "endValue": 100,
                    "axisFill": {
                        "fillOpacity": 1,
                        "fill": "#ff0000",
                        "zIndex": -1
                    }
                }]
            }],

            // Add hands
            /*"hands": [{
                "type": "ClockHand",
                "value": parseInt(value),
                "fill": "#2D93AD",
                "stroke": "#2D93AD",
                "innerRadius": "50%",
                "radius": "97%",
                "startWidth": 15,
                "pin": {
                    "disabled": true
                }
            }]*/

        }, "modal-chart", am4charts.GaugeChart);
        /*var chart = am4core.create("modal-chart", am4charts.GaugeChart);
        chart.innerRadius = -15;

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = 0;
        axis.max = 100;
        axis.strictMinMax = true;

        var colorSet = new am4core.ColorSet();
        var gradient = new am4core.LinearGradient();
        gradient.stops.push({color:am4core.color("yellow")})
        gradient.stops.push({color:am4core.color("orange")})
        //gradient.stops.push({color:am4core.color("purple")})
        gradient.stops.push({color:am4core.color("red")})

        axis.renderer.line.stroke = gradient;
        axis.renderer.line.strokeWidth = 15;
        axis.renderer.line.strokeOpacity = 1;

        axis.renderer.grid.template.disabled = true;
*/
        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.radius = am4core.percent(90);
        hand.showValue(parseInt(value), 0, am4core.ease.cubicOut);
    });
}
