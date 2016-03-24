<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 14:29
 */
?>
<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-clock-o"></i>&nbsp;<?php print_r($_SESSION['smvc_fullName']); ?>
	</div>
	<div class="panel-body">
		<div class="col-md-4">
			<form action="" class="form-horizontal">
				<div class="form-group">
					<label for="" class="col-md-2 control-label">van</label>
					<div class="col-md-10">
						<input type="text" class="form-control datepicker" name="startdate" value="01-01-2000">
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-2 control-label">tot</label>
					<div class="col-md-10">
						<input type="text" class="form-control datepicker" name="enddate" value="31-12-2020">
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<form action="" class="form-horizontal">
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Gewerkt</label>
					<div class="col-md-9">
						<input type="text" class="form-control" name="worked" disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Overuren</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="overtime" disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Vakantie</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="holidays" disabled>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-md-3 control-label">Ziek</label>
					<div class="col-md-9">
						<input type="text" class="form-control datepicker" name="sick" disabled>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<div id="canvas_holder">
				<canvas id="canvas" height="175" style="width:100%; margin:auto;">
					Nerd je browser ondersteund geen canvas.
				</canvas>
			</div>
		</div>
	</div>
</div>