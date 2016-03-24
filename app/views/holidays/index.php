<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 05:22
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $data['title'] ?>
</div>
<div class="panel-body">
    <form class="col-md-6" method="POST">
        <label for="holiday_description">Naam feestdag:</label>
            <input type="text" class="form-control" name="description" id="holiday_description" required>
        <div class="form-group">
            <label for="start_date">Van</label>
            <input type="text" class="form-control datepicker" name="start_date" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">Tot</label>
            <input type="text" class="form-control datepicker" name="end_date" id="end_date">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</div>
