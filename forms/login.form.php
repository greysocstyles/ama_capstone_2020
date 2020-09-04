<?php require_once 'actions/login.php'; ?>

<form action="index.php" method="POST">
	<div class="row">
		<div class="col-md-4 m-auto">
			<div class="card mt-5">
				<div class="card-header bg-info">
					<h5 class="text-light"><img src="img/ama-logo.jpg" width="27" height="26" alt="" class="d-inline-block align-top"/> AMA Advising & Scheduling</h5>
				</div>
				<div class="card-body mt-1">
					<div class="form-group">
						<input class="form-control" type="text" name="username" id="username" placeholder="Username">
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" id="password" placeholder="Password">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="login">Log in</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>