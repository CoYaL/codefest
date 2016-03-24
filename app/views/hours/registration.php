<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 14:28
 */
?>
<div class="page-header">
	<h1><?php echo $data['title'] ?> </h1>
</div>

<div class="panel panel-default col-md-12 ">
	<div class="panel-body">
		Werknemer: <?php echo $data['employeeName']; ?>
		<form id="registration" class="form-group" action="<?php echo DIR;?>/hours/submit" method="POST">
			<div class="form-group col-md-6">
					<label for="projects">Project</label><select class="form-control" name="projectID" id="projects">
						<?php foreach($data['projects'] as $value){
							printf('<option value="%s">%s</option>',$value["id"],$value["name"]);
						}?>
					</select>
			</div>
			<div class="col-md-6">
				<div class="form-group col-md-8">
					<label for="date">Datum</label><input type="text" id="date" class="datepicker form-control" name="date" placeholder="Pick a date" />
				</div>
				<div class="form-group col-md-8">
					<label for="overtime">Aantal overuren</label><input type="number" id="overtime" name="overtime" class="form-control"/>
				</div>
				<div class="form-group col-md-8">
					<label for="hours-worked">Aantal uren</label><input type="number" id="worktime" name="worktime" class="form-control"/>
				</div>
				<div class="form-group col-md-8">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>