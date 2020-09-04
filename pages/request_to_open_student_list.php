<!-- alert msg -->
<?php

if (isset($_SESSION['msg']) && isset($_SESSION['alert'])) : ?>

	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>

<?php endif; ?>
<!-- end of alert msg -->

<?php

if (isset($_GET['view_id'])){
	$view_id = $_GET['view_id'];
	
	$result = query("select rto.id
						, 	sl.subject_code
					from request_to_open_list rto
					inner join subject_list sl
							on rto.subject_id = sl.id
					where rto.id = '$view_id'");

	$petition_student_list = query("SELECT rtos.id
										,  stl.USN
										,  stl.name
									FROM request_to_open_student_list rtos
									inner join student_list stl
									on rtos.student_id = stl.id
									where rtos.req_to_open_id = '$view_id'");
	if($result){
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			$petition_subject = $row['subject_code'];
		}
	}
}

?>

<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
  <li class="breadcrumb-item active">Petition Student List</li>
</ol>

<h2 class="text-center"><?php echo $petition_subject ?></h2>
<!-- add student -->
<div class="form-group">
	<a class="btn btn-outline-primary" href="index.php?new=petition_student&petition_id=<?php echo $id ?>">Add Student</a>
</div>
<!-- table-div -->
<div class="table-responsive">
	<table class="table table-sm table-bordered table-striped">
		<thead class="thead-light">
			<tr>
				<th>Id</th>
				<th>USN</th>
				<th>Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

			if ($petition_student_list):
				while ($petition_student = mysqli_fetch_assoc($petition_student_list)) : ?>
					<tr>
						<td><?php echo $petition_student['id'] ?></td>
						<td><?php echo $petition_student['USN'] ?></td>
						<td><?php echo $petition_student['name'] ?></td>
						<td>
							<a href="index.php?delete=petition_student&delete_id=<?php echo $petition_student['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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