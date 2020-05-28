<?php

if (isset($_GET['view_id'])) {
	$student_id = $_GET['view_id'];

	$select_student	= query("SELECT	sl.id
								, 	sl.usn
								, 	sl.name
								, 	cl.curriculum_year
								, 	dl.degree_name
							from 	student_list sl
							inner join curriculum_list cl
									on sl.curriculum_id = cl.id
							inner join degree_list dl
									on cl.degree_id = dl.id
							where 	sl.id = '$student_id'");
	if ($select_student) {
		$selected_student[] = array();
		while ($row = mysqli_fetch_assoc($select_student)){
				$selected_student[] = $row;
		}
	}

	$select_ssl = query("SELECT ss.id
							, 	sl.subject_code
							, 	sl.subject_desc
							, 	ss.grade
							, 	ss.status
							, 	ss.add_info
						from  student_subject_list ss
						inner join  curriculum_subject cs
									on ss.subject_id = cs.id
						inner join  subject_list sl
									on cs.subject_id = sl.id
						where 		ss.student_id = '$student_id'");
	if ($select_ssl) {
		$student_subject_list = array();
		while ($row = mysqli_fetch_assoc($select_ssl)) {
				$student_subject_list[] = $row;
		}
	}

}

?>

<?php

if (isset($_SESSION['msg']) && isset($_SESSION['alert'])): ?>
	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>
	<?php
endif;
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
  <li class="breadcrumb-item active">Student Subject List</li>
</ol>
<?php

if (isset($select_student)):
	foreach ($select_student as $row):
			?>
			<h2 class="text-center"><?php echo $row['usn'] . ', ' . $row['name'] . ', ' . $row['degree_name'] . ' ' . $row['curriculum_year'] ?></h2>
			<?php
	endforeach;
endif;
?>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=student_subject&student_id=<?php echo $student_id ?>">Add Subject</a>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-bordered table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Subject Code</th>
					<th>Subject Description</th>
					<th>Grade</th>
					<th>Status</th>
					<th>Additional Info</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if (isset($student_subject_list)):
					foreach ($student_subject_list as $row):
							?>
							<tr>
								<td><?php echo $row['id'] ?></td>
								<td><?php echo $row['subject_code'] ?></td>
								<td><?php echo $row['subject_desc'] ?></td>
								<td><?php echo $row['grade'] ?></td>
								<td><?php echo $row['status'] ?></td>
								<td><?php echo $row['add_info'] ?></td>
								<td>
									<a href="index.php?edit=student_subject&edit_id=<?php echo $row['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=student_subject&delete_id=<?php echo $row['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
							<?php
					endforeach;
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>