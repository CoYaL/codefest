/**
 * Created by Rohkin on 3/23/2016.
 */
(function() {
    var load_data = function (users) {
        $("tbody").empty();
        users = JSON.parse(users) || [];
        var html = $("script#template-user-record").html();
        $.each(users, function (index, user) {
            var template = html.replace(/\{\{ID\}\}/g, user.user_id || 0);
            template = template.replace(/\{\{NAME\}\}/g, user.name || "");
            template = template.replace(/\{\{EMAIL\}\}/g, user.email || "");
            template = template.replace(/\{\{BIRTHDATE\}\}/g, user.birthdate || "");
            template = template.replace(/\{\{ROLE\}\}/g, user.role || "");
            template = template.replace(/\{\{FACTOR\}\}/g, user.factor || "");
            template = template.replace(/\{\{DEPARTMENT\}\}/g, user.department || "");
            template = template.replace(/\{\{STATE\}\}/g, user.state || "");
            $("table tbody").append(template);
            var tr = $("table tbody tr:last");
            
            tr.find("button[data-record]").data(user);
        });
        $("button[data-record]").click(function () {
            $("#add_edit_modal button[data-type]").data("type", "edit");
            var data = $(this).data();

            $.each($("#add_edit_modal input"), function () {
                var name = $(this).attr("name");
                $(this).val(data[name]);
            });

            $("#add_edit_modal").modal("show");
        });
    };

    $(document).ready(function () {
       $.post("users/getusers",{},load_data);
    });
})();
