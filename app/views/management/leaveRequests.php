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
				<th>Status</th>
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
				',$request['name'],$request['department'],$request['reason'],$request['startDate'],$request['endDate'],$request['description']);
				switch($request['status']){
					case 'accepted':
						echo '<td class="success">Accepted</td>';
						break;
					case 'denied':
						echo '<td class="danger">Denied</td>';
						break;
					default:
						echo '<td class="btn-group"><button class="btn btn-success">Accepteren</button><button class="btn btn-danger">Afwijzen</button></td>
			</tr>';
						break;
				}
			}?>
			</tbody>
		</table>
	</div>

</div>