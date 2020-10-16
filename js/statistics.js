$(function () {
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
                switch($("#detail").val()){
                    case "month": titlex = "Meses"; break;
                    default: titlex = "Tipo de contexto"; break;
                }

// Create chart instance
                var chart = am4core.create("chart-general", am4charts.XYChart);
                chart.data = response;
                var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                categoryAxis.dataFields.category = "clave";
                categoryAxis.title.text = titlex;
                categoryAxis.renderer.grid.template.location = 0;
                categoryAxis.renderer.labels.template.rotation = 0;
                categoryAxis.renderer.labels.template.horizontalCenter = "middle";
                categoryAxis.renderer.minGridDistance = 20;

                categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
                    if (target.dataItem && target.dataItem.index & 2 == 2) {
                        return dy + 1;
                    }
                    return dy;
                });

                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Total";

// Create series
                var series = chart.series.push(new am4charts.ColumnSeries());
                series.dataFields.valueY = "value";
                series.dataFields.categoryX = "clave";
                series.name = "Porcentaje";
                series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                series.columns.template.fillOpacity = .8;
                series.columns.template.width = am4core.percent(10);

                var columnTemplate = series.columns.template;
                columnTemplate.strokeWidth = 1;
                columnTemplate.strokeOpacity = 1;


            },
            error:function(){
            }
        });

    });
}