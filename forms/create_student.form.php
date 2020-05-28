<?php require_once 'actions/create_student.php'; ?>

<?php

$select_cl = query("select  cl.id
						, 	cl.curriculum_year
						, 	dl.degree_name
					from curriculum_list cl
					inner join degree_list dl
					on cl.degree_id = dl.id");


if ($select_cl) {
	$curriculum_list = array();
	while ($row = mysqli_fetch_assoc($select_cl)) {
			$curriculum_list[] = $row;
	}
}

?>
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
  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
  <li class="breadcrumb-item active">New Student</li>
</ol>
<div class="card">
	<div class="card-body">
		<form action="index.php?new=student" method="POST">
			<div class="form-row">
				<div class="form-group col-md-8">
					<h3>Create Student</h3>
				</div>
				<div class="form-group col-md-4">
					<label for="num_of_student">No of Student</label>
					<input class="form-control-sm" type="number" title="no of student 1-10" name="num_of_student" id="num_of_student" min="1" max="10" value="<?php echo isset($_POST['num_of_student']) ? $_POST['num_of_student'] : 1 ?>">
					<button class="btn btn-secondary" type='submit'>Go</button>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-4">
					<input class="form-control" type="text" pattern="\d*" minlength="11" maxlength="12" title="USN ex. 15001372000" name="usn[]" placeholder="USN" value="<?php if(isset($_POST['usn'][0])) echo $_POST['usn'][0] ?>">
				</div>
				<div class="form-group col-md-4">
					<input class="form-control" type="text" pattern="^[a-zA-Z\s]+$" title="Student Name ex. Socrates Binos" name="name[]" placeholder="Student Name" value="<?php if(isset($_POST['name'][0])) echo $_POST['name'][0] ?>">
				</div>
				<div class="form-group col-md-4">
					<select class="form-control" name="curriculum[]">
						<option value="">Select Curriculum</option>
						<?php

						if(isset($curriculum_list)):
							foreach($curriculum_list as $row): ?>
									<option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['curriculum'][0]) && $_POST['curriculum'][0] == $row['id']) echo 'selected' ?>><?php echo $row['curriculum_year'] . ' ' . $row['degree_name']  ?></option>
									<?php
							endforeach;
						endif;
						?>
					</select>
				</div>
			</div>
			<?php

			if(isset($_POST['num_of_student'])):
				for($i = 1; $i < $_POST['num_of_student']; $i++): ?>
					<div class="form-row">
						<div class="form-group col-md-4">
							<input class="form-control" type="text" pattern="\d*" minlength="11" maxlength="12" title="USN ex. 15001372000" name="usn[]" placeholder="USN" value="<?php if(isset($_POST['usn'][$i])) echo $_POST['usn'][$i] ?>">
						</div>
						<div class="form-group col-md-4">
							<input class="form-control" type="text" pattern="^[a-zA-Z\s]+$"  title="Student name ex. Socrates Binos" name="name[]" placeholder="Student Name" value="<?php if(isset($_POST['name'][$i])) echo $_POST['name'][$i] ?>">
						</div>
						<div class="form-group col-md-4">
							<select class="form-control" name="curriculum[]">
								<option value="">Select Curriculum</option>
								<?php

								if(isset($curriculum_list)):
									foreach($curriculum_list as $row): ?>
											<option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['curriculum'][$i]) && $_POST['curriculum'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['curriculum_year'] . ' ' . $row['degree_name']  ?></option>
											<?php
									endforeach;
								endif;
								?>
							</select>
						</div>
					</div>
					<?php
				endfor;
			endif;
			?>
			<div class='form-group'>
			<?php

			if(isset($student_exist)): ?>
				<strong>Student Exist: </strong><?php
				foreach ($student_exist as $value):
					 	 $k = implode(", ", $value); ?>
						 <strong class="text-danger"><?php echo $k; ?></strong><?php
				endforeach;
			endif;
			?>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" name="create_student">Create</button>
				<a class="btn btn-danger" href="index.php?menu=student_list">Cancel</a>
			</div>
		</form>
	</div>
</div>
