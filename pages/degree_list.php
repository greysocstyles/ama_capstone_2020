<?php 

$degree_list = query("SELECT * from degree_list");

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
  <li class="breadcrumb-item active">Degree List</a></li>
  <li class="breadcrumb-item"></li>
</ol>

<h2 class="text-center">Degree List</h2>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=degree">New Degree</a>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
		<caption>List of Degree</caption>
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Degree Name</th>
					<th>Degree Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($degree_list):
					while ($degree = mysqli_fetch_assoc($degree_list)) : ?>
							<tr>
								<td><?php echo $degree['id'] ?></td>
								<td><?php echo $degree['degree_name'] ?></td>
								<td><?php echo $degree['degree_desc'] ?></td>
								<td width="21%">
									<a href="index.php?edit=degree&edit_id=<?php echo $degree['id'] ?>"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=degree&delete_id=<?php echo $degree['id'] ?>"><i class="fas fa-trash"></i></a>
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