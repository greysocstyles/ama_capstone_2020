<?php

if (isset($_GET['v_id'])) {
	$student_id = $_GET['v_id'];

	$student_list = query("	select  sl.name
									,	sl.usn
									,	sl.curriculum_id
									,	cl.curriculum_year
									,	dl.degree_name
							from student_list sl
							inner join curriculum_list cl
										on sl.curriculum_id = cl.id
							inner join degree_list dl
										on cl.degree_id = dl.id
							where sl.id = '$student_id'");

	$student_subject_list = query("	select  sl.subject_code
											,	sl.subject_desc
											,	sl.lec_unit
											,	sl.lab_unit
											,	sts.grade
									    	,	sts.status
									    	,	sts.add_info
									from student_subject_list sts
									inner join curriculum_subject cs
												on sts.subject_id = cs.id
									inner join subject_list sl
												on cs.subject_id = sl.id
									where sts.student_id = '$student_id'");

}

?>
<div class="container">
	<!-- student -->
	<div class="card">
		<div class="card-body bg-secondary">
			<?php
			if ($student_list) :
				while ($student = mysqli_fetch_assoc($student_list)) : 
						$curriculum_id = $student['curriculum_id'];
						?>
						<h5 class="text-dark"><?php echo 'Name: ' . $student['name'] ?></h5>
						<h5 class="text-dark"><?php echo 'USN: ' . $student['usn'] ?></h5>
						<h5 class="text-dark"><?php echo 'Course: ' . $student['degree_name'] . ', ' . $student['curriculum_year']  ?></h5>
						<?php
				endwhile;
			endif;
			?>
		</div>
	</div>
	<!-- end of student -->

	<!-- grades -->
	<div class="card mt-3">
		<div class="card-body">
			<div class="form-group">
				<h3>Grades</h3>
			</div>
			<div class="table-responsive">
				<table class="table table-sm table-striped table-hover">
					<thead class="thead-light">
						<tr>
							<th>Subject</th>
							<th>Description</th>
							<th>Units</th>
							<th>Grade</th>
							<th>Status</th>
							<th>Additional Info</th>
						</tr>
					</thead>
					<tbody>
					<?php

					if ($student_subject_list) :
						while ($student_subject = mysqli_fetch_assoc($student_subject_list)) : ?>
								<tr>
									<td><?php echo $student_subject['subject_code'] ?></td>
									<td><?php echo $student_subject['subject_desc'] ?></td>
									<td><?php echo $student_subject['lec_unit'] + $student_subject['lab_unit'] ?></td>
									<td><?php echo $student_subject['grade'] ?></td>
									<td><?php echo $student_subject['status'] ?></td>
									<td><?php echo $student_subject['add_info'] ?></td>
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
	<!-- end of grades -->

	<!-- advising -->
	<div class="card mt-3">
		<div class="card-body">
			<form action="index.php?v=mg&v_id=<?php echo $student_id ?>" method="POST">
				<div class="form-row">
					<div class="form-group col-md-10">
						<h3>Advised Subjects</h3>
					</div>
					<!-- get advising -->
					<div class="form-group col-md-2">
						<button class="btn btn-success form-control" type="submit" name="get_advising">Get Advising</button>
					</div>
				</div>
			</form>
			<div class="table-responsive">
				<table class="table table-sm table-striped table-hover table-hover">
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

						if (isset($_POST['get_advising']) && $_SERVER['REQUEST_METHOD'] == 'POST') :
							$get_advising = query("	SELECT
														sl.subject_code,
														sl.subject_desc,
														sl.lec_unit,
														sl.lab_unit,
														cs.year,
														cs.trimester,
														GROUP_CONCAT(DISTINCT sl2.subject_code 
													order by
														sl2.subject_code asc separator ', ') AS prerequisites,
														count(DISTINCT csp.preq_subj_id) prereq_count,
														count(DISTINCT a.subject_id) passed 
													FROM
														curriculum_subj_prereq csp 
														INNER JOIN
															(
																SELECT
																	* 
																FROM
																	curriculum_subject 
																WHERE
																	curriculum_id = $curriculum_id 
															)
															as cs 
															ON csp.curriculum_subj_id = cs.id 
														LEFT JOIN
															curriculum_subject cs2 
															ON csp.preq_subj_id = cs2.id 
														INNER JOIN
															subject_list sl 
															ON cs.subject_id = sl.id 
														LEFT JOIN
															subject_list sl2 
															ON cs2.subject_id = sl2.id 
														LEFT JOIN
															(
																SELECT
																	subject_id 
																FROM
																	student_subject_list 
																WHERE
																	student_id = $student_id 
																	AND status = 'PASS' 
															)
															AS a 
															ON csp.preq_subj_id = a.subject_id 
													WHERE
														csp.curriculum_subj_id NOT IN 
														(
															SELECT
																subject_id 
															FROM
																student_subject_list 
															WHERE
																student_id = $student_id
																AND status = 'PASS' 
														)
													GROUP BY
														sl.subject_code 
													HAVING
														prereq_count = passed 
													ORDER BY
														cs.year asc,
														cs.trimester asc
																								
												");

							if ($get_advising) :
								$units = 0;
								while ($row = mysqli_fetch_assoc($get_advising)) :
									if ($units < 21) : ?>
										<tr>
											<td><?php echo $row['subject_code'] ?></td>
											<td><?php echo $row['subject_desc'] ?></td>
											<td><?php echo $row['lec_unit'] ?></td>
											<td><?php echo $row['lab_unit'] ?></td>
											<td><?php echo $total_unit = $row['lec_unit'] + $row['lab_unit'] ?></td>
											<td><?php echo $row['prerequisites'] ?></td>
										</tr>
									<?php
									$units += $total_unit;
									endif;
								endwhile;
							endif;
						endif;
						?>
					</tbody>
				</table>
				<!-- total units -->
				<div class="float-right">
					<strong>Total Unit: </strong>&nbsp;&nbsp;<?php echo $units ?? $units ?? ''; ?>
				</div>
			</div>
		</div>
	</div>
	<!-- end of advising -->
</div>

