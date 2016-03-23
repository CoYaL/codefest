/**
 * Created by Rohkin on 3/23/2016.
 */
(function () {
    var load_data = function (users) {
        $("tbody").empty();
        users = JSON.parse(users) || [];
        var html = $("script#template-user-record").html();
        $.each(users, function (index, user) {
            var template = html.replace(/\{\{ID\}\}/g, user.user_id || 0);
            template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(user.firstname, user.middlename, user.lastname));
            template = template.replace(/\{\{EMAIL\}\}/g, user.email || "");
            template = template.replace(/\{\{BIRTHDATE\}\}/g, user.date_of_birth || "");
            template = template.replace(/\{\{ROLE\}\}/g, user.role || "");
            template = template.replace(/\{\{FACTOR\}\}/g, user.factor || "");
            template = template.replace(/\{\{DEPARTMENT\}\}/g, user.department || "");
            template = template.replace(/\{\{STATE\}\}/g, user.state || "");
            $("table tbody").append(template);
            var tr = $("table tbody tr:last");

            tr.find("button[data-record]").data(user);
        });
        $("button[data-record]").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.data("type", "edit");

            var data = $(this).data();

            $.each($("#add_edit_modal input"), function () {
                var name = $(this).attr("name");
                $(this).val(data[name]);
            });

            $("#add_edit_modal").modal("show");
        });
    };

    $(document).ready(function () {
        $.post("users/getusers", {}, load_data);

        $("#add_user").click(function() {
            var button = $("#add_edit_modal button[data-type]");
            button.removeClass("btn-primary").addClass("btn-success").html("Add User");
            $("#add_edit_modal").modal("show");
        });

        $("#add_edit_modal").on("hidden.bs.modal", function () {
            $(this).find("button[data-type]").removeClass("btn-success").addClass("btn-primary").html("Edit User");
            $(this).find("select, input").each(function () {
                $(this).val("");
                $(this).find("option").attr("selected", false);
            })
        });
    });
})();
