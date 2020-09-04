<?php 

if (isset($_GET['v_id'])) {
	$petition_id = $_GET['v_id'];

	$petition_subject = query(" SELECT sl.subject_code 
								FROM request_to_open_list rto 
					 			inner join subject_list sl 
					 					on rto.subject_id = sl.id 
					 			where rto.id = '$petition_id'");

	$petition_student_list = query("SELECT
									   rtos.student_id,
									   sl.usn,
									   sl.name,
									   dl.degree_name 
									FROM
									   request_to_open_student_list rtos 
									   inner join
									      student_list sl 
									      on rtos.student_id = sl.id 
									   inner join
									      curriculum_list cl 
									      on sl.curriculum_id = cl.id 
									   inner join
									      degree_list dl 
									      on cl.degree_id = dl.id 
									where
									   rtos.req_to_open_id = '$petition_id'");

	$select_exist = query('	SELECT student_id 
							FROM request_to_open_student_list
							where student_id =' . $_SESSION['student_id']);

}

?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?m=pl">Petition List</a></li>
  <li class="breadcrumb-item active">Petition Student List</li>
</ol>

<div class="mt-5">
	<!-- subject -->
	<?php

	if ($petition_subject):
		while ($subject = mysqli_fetch_assoc($petition_subject)) : ?>

				<h3 class="text-center"><?php echo $subject['subject_code'] ?></h3>
				<?php
		endwhile;
	endif;
	?>
	<!-- end of subject -->
	<div class="form-group">
		<?php if (mysqli_num_rows($select_exist) > 0): ?>
					<a class="btn btn-danger" href="index.php?d=lp&p_id=<?php echo $petition_id ?>">Leave Petition</a>
		<?php else: ?>
					<a class="btn btn-primary" href="index.php?c=jp&p_id=<?php echo $petition_id ?>">Join Petition</a>
		<?php endif; ?>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-striped table-hover">
			<thead class="thead-light">
				<tr>
					<th>USN</th>
					<th>Name</th>
					<th>Course</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($petition_student_list) :
					while ($petition_student = mysqli_fetch_assoc($petition_student_list)) : ?>
							<tr>
								<td><?php echo $petition_student['usn'] ?></td>
								<td><?php echo $petition_student['name'] ?></td>
								<td><?php echo $petition_student['degree_name'] ?></td>
							</tr>
							<?php
					endwhile;
				endif;
				?>
			</tbody>
		</table>
	</div>
	<!-- end of table-div -->
</div>