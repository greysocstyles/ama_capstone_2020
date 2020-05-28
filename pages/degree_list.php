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
  <li class="breadcrumb-item active">Degree List</a></li>
  <li class="breadcrumb-item"></li>
</ol>
<h2 class="text-center">Degree List</h2>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=degree">New Degree</a>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
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

				$select_degree_list = query("SELECT * from degree_list");

				if($select_degree_list):
					while($row = mysqli_fetch_assoc($select_degree_list)):
						?>
						<tr>
							<td><?php echo $row['id'] ?></td>
							<td><?php echo $row['degree_name'] ?></td>
							<td><?php echo $row['degree_desc'] ?></td>
							<td width="21%">
								<a href="index.php?edit=degree&edit_id=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a>&nbsp;
								<a href="index.php?delete=degree&delete_id=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
							</td>
						</tr>
						<?php
					endwhile;
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>