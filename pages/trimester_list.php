<?php 

$trimester_list = query("SELECT * from trimester_list");

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
	<li class="breadcrumb-item active">Trimester List</li>
	<li class="breadcrumb-item active"></li>
</ol>

<h2 class="text-center">Trimester List</h2>
<div class="mt-3">
	<!-- new trimester -->
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=trimester">New Trimester</a>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Year</th>
					<th>Trimester</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($trimester_list):
					while ($trimester = mysqli_fetch_assoc($trimester_list)): ?>
							<tr>
								<td width="5%"><?php echo $trimester['id'] ?></td>
								<td><?php echo year_trimester($trimester['year']) ?></td>
								<td><?php echo year_trimester($trimester['trimester']) ?></td>
								<td width="25%">
									<a href="index.php?view=trimester_subject&view_id=<?php echo $trimester['id'] ?>" title="View Subjects"><i class="fas fa-eye"></i></a>&nbsp;
									<a href="index.php?edit=trimester&edit_id=<?php echo $trimester['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=trimester&delete_id=<?php echo $trimester['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
							<?php
					endwhile;
				endif;
				?>
			</tbody>
		</table>
	</div>
	<!-- table-div -->
</div>