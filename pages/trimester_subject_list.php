<?php

if (isset($_GET['view_id'])) {
	$trimester_id = $_GET['view_id'];

	$trimester_list = query("SELECT year, trimester FROM trimester_list where id = '$trimester_id'");

	$trimester_subject_list = query("SELECT	tsl.id
										,	sl.subject_code
										,	s.section_code
										,	dl.degree_name
										,	tsl.room
										,	tsl.days
										,	tsl.time
										,	tsl.professor

									FROM 	trimester_subject_list tsl

									inner join subject_list sl
												on tsl.subject_id = sl.id

									inner join section_list s
												on tsl.section_id = s.id

									inner join degree_list dl
												on s.degree_id = dl.id

									WHERE tsl.trimester_id = '$trimester_id'

									order by tsl.id asc");

}

?>

<!-- alert msg -->
<?php

if(isset($_SESSION['msg']) && isset($_SESSION['alert'])) : ?>

	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>

<?php endif; ?>
<!-- end of alert msg -->

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
	<li class="breadcrumb-item active">Trimester Subject List</li>
</ol>

<!-- year and trimester -->
<?php 

if ($trimester_list) : 
	while ($trimester = mysqli_fetch_assoc($trimester_list)) : ?>

			<h2 class="text-center">
				<?php echo year_trimester($trimester['year']) . ' Year' . ', ' . year_trimester($trimester['trimester']) . ' Trimester' ?>	
			</h2>
			<?php
	endwhile;
endif;
?>
<!-- end of year and trimester -->
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=trimester_subject&trimester_id=<?php echo $trimester_id ?>">New Subject</a>
	</div>
	<!-- table-div -->
	<div class="table-responisve">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Subject</th>
					<th>Section</th>
					<th>Course</th>
					<th>Room</th>
					<th>Days</th>
					<th>Time</th>
					<th>Professor</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($trimester_subject_list) :
					while ($trimester_subject = mysqli_fetch_assoc($trimester_subject_list)) : ?>
							<tr>
								<td><?php echo $trimester_subject['id'] ?></td>
								<td><?php echo $trimester_subject['subject_code'] ?></td>
								<td><?php echo $trimester_subject['section_code'] ?></td>
								<td><?php echo $trimester_subject['degree_name'] ?></td>
								<td><?php echo $trimester_subject['room'] ?></td>
								<td><?php echo $trimester_subject['days'] ?></td>
								<td><?php echo $trimester_subject['time'] ?></td>
								<td><?php echo $trimester_subject['professor'] ?></td>
								<td>
									<a href="index.php?edit=trimester_subject&edit_id=<?php echo $trimester_subject['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=trimester_subject&delete_id=<?php echo $trimester_subject['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
								</td>
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