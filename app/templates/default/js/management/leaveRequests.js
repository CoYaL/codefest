/**
 * Created by Connor on 23/03/2016.
 */
(function() {
    var update_status = function (response) {
        var data = JSON.parse(response) || [];
        $("#{0}".format(data.id)).parent().addClass(data.class).html(data.status);
    };

    $(document).ready(function() {
       $("button.status").on("click", function () {
           $.post("/management/updateLeave", {"id": $(this).attr("id"), "state": $(this).data("type")}, update_status);
       });
    });
})();