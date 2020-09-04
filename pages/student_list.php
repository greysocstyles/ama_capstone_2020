<?php 

$student_list = query("SELECT sl.id
							, sl.usn
							, sl.name
							, cl.curriculum_year
							, dl.degree_name
					FROM 	student_list sl
					inner join curriculum_list cl
								on sl.curriculum_id = cl.id
					inner join degree_list dl
								on cl.degree_id = dl.id");

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
  <li class="breadcrumb-item active">Student List</li>
  <li class="breadcrumb-item active"></li>
</ol>

<h2 class="text-center">Student List</h2>
<div class="mt-3">
	<!-- new student -->
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=student">New Student</a>
	</div>
	<!-- table-div -->
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Id</th>
					<th>USN</th>
					<th>Name</th>
					<th>Curriculum</th>
					<th>Degree</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				if ($student_list) :
					while ($student = mysqli_fetch_assoc($student_list)) : ?>
							<tr>
								<td><?php echo $student['id'] ?></td>
								<td><?php echo $student['usn'] ?></td>
								<td><?php echo $student['name'] ?></td>
								<td><?php echo $student['curriculum_year'] ?></td>
								<td><?php echo $student['degree_name'] ?></td>
								<td>
									<a href="index.php?view=student_subject&view_id=<?php echo $student['id'] ?>" title="View Student Subject"><i class="fas fa-eye"></i></a>
									<a href="index.php?edit=student&edit_id=<?php echo $student['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>
									<a href="index.php?delete=student&delete_id=<?php echo $student['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
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