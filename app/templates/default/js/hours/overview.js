/**
 * Created by Rohkin on 3/24/2016.
 */
(function () {

    var set_hours = function (result) {
        console.log(result);
    };

    $(document).ready(function () {
        $.post("/hours/gethours", {
            "startdate": $("input[name=startdate]").val(),
            "enddate": $("input[name=enddate]").val()
        }, set_hours);
    });
})();