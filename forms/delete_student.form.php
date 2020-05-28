<?php require_once 'actions/delete_student.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
  <li class="breadcrumb-item active">Delete Student</li>
</ol>
<?php

if(isset($_GET['delete_id'])):
		 $delete_id = $_GET['delete_id'];
		 $result = query("select id, usn, name from student_list where id = '$delete_id'");
		 if($result):
			while($row = mysqli_fetch_assoc($result)): ?>
			<div class="card">
				<div class="card-body bg-secondary">
					<form action="index.php?delete=student" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>"/>
						<div class="form-group">
							<p>Are you sure you want to delete <strong class="text-danger"><?php echo $row['usn'] . ', ' . $row['name'] ?></strong>?</p>
							<button class="btn btn-danger" type="submit" name="delete_student">Yes</button>
							<a class="btn btn-secondary" href="index.php?menu=student_list">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
		endwhile;
	endif;
endif;
?>
