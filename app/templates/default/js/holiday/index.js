/**
 * Created by Conner on 24/03/2016.
 */
(function () {
    var load_data = function (holidays) {
        $("tbody").empty();
        holidays = JSON.parse(holidays) || [];



        var html = $("script#template-holiday-record").html();
        $.each(holidays, function (index, holiday) {
            var template = html.replace(/\{\{ID\}\}/g, holiday.holiday_id || 0);
            template = template.replace(/\{\{DESCRIPTION\}\}/g, holiday.description || "");
            template = template.replace(/\{\{STARTDATE\}\}/g, holiday.start_date || "");
            template = template.replace(/\{\{ENDDATE\}\}/g, holiday.end_date || "");
            template = template.replace(/\{\{PAYMENT_MULTIPLIER\}\}/g, holiday.payment_multiplier || "");
            $("table tbody").append(template);
            var tr = $("table tbody tr:last");

            tr.find("button[data-record]").data(holiday);
        });

        $("button[data-record]").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.data("type", "edit");

            var data = $(this).data();
            $.each($("#add_edit_modal input, #add_edit_modal select"), function () {
                var name = $(this).attr("name");
                $(this).val(data[name]);
            });

            $("#add_edit_modal").modal("show");
        });
    };

    var insert_holiday = function (holiday, type) {
        var html = $("script#template-holiday-record").html();

        var role = $("select[name=role]").find("option[value={0}]".format(holiday.role)).html();

        var template = html.replace(/\{\{ID\}\}/g, holiday.holiday_id || 0);
        template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(holiday.firstname, holiday.middlename || "", holiday.lastname));
        template = template.replace(/\{\{FACTOR\}\}/g, holiday.factor || "");
        template = template.replace(/\{\{DEPARTMENT\}\}/g, holiday.department || "");
        template = template.replace(/\{\{STATE\}\}/g, holiday.state || "");

        var tr = null;
        if (type === 'add') {
            $("table tbody").append(template);
            tr = $("table tbody tr:last");
        } else {
            tr = $("tbody button[data-id={0}]".format(holiday.holiday_id)).closest("tr");
            tr.replaceWith(template);
        }
        tr.find("button[data-record]").data(holiday);

        $("button[data-record]").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.data("type", "edit");

            var data = $(this).data();

            $.each($("#add_edit_modal input, #add_edit_modal select"), function () {
                var name = $(this).attr("name");
                $(this).val(data[name]);
            });

            $("#add_edit_modal").modal("show");
        });
    };

    $(document).ready(function () {
        $.post("holidays/getholidays", {}, load_data);

        $("tbody").on("click", ".delete_holiday", function () {
            var button = $(this);
            $.post("holidays/delete", {"holiday_id": $(this).data("id")}, function (data) {
                button.closest("tr").remove();
            });
        });

        $("#add_holiday").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.removeClass("btn-primary").addClass("btn-success").html("Add holiday").data("type", "add");
            $("#add_edit_modal .modal-title").html("Add holiday");
            $("#add_edit_modal").modal("show");
        });

        $("#add_edit_modal").on("hide.bs.modal", function () {
            $(this).find(".modal-title").html("Edit holiday");
            $(this).find("button[data-type]").removeClass("btn-success").addClass("btn-primary").html("Edit holiday");
            $(this).find("select, input").each(function () {
                $(this).val("");
            });
        });

        $("#add_edit_modal button[data-type]").on("click", function () {
            var type = $(this).data("type");
            $.post("holidays/{0}".format(type), $("#add_edit_modal form").serialize(), function (response) {
                $("#add_edit_modal").modal("hide");
                var data = JSON.parse(response);

                insert_holiday(data, type);
            });
        });


    });
})();
