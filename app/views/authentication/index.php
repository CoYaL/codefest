
<div class="page-header">
	<h1><?php echo $data['title']; ?></h1>
</div>

<?php echo \Core\Error::display($error)?>
<form id="login" class="col-md-4" action="<?php echo DIR;?>authentication/login" method="POST">
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Username" required/>
	</div>
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required/>
	</div>

	<button type="submit" name="submit" value="submit" class="btn btn-primary">Log in</button>
</form>

