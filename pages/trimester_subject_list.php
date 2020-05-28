<?php

if(isset($_GET['view_id'])) {
		$trimester_id = $_GET['view_id'];

		$select_trimester = query(" select year, trimester from trimester_list where id = '$trimester_id'");

		if ($select_trimester) {
		 	$trimester_selected = array();
			while ($row = mysqli_fetch_assoc($select_trimester)) {
						$trimester_selected[] = $row;
			}
		}

		$select_tsl = query("SELECT	tsl.id
								,	sl.subject_code
								,	s.section_code
								,	tsl.room
								,	tsl.days
								,	tsl.time
								,	tsl.professor
							FROM 	trimester_subject_list tsl
							inner join subject_list sl
										on tsl.subject_id = sl.id
							inner join section_list s
										on tsl.section_id = s.id
							WHERE tsl.trimester_id = '$trimester_id'
							order by  sl.subject_code
									, s.section_code ASC");

		if ($select_tsl) {
			$trimester_subject_list = array();
			while ($row = mysqli_fetch_assoc($select_tsl)) {
						$trimester_subject_list[] = $row;
			}
		}

}

?>

<?php

if(isset($_SESSION['msg']) && isset($_SESSION['alert'])): ?>
	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>
	<?php
endif;
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
  <li class="breadcrumb-item active">Trimester Subject List</li>
</ol>
<?php

if (isset($trimester_selected)):
	foreach ($trimester_selected as $row):
			?>
			<h2 class="text-center"><?php echo year_trimester($row['year']) . ' Year' . ', ' . year_trimester($row['trimester']) . ' Trimester' ?></h2>
			<?php
	endforeach;
endif;
?>
<div class="mt-3">
<div class="form-group">
	<a class="btn btn-outline-primary" href="index.php?new=trimester_subject&trimester_id=<?php echo $trimester_id ?>">New Subject</a>
</div>

<div class="table-responisve">
	<table class="table table-sm table-bordered table-hover table-striped">
		<thead class="thead-light">
			<tr>
				<th>Id</th>
				<th>Subject</th>
				<th>Section</th>
				<th>Room</th>
				<th>Days</th>
				<th>Time</th>
				<th>Professor</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

			if (isset($trimester_subject_list)):
				foreach ($trimester_subject_list as $row):
						?>
						<tr>
							<td><strong><?php echo $row['id'] ?></strong></td>
							<td><?php echo $row['subject_code'] ?></td>
							<td><?php echo $row['section_code'] ?></td>
							<td><?php echo $row['room'] ?></td>
							<td><?php echo $row['days'] ?></td>
							<td><?php echo $row['time'] ?></td>
							<td><?php echo $row['professor'] ?></td>
							<td>
								<a href="index.php?edit=trimester_subject&edit_id=<?php echo $row['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
								<a href="index.php?delete=trimester_subject&delete_id=<?php echo $row['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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