<?php
/**
 * Created by PhpStorm.
 * User: Rohkin
 * Date: 3/23/2016
 * Time: 16:15
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $data['title'] ?>
    </div>
    <div class="panel-body">
        <form class="col-md-6" method="POST">
            <label class="radio-inline">
                <input type="radio" name="leave_type" id="leave_type" value="sick" required> Ziek
            </label>
            <label class="radio-inline">
                <input type="radio" name="leave_type" id="leave_type" value="holiday" required> Vakantie
            </label>
            <div class="form-group">
                <label for="start_date">Van</label>
                <input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php echo $data['date_today'] ?>">
            </div>
            <div class="form-group">
                <label for="end_date">Tot</label>
                <input type="text" class="form-control datepicker" name="end_date" id="end_date">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

