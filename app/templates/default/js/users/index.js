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
            template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(user.firstname, user.middlename || "", user.lastname));
            template = template.replace(/\{\{EMAIL\}\}/g, user.email || "");
            template = template.replace(/\{\{BIRTHDATE\}\}/g, user.date_of_birth || "");
            template = template.replace(/\{\{ROLE\}\}/g, user.role || "")
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

            $.each($("#add_edit_modal select"), function () {
                var name = $(this).attr("name");
                console.log(data[name]);
                $(this).find("option[value={0}]".format(data[name])).attr("selected", true);
            });

            $("#add_edit_modal").modal("show");
        });
    };

    var insert_user = function (user, type) {
        var html = $("script#template-user-record").html();

        var role = $("select[name=role]").find("option[value={0}]".format(user.role)).html();

        var template = html.replace(/\{\{ID\}\}/g, user.user_id || 0);
        template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(user.firstname, user.middlename, user.lastname));
        template = template.replace(/\{\{EMAIL\}\}/g, user.email || "");
        template = template.replace(/\{\{BIRTHDATE\}\}/g, user.date_of_birth || "");
        template = template.replace(/\{\{ROLE\}\}/g, role || "");

        var tr = null;
        if (type === 'add') {
            $("table tbody").append(template);
            tr = $("table tbody tr:last");
        } else {
            tr = $("tbody button[data-id={0}]".format(user.user_id)).closest("tr");
            tr.replaceWith(template);
        }
        tr.find("button[data-record]").data(user);

        $("button[data-record]").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.data("type", "edit");

            var data = $(this).data();

            $.each($("#add_edit_modal input"), function () {
                var name = $(this).attr("name");
                $(this).val(data[name]);
            });

            $.each($("#add_edit_modal select"), function () {
                var name = $(this).attr("name");
                $(this).find("option[value={0}]".format(data[name])).attr("selected", true);
            });

            $("#add_edit_modal").modal("show");
        });
    }

    $(document).ready(function () {
        $.post("users/getusers", {}, load_data);
        $.post("users/getroles", {}, function (result) {
            roles = JSON.parse(result) || [];
            $.each(roles, function (index, role) {
                $("#add_edit_modal select[name=role]").append("<option value=\"{0}\">{1}</option>".format(role.role_id, role.role));
            });
        });

        $("tbody").on("click", ".delete_user", function () {
            var button = $(this);
            $.post("users/delete", {"user_id": $(this).data("id")}, function (data) {
                button.closest("tr").remove();
            });
        });

        $("#add_user").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.removeClass("btn-primary").addClass("btn-success").html("Add User").data("type", "add");
            $("#add_edit_modal .modal-title").html("Add User");
            $("#add_edit_modal").modal("show");
        });

        $("#add_edit_modal").on("hidden.bs.modal", function () {
            $(this).find(".modal-title").html("Edit User");
            $(this).find("button[data-type]").removeClass("btn-success").addClass("btn-primary").html("Edit User");
            $(this).find("select, input").each(function () {
                $(this).val("");
                $(this).find("option").attr("selected", false);
            })
        });

        $("#add_edit_modal button[data-type]").on("click", function () {
            var type = $(this).data("type");
            $.post("users/{0}".format(type), $("#add_edit_modal form").serialize(), function (response) {
                $("#add_edit_modal").modal("hide");
                var data = JSON.parse(response);

                insert_user(data, type);
            });
        });


    });
})();
