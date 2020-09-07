<?php 

$petition_subject_list = query("SELECT ps.id
									,  sl.subject_code
									,  ps.status
								from request_to_open_list ps
								inner join subject_list sl
										on ps.subject_id = sl.id");

?>

<!-- alert msg -->
<?php

if (isset($_SESSION['msg']) && isset($_SESSION['alert'])) : ?>

	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>

<?php endif; ?>
<!-- end of alert msg -->

<ol class="breadcrumb">
	<li class="breadcrumb-item active">Request To Open List</a></li>
	<li class="breadcrumb-item"></li>
</ol>

<h2 class="text-center">Request To Open List</h2>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=petition">New Request</a>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Petition Subject</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($petition_subject_list) :
					while ($petition_subject = mysqli_fetch_assoc($petition_subject_list)) : ?>
							<tr>
								<td><?php echo $petition_subject['id'] ?></td>
								<td><?php echo $petition_subject['subject_code'] ?></td>
								<td><?php echo $petition_subject['status'] ?></td>
								<td>
									<a href="index.php?view=petition_student&view_id=<?php echo $petition_subject['id'] ?>" title="View"><i class="fas fa-eye"></i></a>
									<a href="index.php?edit=petition&edit_id=<?php echo $petition_subject['id'] ?>" title="Edit"><i class="fas fa-edit">
									</i></a>
									<a href="index.php?delete=petition&delete_id=<?php echo $petition_subject['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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