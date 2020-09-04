<?php require_once 'actions/edit_curriculum.php'; ?>

<div class="row">
	<div class="col-lg-8 m-auto">
		<!-- alert msg -->
		<?php

		if(isset($msg) && isset($alert_class)) : ?>

			<div class="alert alert-dismissible <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>

		<?php endif; ?>
		<!-- end of alert msg -->

		<ol class="breadcrumb">
		  <li class="breadcrumb-item active"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
		  <li class="breadcrumb-item active">Edit Curriculum</li>
		</ol>

		<!-- card-div -->
		<div class="card">
			<div class="card-body">
				<?php

				if (isset($_GET['edit_id'])) :
					$edit_id = $_GET['edit_id'];
					$select_curriculum = query("select  cl.id
													, 	cl.degree_id
													, 	cl.curriculum_year
												from curriculum_list cl
												inner join degree_list dl
														on cl.degree_id = dl.id
													where cl.id = '$edit_id'");

					if ($select_curriculum) :
						while ($row = mysqli_fetch_assoc($select_curriculum)) : ?>
						<form action="index.php?edit=curriculum&edit_id=<?php echo $row['id'] ?>" method="POST">
							<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
							<div class="form-group">
								<label>Degree</label>
								<select class="form-control" name="degree_name">
									<?php

									$degree_list = query("select * from degree_list");

									while($degree = mysqli_fetch_assoc($degree_list)) : ?>

											<option value="<?php echo $degree['id'] ?>" <?php if($degree['id'] == $row['degree_id']) { echo 'selected'; } ?>>	<?php echo $degree['degree_name'] ?>
											</option>

									<?php endwhile; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Curriculum Year</label>
								<input class="form-control" type="text" pattern="[0-9]+[-][0-9]+" minlength="9" maxlength="9" name="curriculum_year" value="<?php echo $row['curriculum_year']?>">
							</div>
							<div class="form-group">
								<button type="submit" name="edit_curriculum" class="btn btn-info">Update</button>
								<a class="btn btn-danger" href="index.php?menu=curriculum_list">Cancel</a>
							</div>
						</form>
						<?php
						endwhile;
					endif;
				endif;
				?>
			</div>
		</div>
		<!-- end of card-div -->
	</div>
</div>