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
  <li class="breadcrumb-item active">Curriculum List</li>
  <li class="breadcrumb-item active"></li>
</ol>
<h2 class="text-center">Curriculum List</h2>
<div class="form-group">
	<a class="btn btn-outline-primary" href="index.php?new=curriculum">New Curriculum</a>
</div>
<div class="table-responsive">
	<table class="table table-sm table-bordered table-hover table-striped">
		<thead class="thead-light">
			<tr>
				<th>Id</th>
				<th>Degree</th>
				<th>Curriculum Year</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php

			$select_curriculum_list = query("SELECT cl.id
												, 	dl.degree_name
												, 	cl.curriculum_year
											from curriculum_list as cl
											inner join degree_list as dl
													on cl.degree_id = dl.id");

				if($select_curriculum_list):
					while($row = mysqli_fetch_assoc($select_curriculum_list)):
						?>
						<tr>
							<td><strong><?php echo $row['id'] ?></strong></td>
							<td><?php echo $row['degree_name'] ?></td>
							<td><?php echo $row['curriculum_year'] ?></td>
							<td width="21%">
								<a href="index.php?view=curriculum_subject&view_id=<?php echo $row['id'] ?>" title="View"><i class="fas fa-eye"></i></a>&nbsp;
								<a href="index.php?edit=curriculum&edit_id=<?php echo $row['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
								<a href="index.php?delete=curriculum&delete_id=<?php echo $row['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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