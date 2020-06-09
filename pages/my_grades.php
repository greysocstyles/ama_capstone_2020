<?php 

if (isset($_GET['v_id'])) {
	$student_id = $_GET['v_id'];
	$select_student = query("select sl.name
								,	sl.usn 
								,	cl.curriculum_year
								,	dl.degree_name   
							from student_list sl
							inner join curriculum_list cl 
										on sl.curriculum_id = cl.id
							inner join degree_list dl 
										on cl.degree_id = dl.id
							where sl.id = '$student_id'");

	if ($select_student) {
		$student = array();
		while ($row = mysqli_fetch_assoc($select_student)) {
				$student[] = $row;
		}
	}

	$select_student_subject = query("select sl.subject_code
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
	if ($select_student_subject) {
		$student_subject = array();
		while ($row = mysqli_fetch_assoc($select_student_subject)) {
				$student_subject[] = $row; 
		}
	}
}

?>
<div class="mt-5">
<?php
if (isset($student)):
	foreach ($student as $row):
			?>
			<h4 class="text-center"><?php echo $row['usn'] . ', ' . $row['name'] ?></h4>
			<h4 class="text-center"><?php echo $row['degree_name'] . ', ' . $row['curriculum_year'] ?></h5>
			<?php
	endforeach;
endif;		
?>	
	<div class="table-responsive mt-4">
		<table class="table table-sm table-striped">
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
			if (isset($student_subject)):
				foreach ($student_subject as $row):
						?>
						<tr>
							<td><?php echo $row['subject_code'] ?></td>
							<td><?php echo $row['subject_desc'] ?></td>
							<td><?php echo $row['lec_unit'] + $row['lab_unit'] ?></td>
							<td><?php echo $row['grade'] ?></td>
							<td><?php echo $row['status'] ?></td>
							<td><?php echo $row['add_info'] ?></td>
						</tr>
						<?php
				endforeach;
			endif; 
			?>
			</tbody>
		</table>
	</div>
</div>
<div class="mt-2">
	<form action="index.php?v=mg&v_id=<?php echo $student_id ?>" method="POST">
		<button class="btn btn-primary" type="submit" name="get_advising">Get Advising</button>
	</form>
</div>
<?php

if (isset($_POST['get_advising']) && $_SERVER['REQUEST_METHOD'] == 'POST'):
	$get_advising = query(" select  sl.subject_code
							    ,   sl.subject_desc
							    ,   sl.lec_unit
							    ,   sl.lab_unit
							    ,   GROUP_CONCAT(sl2.subject_code) as prerequisites
							    ,   count(csp.preq_subj_id) as preq_count
							    ,   count(sts.subject_id) as passed
							from curriculum_subj_prereq csp
							inner join curriculum_subject cs
							            on csp.curriculum_subj_id = cs.id
							left join curriculum_subject cs2
							            on csp.preq_subj_id = cs2.id
							inner join subject_list sl
							            on cs.subject_id = sl.id
							left join subject_list sl2
							            on cs2.subject_id = sl2.id
							left join student_subject_list sts
										on csp.preq_subj_id = sts.subject_id

							where csp.curriculum_subj_id not in (

							    select subject_id
							    from student_subject_list
							    where student_id = '$student_id'
							    and status = 'PASS'
							)           

							group by sl.subject_code

							having preq_count = passed

							order by cs.year
								, cs.trimester
							
							ASC ");
?>
<div class="table-responsive mt-2">
	<h3 class="text-center">Advised Subjects</h3>
	<table class="table table-sm table-striped mt-4">
		<thead class="thead-light">
			<tr>
				<th>Subject</th>
				<th>Description</th>
				<th>Lec Unit</th>
				<th>Lab Unit</th>
				<th>Total Units</th>
				<th>Prerequisites</th>
			</tr>
		</thead>
		<tbody>
			<?php
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
<?php endif; ?>

