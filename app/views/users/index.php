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
        Gebruikers Overzicht
        <a class="btn btn-primary btn-sm pull-right">
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
                <th>Factor</th>
                <th>Department</th>
                <th>State</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Jamey van Heel</td>
                <td>j.heel@gmail.com</td>
                <td>15-06-1990</td>
                <td>Super Admin</td>
                <td>1.00</td>
                <td>Administration</td>
                <td>Active</td>
                <td>
                    <a class="btn btn-warning btn-sm">
                        <i class="fa fa-list"></i>
                    </a>
                </td>
                <td>
                    <a class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
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
