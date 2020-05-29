<?php require_once 'actions/create_curriculum.php'; ?>

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
		  <li class="breadcrumb-item active"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
		  <li class="breadcrumb-item active">New Curriculum</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>New Curriculum</h3>
				</div>
				<form action="index.php?new=curriculum" method="POST">
					<div class="form-group">
						<label>Degree</label>
						<select class="form-control" name="degree_name" required>
							<?php

							$select_degree = query("SELECT id, degree_name from degree_list");

							if($select_degree):
								while($row = mysqli_fetch_assoc($select_degree)):
									?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['degree_name']; ?></option>
									<?php
								endwhile;
							endif;
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Curriculum Year</label>
						<input class="form-control" type="text" pattern="[0-9]+[-][0-9]+" minlength="9" maxlength="9" name="curriculum_year" placeholder="ex. 2019-2020" value="<?php if(isset($_POST['curriculum_year'])) echo $_POST['curriculum_year'] ?>" required>
					</div>
					<div class="form-group">
					    <?php
					    if(isset($curriculum_exist)):
					        echo 'Curriculum exist: ';
					        foreach ($curriculum_exist as $value): ?>
					                <strong class="text-danger"><?php echo implode(", ", $value)?></strong>
					                <?php
					        endforeach;
					    endif;
					    ?>
					</div>
					<div class="form-group">
						<button type="submit" name="create_curriculum" class="btn btn-info">Create</button>
						<a class="btn btn-danger" href="index.php?menu=curriculum_list">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
