<?php require_once 'actions/create_degree.php'; ?>

<div class="row">
	<div class="col-lg-8 m-auto">
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
		  <li class="breadcrumb-item"><a href="index.php?menu=degree_list">Degree List</a></li>
		  <li class="breadcrumb-item active">New Degree</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>New Degree</h3>
				</div>
				<form action="index.php?new=degree" method="POST">
					<div class="form-group">
						<label for="degree_name">Degree Name</label>
						<input class="form-control" type="text" pattern="[a-zA-Z]+" title="Degree name" id="degree_name" name="degree_name" value="<?php if(isset($_POST['degree_name'])) echo $_POST['degree_name'] ?>" required>
					</div>
					<div class="form-group">
						<label for="degree_desc">Degree Description</label>
						<input class="form-control" type="text" pattern="[a-zA-Z\s]+" title="Degree description" id="degree_desc" name="degree_desc" value="<?php if(isset($_POST['degree_name'])) echo $_POST['degree_desc'] ?>" required>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="create_degree">Create</button>
						<a class="btn btn-danger" href="index.php?menu=degree_list">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
