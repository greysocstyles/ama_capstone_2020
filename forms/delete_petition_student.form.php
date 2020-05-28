<?php require_once 'actions/delete_petition_student.php'; ?>
<?php

if(isset($_GET['delete_id'])) {
	$delete_id = $_GET['delete_id'];
	$select_rtos = query("select rtos.id
						,	rtos.req_to_open_id
						, 	stl.usn
						, 	stl.name
						from request_to_open_student_list rtos
						inner join student_list stl
								on rtos.student_id = stl.id
						where rtos.id = '$delete_id'");
	if($select_rtos) {
		$petition_student_list = array();
		while($row = mysqli_fetch_assoc($select_rtos)) {
				$petition_student_list[] = $row;
				$petition_id = $row['req_to_open_id'];
		}
	}
}
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
  <li class="breadcrumb-item"><a href="index.php?view=petition_student&view_id=<?php echo $petition_id ?>">Petition Student List</a></li>
  <li class="breadcrumb-item">Delete Petition Student</li>
</ol>
<?php

if(isset($petition_student_list)):
	foreach($petition_student_list as $row):
			?>
			<div class="card">
				<div class="card-body bg-secondary">
					<form action="index.php?delete=petition_student" method="POST">
						<input type="hidden" name="petition_id" value="<?php echo $row['req_to_open_id'] ?>">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['usn'] . ', ' . $row['name'] ?></strong>?</p>
							<button class="btn btn-danger" name="delete_petition_student">Yes</button>
							<a class="btn btn-secondary" href="index.php?view=petition_student&view_id=<?php echo $row['req_to_open_id'] ?>">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
	endforeach;
endif;
?>
