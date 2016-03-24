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
				',$request->firstname.' '.$request->middlename.' '.$request->lastname,
					$request->department,$request->reason,$request->start_date,$request->end_date);
				switch($request->state){
					case 'geaccepteerd':
						echo '<td class="success">Geaccepteerd</td>';
						break;
					case 'afgewezen':
						echo '<td class="danger">Afgewezen</td>';
						break;
					default:
						echo '	<td>
									<button class="btn btn-success status" data-type="geaccepteerd" id="'.$request->leave_id.'">
										<i class="fa fa-check"></i>
									</button>
									<button class="btn btn-danger status" data-type="afgewezen" id="'.$request->leave_id.'">
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