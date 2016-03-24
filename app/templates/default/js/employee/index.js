/**
 * Created by Rohkin on 3/23/2016.
 */
(function () {
    var load_data = function (employees) {
        $("tbody").empty();
        employees = JSON.parse(employees) || [];
        var html = $("script#template-employee-record").html();
        $.each(employees, function (index, employee) {
            var template = html.replace(/\{\{ID\}\}/g, employee.employee_id || 0);
            template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(employee.firstname, employee.middlename || "", employee.lastname));
            template = template.replace(/\{\{FACTOR\}\}/g, employee.factor || "");
            template = template.replace(/\{\{DEPARTMENT\}\}/g, employee.department || "");
            template = template.replace(/\{\{STATE\}\}/g, employee.state || "");
            $("table tbody").append(template);
            var tr = $("table tbody tr:last");

            tr.find("button[data-record]").data(employee);
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

    var insert_employee = function (employee, type) {
        var html = $("script#template-employee-record").html();

        var role = $("select[name=role]").find("option[value={0}]".format(employee.role)).html();

        var template = html.replace(/\{\{ID\}\}/g, employee.employee_id || 0);
        template = template.replace(/\{\{NAME\}\}/g, "{0} {1} {2}".format(employee.firstname, employee.middlename || "", employee.lastname));
        template = template.replace(/\{\{FACTOR\}\}/g, employee.factor || "");
        template = template.replace(/\{\{DEPARTMENT\}\}/g, employee.department || "");
        template = template.replace(/\{\{STATE\}\}/g, employee.state || "");

        var tr = null;
        if (type === 'add') {
            $("table tbody").append(template);
            tr = $("table tbody tr:last");
        } else {
            tr = $("tbody button[data-id={0}]".format(employee.employee_id)).closest("tr");
            tr.replaceWith(template);
        }
        tr.find("button[data-record]").data(employee);

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
    }

    $(document).ready(function () {
        $.post("employees/getemployees", {}, load_data);
        $.post("employees/getusers", {}, function (result) {
            var users = JSON.parse(result) || [];
            $.each(users, function (index, user) {
                $("#add_edit_modal select[name=user_id]").append("<option value=\"{0}\">{1} {2} {3}</option>"
                    .format(user.user_id, user.firstname, user.middlename || "", user.lastname));
            });
        });
        $.post("employees/getstates", {}, function (result) {
            var states = JSON.parse(result) || [];
            $.each(states, function (index, state) {
                $("#add_edit_modal select[name=state]").append("<option value=\"{0}\">{0}</option>".format(state));
            });
        });
        $.post("employees/getdepartments", {}, function (result) {
            var departments = JSON.parse(result) || [];
            $.each(departments, function (index, department) {
                $("#add_edit_modal select[name=department]").append("<option value=\"{0}\">{0}</option>".format(department));
            });
        });


        $("tbody").on("click", ".delete_employee", function () {
            var button = $(this);
            $.post("employees/delete", {"employee_id": $(this).data("id")}, function (data) {
                button.closest("tr").remove();
            });
        });

        $("#add_employee").click(function () {
            var button = $("#add_edit_modal button[data-type]");
            button.removeClass("btn-primary").addClass("btn-success").html("Add employee").data("type", "add");
            $("#add_edit_modal .modal-title").html("Add employee");
            $("#add_edit_modal").modal("show");
        });

        $("#add_edit_modal").on("hide.bs.modal", function () {
            $(this).find(".modal-title").html("Edit employee");
            $(this).find("button[data-type]").removeClass("btn-success").addClass("btn-primary").html("Edit employee");
            $(this).find("select, input").each(function () {
                $(this).val("");
            });
        });

        $("#add_edit_modal button[data-type]").on("click", function () {
            var type = $(this).data("type");
            $.post("employees/{0}".format(type), $("#add_edit_modal form").serialize(), function (response) {
                $("#add_edit_modal").modal("hide");
                var data = JSON.parse(response);

                insert_employee(data, type);
            });
        });


    });
})();
