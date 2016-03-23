
<div class="page-header">
	<h1><?php echo $data['title'] ?></h1>
</div>

<form id="login" class="col-md-4" action="authentication/login" method="POST">
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>
			<input type="text" class="form-control" id="username" placeholder="Username" />
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
			<input type="password" class="form-control" id="password" placeholder="Password" />
	</div>

	<button type="submit" class="btn btn-primary">Log in</button>
</form>

