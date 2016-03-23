<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>


<div class="panel panel-default">

	<div class="panel-heading">
		<i class="fa fa-table"></i> <?php echo $data['title'] ?>
	</div>
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
						echo '	<td>
									<button class="btn btn-success status" data-type="accepted" id="'.$request['leaveID'].'">
										<i class="fa fa-check"></i>
									</button>
									<button class="btn btn-danger status" data-type="denied" id="'.$request['leaveID'].'">
										<i class="fa fa-times"></i>
									</button>
								</td>
			</tr>';
						break;
				}
			}?>
			</tbody>
		</table>
	<script type="text/javascript">

	</script>
</div>