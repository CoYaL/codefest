<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 05:22
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-calendar"></i>&nbsp;Feestdagen Overzicht
        <a class="btn btn-primary btn-sm pull-right" id="add_holiday">
            <i class="fa fa-plus"></i>
        </a>
        <div style="clear:both"></div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Naam</th>
            <th>Start Datum</th>
            <th>Eind Datum</th>
            <th>Loonfactor</th>
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
                <h4 class="modal-title">Wijzig Feestdag</h4>
            </div>
            <div class="modal-body">
                <form >
                    <input type="hidden" name="holiday_id">
                    <div class="form-group">
                        <label for="description">Naam</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Start Datum</label>
                        <input type="text" class="form-control datepicker" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Eind Datum</label>
                        <input type="text" class="form-control datepicker" name="end_date">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Loonfactor</label>
                        <input type="text" class="form-control" value="1.00" name="payment_multiplier">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                <button type="button" class="btn btn-primary" data-type>Wijzig Feestdag</button>
            </div>
        </div>
    </div>
</div>

<script type="template/text" id="template-holiday-record">
    <tr>
        <td>{{DESCRIPTION}}</td>
        <td>{{STARTDATE}}</td>
        <td>{{ENDDATE}}</td>
        <td>{{PAYMENT_MULTIPLIER}}</td>
        <td>
            <button class="btn btn-warning btn-sm center-block" data-id="{{ID}}" data-record>
                <i class="fa fa-list"></i>
            </button>
        </td>
        <td>
            <button class="btn btn-danger btn-sm center-block delete_holiday" data-id="{{ID}}">
                <i class="fa fa-trash"></i>
            </button>
        </td>
    </tr>
</script>
