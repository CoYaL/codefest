/**
 * Created by Rohkin on 3/24/2016.
 */
(function () {

    var set_hours = function (result) {
        var data = JSON.parse(result);
        console.log(result);
        $("input[name=worked]").val(data.work[0].worked);
        $("input[name=overtime]").val(data.work[0].overtime);
        $("input[name=holidays]").val(data.holiday[0].holiday);
        $("input[name=sick]").val(data.sick[0].sick);


    };

    $(document).ready(function () {
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