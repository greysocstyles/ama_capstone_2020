<?php require_once 'actions/create_trimester.php'; ?>

<div class="row">
	<div class="col-md-8 m-auto">
		<?php

		if(isset($msg) && isset($alert_class)): ?>
			<div class="alert alert-dismissible <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>
			<?php
		endif;
		?>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
		  <li class="breadcrumb-item active">New Trimester</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>New Trimester</h3>
				</div>
				<form action="index.php?new=trimester" method="POST">
					<div class="form-group">
						<label for=year>Year</label>
						<input class="form-control" type="number" title="year 1 - 4 only" min="1" max="4" name="year" id=year value="<?php if(isset($_POST['year'])) echo $_POST['year'] ?>" required>
					</div>
					<div class="form-group">
						<label for=trimester>Trimester</label>
						<input class="form-control" type="number" title="trimester 1 - 3 only" min="1" max="3" name="trimester" id=trimester value="<?php if(isset($_POST['trimester'])) echo $_POST['trimester'] ?>" required>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="create_trimester">Create</button>
						<a class="btn btn-danger" href="index.php?menu=trimester_list">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
