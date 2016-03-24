/**
 * Created by Rohkin on 3/24/2016.
 */
(function () {
    var chart;
    var ctx;
    var set_hours = function (result, chart) {
        var data = JSON.parse(result);
        $("input[name=worked]").val(data.work[0].worked);
        $("input[name=overtime]").val(data.work[0].overtime);
        $("input[name=holidays]").val(data.holiday[0].holiday);
        $("input[name=sick]").val(data.sick[0].sick);

        var chart_data = [
            {
                value: data.work[0].worked,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Gewerkt"
            },
            {
                value: data.work[0].overtime,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Overuren"
            },
            {
                value: data.holiday[0].holiday,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Vakantie"
            },
            {
                value: data.sick[0].sick,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Ziek"
            }
        ]

        var canvas = $("#canvas").clone();
        $("#canvas").remove();
        
        $("#canvas_holder").append(canvas);
        
        ctx = $("#canvas").get(0).getContext("2d");
        chart = new Chart(ctx).Doughnut(chart_data);
    };

    $(document).ready(function () {
        ctx = $("#canvas").get(0).getContext("2d");
        chart = new Chart(ctx).Doughnut([],[]);

        $.post("/hours/gethours", {
            "startdate": $("input[name=startdate]").val(),
            "enddate": $("input[name=enddate]").val()
        }, set_hours);

        $(".datepicker").change(function () {
            $.post("/hours/gethours", {
                "startdate": $("input[name=startdate]").val(),
                "enddate": $("input[name=enddate]").val()
            }, set_hours);
        });
    });
})();