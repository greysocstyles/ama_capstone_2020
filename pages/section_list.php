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
  <li class="breadcrumb-item active">Section List</li>
  <li class="breadcrumb-item active"></li>
</ol>
<h2 class="text-center">Section List</h2>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=section">New Section</a>
	</div>
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>Section Code</th>
					<th>Degree</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$select_section_list = query("SELECT    s.id
													,   s.section_code
													,   dl.degree_name
											from section_list s
											inner join degree_list dl
													on s.degree_id = dl.id
											order by s.id");

				if($select_section_list):
					while($row = mysqli_fetch_assoc($select_section_list)):
						?>
						<tr>
							<td><strong><?php echo $row['id'] ?></strong></td>
							<td><?php echo $row['section_code'] ?></td>
							<td><?php echo $row['degree_name'] ?></td>
							<td width="21%">
								<a href="index.php?edit=section&edit_id=<?php echo $row['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
								<a href="index.php?delete=section&delete_id=<?php echo $row['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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