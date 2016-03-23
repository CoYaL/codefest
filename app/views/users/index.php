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
        <i class="fa fa-users"></i>&nbsp;Gebruikers Overzicht
        <a class="btn btn-primary btn-sm pull-right" id="add_user">
            <i class="fa fa-plus"></i>
        </a>
        <div style="clear:both"></div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Geboortedatum</th>
                <th>Rol</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div class="panel-footer">
        <button class="btn btn-default" disabled>
            <i class="fa fa-arrow-circle-left"></i> Terug
        </button>
        <button class="btn btn-default pull-right" disabled>
            Volgende
            <i class="fa fa-arrow-circle-right"></i>
        </button>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="add_edit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <label for="username">Gebruikersnaam</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Voornaam</label>
                        <input type="text" class="form-control" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Tussenvoegsel</label>
                        <input type="text" class="form-control" name="middlename">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Achternaam</label>
                        <input type="text" class="form-control" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Geboortedatum</label>
                        <input type="text" class="form-control datepicker" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Rol</label>
                        <select type="text" class="form-control" name="role" required></select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-type>Edit User</button>
            </div>
        </div>
    </div>
</div>

<script type="template/text" id="template-user-record">
    <tr>
        <td>{{NAME}}</td>
        <td>{{EMAIL}}</td>
        <td>{{BIRTHDATE}}</td>
        <td>{{ROLE}}</td>
        <td>
            <button class="btn btn-warning btn-sm" data-id="{{ID}}" data-record>
                <i class="fa fa-list"></i>
            </button>
        </td>
        <td>
            <button class="btn btn-danger btn-sm" data-id="{{ID}}" id="delete_user">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>


