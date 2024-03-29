<?php 

$subject_list = query("select * from subject_list"); 

?>
<!-- alert msg -->
<?php

if(isset($_SESSION['msg']) && isset($_SESSION['alert'])) : ?>

	<div class="alert alert-dismissible <?php echo $_SESSION['alert']; ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg']; ?></strong>
	</div>

<?php endif; ?>
<!-- end of alert msg -->
<ol class="breadcrumb">
  <li class="breadcrumb-item active">Subject List</li>
  <li class="breadcrumb-item active"></li>
</ol>

<h2 class="text-center">Subject List</h2>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=subject">New Subject</a>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<caption>List of Subjects</caption>
			<thead class=thead-light>
				<tr>
					<th>Id</th>
					<th>Subject Code</th>
					<th>Subject Name</th>
					<th>Subject Description</th>
					<th>Status</th>
					<th>Lec Unit</th>
					<th>Lab Unit</th>
					<th>Total Unit</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($subject_list) :
					while ($subject = mysqli_fetch_assoc($subject_list)) : ?>
							<tr>
								<td><?php echo $subject['id'] ?></td>
								<td><?php echo $subject['subject_code'] ?></td>
								<td><?php echo $subject['subject_name'] ?></td>
								<td><?php echo $subject['subject_desc'] ?></td>
								<td class="text-center"><?php echo $subject['subject_status'] ? '<i class="fa fa-check text-success" aria-hidden="true"> Enabled</i>' : '<i class="fa fa-times text-secondary" aria-hidden="true"> Disabled</i>' ?></td>
								<td><?php echo $subject['lec_unit'] ?></td>
								<td><?php echo $subject['lab_unit'] ?></td>
								<td><?php echo $subject['lec_unit'] + $subject['lab_unit'] ?></td>
								<td>
									<a href="index.php?edit=subject&edit_id=<?php echo $subject['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=subject&delete_id=<?php echo $subject['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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