<?php 

$section_list = query(" SELECT  s.id
							,   s.section_code
							,   dl.degree_name
						from section_list s
						inner join degree_list dl
									on s.degree_id = dl.id
						order by s.id");

?>
<!-- alert msg -->
<?php

if(isset($_SESSION['msg']) && isset($_SESSION['alert'])): ?>
	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>
<?php endif; ?>
<!-- end of alert msg -->
<ol class="breadcrumb">
	<li class="breadcrumb-item active">Section List</li>
	<li class="breadcrumb-item active"></li>
</ol>

<h2 class="text-center">Section List</h2>
<div class="mt-3">
	<!-- new section -->
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=section">New Section</a>
	</div>
	<!-- table-div -->
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

				if ($section_list) :
					while ($section = mysqli_fetch_assoc($section_list)) : ?>
							<tr>
								<td><?php echo $section['id'] ?></td>
								<td><?php echo $section['section_code'] ?></td>
								<td><?php echo $section['degree_name'] ?></td>
								<td width="21%">
									<a href="index.php?edit=section&edit_id=<?php echo $section['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
									<a href="index.php?delete=section&delete_id=<?php echo $section['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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