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
		<div class="card">
			<div class="card-body bg-secondary">
				<h5 class="text-dark">Name: <?php echo $row['name'] ?></h5>
				<h5 class="text-dark">USN: <?php echo $row['usn'] ?></h5>
				<h5 class="text-dark">Course: <?php echo $row['degree_name'] . ', ' . $row['curriculum_year'] ?></h5>
			</div>
		</div>
		<?php
	endforeach;
endif;
?>
<div class="mt-3">
	<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="form-group col-md-10">
				<h3>Grades</h3>
			</div>
			<div class="form-group col-md-2">
				<a class="btn btn-primary form-control" href="index.php?new=student_subject&student_id=<?php echo $student_id ?>">Add Subject</a>
			</div>
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
	</div>
</div>
<div class="mt-3">
	<div class="card">
	<div class="card-body">
		<form method="POST">
			<div class="row">
				<div class="form-group col-md-10">
					<h3>Advised Subjects</h3>
				</div>
				<div class="form-group col-md-2">
					<button class="btn btn-success form-control" name="get_advising">Get Advising</button>
				</div>
			</div>
		</form>
		<div class="table-responsive">
			<table class="table table-sm table-striped table-hover">
				<thead class="thead-light">
					<tr>
						<th>Subject</th>
						<th>Description</th>
						<th>Lec Unit</th>
						<th>Lab Unit</th>
						<th>Total Unit</th>
						<th>Prerequisites</th>
					</tr>
				</thead>
				<tbody>
					<?php 

					if(isset($_POST['get_advising'])):
					$get_advising = query("	SELECT
											  sl.subject_code
											, sl.subject_desc
											, sl.lec_unit
											, sl.lab_unit
											, cs.year 
											, cs.trimester
											, GROUP_CONCAT(DISTINCT sl2.subject_code order by sl2.subject_code asc separator ', ') AS prerequisites
											, count(DISTINCT csp.preq_subj_id) prereq_count
											, count(DISTINCT a.subject_id) passed

											FROM curriculum_subj_prereq csp

											INNER JOIN curriculum_subject cs
														ON csp.curriculum_subj_id = cs.id

											LEFT JOIN curriculum_subject cs2
														ON csp.preq_subj_id = cs2.id

											INNER JOIN subject_list sl
														ON cs.subject_id = sl.id

											LEFT JOIN subject_list sl2
														ON cs2.subject_id = sl2.id

											LEFT JOIN (	SELECT 
															subject_id
														FROM student_subject_list
														WHERE student_id = '$student_id'
														AND status = 'PASS'
														) AS a 
											ON csp.preq_subj_id = a.subject_id

											WHERE csp.curriculum_subj_id NOT IN (

												SELECT 
													subject_id
												FROM student_subject_list
												WHERE student_id = '$student_id'
												AND status = 'PASS' 
											)

											GROUP BY  sl.subject_code

											HAVING prereq_count = passed

											ORDER BY  cs.year asc
													, cs.trimester asc
										");
					if ($get_advising):
						while ($row = mysqli_fetch_assoc($get_advising)):
							?>
							<tr>
								<td><?php echo $row['subject_code'] ?></td>
								<td><?php echo $row['subject_desc'] ?></td>
								<td><?php echo $row['lec_unit'] ?></td>
								<td><?php echo $row['lab_unit'] ?></td>
								<td><?php echo $row['lec_unit'] + $row['lab_unit'] ?></td>
								<td><?php echo $row['prerequisites'] ?></td>
							</tr>
							<?php 
						endwhile;
					endif;
					?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
<?php endif;?>
</div>