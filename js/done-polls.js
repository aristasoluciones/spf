$(function(){
    $(".btn-chart").on(
        "click",
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
            }
        },
        error:function(){
            alert(msgError);
        }
    });
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
