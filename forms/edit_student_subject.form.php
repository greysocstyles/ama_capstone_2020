<?php require_once 'actions/edit_student_subject.php'; ?>
<?php

if (isset($_GET['edit_id'])){
		$edit_id = $_GET['edit_id'];

		$select_student_subject = query("select sts.id
											,	sts.student_id
											,	stl.usn
											,	stl.name
											,	sl.subject_code
											,	sl.subject_desc
											,	sts.grade
											,	sts.add_info
										from student_subject_list sts
										inner join student_list stl
												on sts.student_id = stl.id
										inner join curriculum_subject cs
												on sts.subject_id = cs.id
										inner join subject_list sl
												on cs.subject_id = sl.id
										where sts.id = '$edit_id'");
		if ($select_student_subject) {
			$student_subject_list = array();
			while ($row = mysqli_fetch_assoc($select_student_subject)) {
					$student_subject_list[] = $row;
					$student_id = $row['student_id'];
			}
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
<div class="row">
	<div class="col-md-8 m-auto">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
		  <li class="breadcrumb-item active"><a href="index.php?view=student_subject&view_id=<?php echo $student_id ?>">Student Subject List</a></li>
		  <li class="breadcrumb-item active">Edit Student Subject</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<?php
				if (isset($student_subject_list)):
					foreach ($student_subject_list as $row):
							?>
							<form action="index.php?edit=student_subject&edit_id=<?php echo $row['id'] ?>" method="POST">
								<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>"/>
								<input type="hidden" name="student_id" value="<?php echo $row['student_id'] ?>"/>
								<div class="form-row">
									<div class="form-group col-md-8">
										<h4><?php echo $row['usn'] . ', ' . $row['name'] ?></h4>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label>Subject Code</label>
										<input class="form-control" value="<?php echo $row['subject_code'] ?>" readonly>
									</div>
									<div class="form-group col-md-6">
										<label>Subject Description</label>
										<input class="form-control" value="<?php echo $row['subject_desc'] ?>" readonly>
									</div>
									<div class="form-group col-md-6">
										<label>Grade</label>
										<select class="form-control" name="grade">
											<?php

											$grade_list = array('A+','A','A-','B+','B','B-','C+','C','C-','F','IC','IP');

											foreach($grade_list as $grade):
												?>
												<option value="<?php echo $grade ?>" <?php if($row['grade'] == $grade) echo 'selected'  ?>><?php echo $grade ?></option>
												<?php
											endforeach;
											?>
										</select>
										<input class="form-control" type="hidden" name="status" value="<?php echo $row['status'] ?>">
									</div>
									<div class="form-group col-md-6">
										<label>Additional Info</label>
										<input class="form-control" type="text" name="add_info" value="<?php echo $row['add_info'] ?>" >
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-4">
										<button class="btn btn-info" name="edit_student_subject">Update</button>
										<a class="btn btn-danger" href="index.php?view=student_subject&view_id=<?php echo $row['student_id'] ?>">Cancel</a>
									</div>
								</div>
							</form>
							<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</div>
