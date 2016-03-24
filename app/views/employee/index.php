<?php
/**
 * Created by PhpStorm.
 * User: Rohkin
 * Date: 3/23/2016
 * Time: 16:54
 */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-users"></i>&nbsp;Medewerker Overzicht
        <a class="btn btn-primary btn-sm pull-right" id="add_employee">
            <i class="fa fa-plus"></i>
        </a>
        <div style="clear:both"></div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Factor</th>
                <th>Department</th>
                <th>Staat</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="add_edit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Medewerker</h4>
            </div>
            <div class="modal-body">
                <form >
                    <input type="hidden" name="employee_id">
                    <div class="form-group">
                        <label for="username">Gebruiker</label>
                        <select class="form-control" name="user_id" required></select>
                    </div>
                    <div class="form-group">
                        <label for="factor">Factor</label>
                        <input type="email" class="form-control" name="factor" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select type="text" class="form-control " name="department" required></select>
                    </div>
                    <div class="form-group">
                        <label for="state">Staat</label>
                        <select type="text" class="form-control" name="state" required></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-type>Edit Medewerker</button>
            </div>
        </div>
    </div>
</div>

<script type="template/text" id="template-employee-record">
    <tr>
        <td>{{NAME}}</td>
        <td>{{FACTOR}}</td>
        <td>{{DEPARTMENT}}</td>
        <td>{{STATE}}</td>
        <td>
            <button class="btn btn-warning btn-sm center-block" data-id="{{ID}}" data-record>
                <i class="fa fa-list"></i>
            </button>
        </td>
        <td>
            <button class="btn btn-danger btn-sm center-block delete_employee" data-id="{{ID}}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>


