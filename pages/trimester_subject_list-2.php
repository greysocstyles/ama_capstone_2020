<?php 

if (isset($_GET['v_id'])) {
	$trimester_id = $_GET['v_id'];

	$select_trimester = query("select year, trimester from trimester_list where id = '$trimester_id'");

	if ($select_trimester) {
		$trimester = array();
		while ($row = mysqli_fetch_assoc($select_trimester)) {
				$trimester[] = $row;
		}
	}

	$select_tsl = query("SELECT tl.year 
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
						where tl.id = '$trimester_id'");

	if ($select_tsl) {
		$trimester_subject_list = array();
		while ($row = mysqli_fetch_assoc($select_tsl)) {
				$trimester_subject_list[] = $row;
		}
	}
}
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?m=tl">Trimester List</a></li>
  <li class="breadcrumb-item active">Trimester Subject List</li>
</ol>
<div class="mt-5">
<?php
if (isset($trimester)):
	foreach ($trimester as $row):
		?>
		<h2 class="text-center"><?php echo year_trimester($row['year']) . ' Year, ' . year_trimester($row['trimester']) . ' Trimester' ?></h2>
		<?php 
	endforeach;
endif;
?>
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
			if (isset($trimester_subject_list)): 
				foreach ($trimester_subject_list as $row):
						?>
						<tr>
							<td><?php echo $row['subject_code'] ?></td>
							<td><?php echo $row['section_code'] ?></td>
							<td><?php echo $row['room'] ?></td>
							<td><?php echo $row['days'] ?></td>
							<td><?php echo $row['time'] ?></td>
							<td><?php echo $row['professor'] ?></td>
						</tr>
						<?php 
				endforeach;
			endif;
			?>
			</tbody>
		</table>
	</div>
</div>
