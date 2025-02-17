$(function () {

    if($('#municipio_id').length) {
        var url_base = !isOffline ? 'https://gaia.inegi.org.mx/wscatgeo'
            : WEB_ROOT + '/ajax/wscatgeo.php';
        var url1 = !isOffline ? url_base + '/mgem/07' : url_base + '?wscatgeo=mgem&mgem=07&agem=';
        var initMunicipio = $('#municipioLimited').length ? $('#municipioLimited').val() : '';
        var options = {
            placeholder: 'Seleccionar un elemento',
            allowClear: true,
            search: true,
            width: '100%',
            minimumInputLength: 1,
            minimumResultsForSearch: Infinity,
            ajax: {
                type: 'get',
                url: url1 + initMunicipio,
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
        $('#municipio_id').select2(options);
    }
    drawChartGeneral();
    if($("#btnSearch").length)
        $("#btnSearch").on("click",drawChartGeneral);
});
function drawChartGeneral() {
    am4core.ready(function() {
    var response = [];
        $.ajax({
            type: "POST",
            url: WEB_ROOT+"/ajax/poll.php",
            data: $("#frmFiltroChartGeneral").serialize(true),
            beforeSend: function(){

            },
            dataType:'json',
            success: function(response) {
                am4core.useTheme(am4themes_animated);
                var titlex = "";
                var titleY = "";
                var min = -1;
                var max = -1;
                var convertPercent = false;
                switch($("#detail").val()){
                    case "month":
                        titlex = "Meses";
                        titley = "Numero de incidencias";
                    break;
                    case "violencia":
                        titlex = "Tipo de violencia";
                        titley = "Porcentaje promedio";
                        min = 0;
                        max = 100;
                        convertPercent = true;
                    break;
                    default:
                        titlex = "Tipo de contexto";
                        titley = "Numero de incidencias";
                    break;
                }

// Create chart instance
                var chart = am4core.create("chart-general", am4charts.XYChart);
                chart.data = response;
                chart.numberFormatter.numberFormat = "#.##";
                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "clave";
                categoryAxis.title.text = titlex;
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.labels.template.rotation = 270;
                categoryAxis.renderer.labels.template.horizontalCenter = "middle";
                categoryAxis.renderer.minGridDistance = 5;

                categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
                    if (target.dataItem && target.dataItem.index & 2 == 2) {
                        return dy + 1;
                    }
                    return dy;
                });


                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                if (convertPercent) {
                    valueAxis.renderer.labels.template.adapter.add("text", (text, label) => {
                        return label.dataItem.value + "%";
                    })
                    valueAxis.title.text = titleY;
                    valueAxis.strictMinMax = true;
                }
                if(min !== -1)
                 valueAxis.min = min;
                if(max !== -1)
                    valueAxis.max = max;

                var label = categoryAxis.renderer.labels.template;
                label.wrap = true;
                label.maxWidth = 120;
// Create series
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = "value";
                series.dataFields.categoryX = "clave";
                series.name = "Porcentaje";
                series.columns.template.showTooltipOn = "always";
                series.columns.template.tooltipY = 0;
                if (convertPercent) {
                   series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}%[/]";
                }
                else
                    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";

                series.columns.template.fillOpacity = .8;
                series.columns.template.width = am4core.percent(10);

                var columnTemplate = series.columns.template;
                columnTemplate.strokeWidth = 1;
                columnTemplate.strokeOpacity = 2;


            },
            error:function(){
            }
        });

    });
}
