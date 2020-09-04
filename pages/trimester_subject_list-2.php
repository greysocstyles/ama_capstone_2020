<?php 

if (isset($_GET['v_id'])) {
	$trimester_id = $_GET['v_id'];

	$trimester_list = query("select year, trimester from trimester_list where id = '$trimester_id'");

	$trimester_subject_list = query("SELECT tl.year 
										,	tl.trimester 
										,	sl.subject_code
										,	s.section_code
										,	tsl.room 
										,	tsl.days
										,	tsl.time 
										,	tsl.professor

									FROM trimester_subject_list tsl 

									inner join trimester_list tl 
												on tsl.trimester_id = tl.id 

									inner join subject_list sl 
												on tsl.subject_id = sl.id 

									inner join section_list s 
												on tsl.section_id = s.id

									where tl.id = '$trimester_id'
									
									");

}

?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?m=tl">Trimester List</a></li>
  <li class="breadcrumb-item active">Trimester Subject List</li>
</ol>

<div class="mt-5">
	<!-- year and trimester -->
	<?php 

	if ($trimester_list) :
		while ($trimester = mysqli_fetch_assoc($trimester_list)) : ?>

				<h2 class="text-center">
					<?php echo year_trimester($trimester['year']) . ' Year, ' . year_trimester($trimester['trimester']) . ' Trimester' ?>
				</h2>
				<?php 
		endwhile;
	endif; 
	?>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-striped table-bordered mt-4">
			<thead class="thead-light">
				<tr>
					<th>Subject</th>
					<th>Section</th>
					<th>Room</th>
					<th>Days</th>
					<th>Time</th>
					<th>Professor</th>
				</tr>
			</thead>
			<tbody>
			<?php 

			if ($trimester_subject_list) : 
				while ($trimester_subject = mysqli_fetch_assoc($trimester_subject_list)) : ?>
						<tr>
							<td><?php echo $trimester_subject['subject_code'] ?></td>
							<td><?php echo $trimester_subject['section_code'] ?></td>
							<td><?php echo $trimester_subject['room'] ?></td>
							<td><?php echo $trimester_subject['days'] ?></td>
							<td><?php echo $trimester_subject['time'] ?></td>
							<td><?php echo $trimester_subject['professor'] ?></td>
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
