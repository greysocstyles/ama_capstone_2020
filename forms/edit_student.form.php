<?php require_once 'actions/edit_student.php'; ?>

<div class="row">
	<div class="col-md-8 m-auto">
		<!-- alert msg -->
		<?php

		if (isset($msg) && isset($alert_class)) : ?>

			<div class="alert alert-dismissible <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>

		<?php endif; ?>
		<!-- end of alert msg -->
		<ol class="breadcrumb">
		  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
		  <li class="breadcrumb-item active">Edit Student</li>
		</ol>
		<!-- card-div -->
		<div class="card">
			<div class="card-body">
				<h3>Edit Student</h3>
				<?php

				if (isset($_GET['edit_id'])):
					$edit_id = $_GET['edit_id'];
					$student_list = query("SELECT   sl.id
												, 	sl.usn
												, 	sl.name
												, 	sl.curriculum_id
												, 	dl.degree_name
										from student_list sl
										inner join curriculum_list cl
												on sl.curriculum_id = cl.id
										inner join degree_list dl
												on cl.degree_id = dl.id
										where sl.id = '$edit_id' ");

					if ($student_list) :
						while ($row = mysqli_fetch_assoc($student_list)) : ?>
						<form action="index.php?edit=student&edit_id=<?php echo $row['id'] ?>" method="POST">
							<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>"/>
							<div class="form-group">
								<label>USN</label>
								<input class="form-control" type="text" pattern="\d*" minlength="11" maxlength="12" name="usn" value="<?php echo $row['usn']?>" required>
							</div>
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" pattern="[a-zA-Z\s]+$" name="name" value="<?php echo $row['name'] ?>" required>
							</div>
							<div class="form-group">
								<label>Curriculum</label>
								<select class="form-control" name="curriculum">
									<?php

									$curriculum_list = query("select cl.id, cl.curriculum_year, dl.degree_name from curriculum_list cl inner join degree_list dl on cl.degree_id = dl.id");

									if ($curriculum_list) :
										while ($curri = mysqli_fetch_assoc($curriculum_list)) : ?>

											<option value="<?php echo $curri['id']; ?>" <?php if($row['curriculum_id'] == $curri['id']) echo 'selected' ?>>		<?php echo $curri['curriculum_year'] . ' ' . $curri['degree_name'] ?>
											</option>

											<?php
										endwhile;
									endif;
									?>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" name="edit_student">Update</button>
								<a class="btn btn-danger" href="index.php?menu=student_list">Cancel</a>
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


