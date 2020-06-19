<?php 

if (isset($_GET['v_id'])) {
	$petition_id = $_GET['v_id'];
	$select_petition = query("	select sl.subject_code 
								from request_to_open_list rto 
					 			inner join subject_list sl 
					 					on rto.subject_id = sl.id 
					 			where rto.id = '$petition_id'");
	if ($select_petition) {
		$petition = array();
		while ($row = mysqli_fetch_assoc($select_petition)) {
				$petition[] = $row;
		}
	}

	$select_petition_student_list = query("	select 	rtos.student_id
												, 	sl.usn
												, 	sl.name
												, 	dl.degree_name
										 	from request_to_open_student_list rtos
										 	inner join student_list sl 
										 				on rtos.student_id = sl.id
										 	inner join curriculum_list cl 
										 				on sl.curriculum_id = cl.id
										 	inner join degree_list dl 
										 				on cl.degree_id = dl.id 
											where rtos.req_to_open_id = '$petition_id'");
	if ($select_petition_student_list) {
		$petition_student_list = array();
		while ($row = mysqli_fetch_assoc($select_petition_student_list)) {
				$petition_student_list[] = $row;
		}
	}

}
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?m=pl">Petition List</a></li>
  <li class="breadcrumb-item active">Petition Student List</li>
</ol>
<div class="mt-5">
	<?php 
	if (isset($petition)):
		foreach ($petition as $row):
			?>
			<h3 class="text-center"><?php echo $row['subject_code'] ?></h3>
			<?php
		endforeach;
	endif;
	?>
	<div class="form-group">
		<?php 
		
		$select_exist = query('	select student_id 
								from request_to_open_student_list
								where student_id =' . $_SESSION['student_id']);

		if (mysqli_num_rows($select_exist) > 0):
			?>
			<a class="btn btn-danger" href="index.php?d=lp&p_id=<?php echo $petition_id ?>">Leave Petition</a>
			<?php 
		else:
			?>
			<a class="btn btn-primary" href="index.php?c=jp&p_id=<?php echo $petition_id ?>">Join Petition</a>
			<?php 
		endif; 
		?>
	</div>
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
				if (isset($petition_student_list)):
					foreach ($petition_student_list as $row):
						?>
						<tr>
							<td><?php echo $row['usn'] ?></td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['degree_name'] ?></td>
						</tr>
						<?php
					endforeach;
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>