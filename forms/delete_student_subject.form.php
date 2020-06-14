<?php require_once 'actions/delete_student_subject.php'; ?>
<?php
if (isset($_GET['delete_id'])) {
	$delete_id = $_GET['delete_id'];
	$select_student_subject = query("select ss.id
										,	ss.student_id
										, 	sl.subject_code
									from student_subject_list ss
									inner join curriculum_subject cs
												on ss.subject_id = cs.id
									inner join subject_list sl
												on cs.subject_id = sl.id
									where ss.id = '$delete_id'");

	if ($select_student_subject) {
		$student_subject_list = array();
		while ($row = mysqli_fetch_assoc($select_student_subject)) {
				$student_subject_list[] = $row;
				$student_id = $row['student_id'];
		}
	}

}

?>
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
  <li class="breadcrumb-item active"><a href="index.php?view=student_subject&view_id=<?php echo $student_id ?>">Student Subject List</a></li>
  <li class="breadcrumb-item active">Edit Student Subject</li>
</ol>
<?php
if (isset($student_subject_list)):
	foreach ($student_subject_list as $row):
			?>
			<div class="card">
				<div class="card-body">
					<form action="index.php?delete=student_subject&delete_id=<?php echo $row['id'] ?>" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>"/>
						<div class="form-group">
							<input type="hidden" name="student_id" value="<?php echo $row['student_id'] ?>">
							<p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['subject_code'] ?></strong>?</p>
							<button class="btn btn-danger" type="submit" name="delete_student_subject">Yes</button>
							<a class="btn btn-secondary" href="index.php?view=student_subject&view_id=<?php echo $row['student_id'] ?>">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
	endforeach;
endif;
?>
