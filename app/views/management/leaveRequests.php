<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>


<div class="panel panel-default">

	<div class="panel-heading">
		<i class="fa fa-table"></i> <?php echo $data['title'] ?>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
			<tr>
				<th>Naam</th>
				<th>Afdeling</th>
				<th>Reden</th>
				<th>Van datum</th>
				<th>Tot datum</th>
				<th>Beschrijving</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($data['requests'] as $request) {
				printf('<tr>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td class="btn-group"><button class="btn btn-success">Accepteren</button><button class="btn btn-danger">Afwijzen</button></td>
			</tr>',$request['name'],$request['department'],$request['reason'],$request['startDate'],$request['endDate'],$request['description']);
			}?>
			</tbody>
		</table>
	</div>

</div>