<?php require_once 'actions/create_petition_student.php'; ?>

<?php

if(isset($_GET['petition_id'])) {
	$petition_id = $_GET['petition_id'];
}
?>
<div class="row">
	<div class="col-md-8 m-auto">
	<?php
		if(isset($msg) && isset($alert_class)): ?>
			<div class="alert alert-dismissible <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>
			<?php
		endif;
		?>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
		  <li class="breadcrumb-item"><a href="index.php?view=petition_student&view_id=<?php echo $petition_id ?>">Petition Student List</a></li>
		  <li class="breadcrumb-item">Add Student</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>Add Student</h3>
				</div>
				<form action="index.php?new=petition_student&petition_id=<?php echo $petition_id ?>" method="POST">
					<div class="form-group">
						<input type="hidden" name="petition_subject_id" value="<?php echo $petition_id ?>">
						<select class="form-control" name="petition_student_id">
							<option value="">Select Student</option>
							<?php

							$result = query("select sl.id
												  , sl.name
											from student_list sl
											where not exists(select rtos.student_id
															from request_to_open_student_list rtos
															where rtos.req_to_open_id = '$petition_id'
															and rtos.student_id = sl.id)");

							if($result):
								while($row = mysqli_fetch_assoc($result)): ?>
									<option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['petition_student_id'])) echo 'selected' ?>><?php echo $row['name'] ?></option>
									<?php
								endwhile;
							endif;
							?>
						</select>
					</div>
					<div class="form-group">
					<?php

					if(isset($student_exist)): ?>
						<strong>Student exist: </strong>
					<?php
						foreach($student_exist as $value):
							?>
							<strong class="text-danger"><?php echo implode($value); ?></strong>
							<?php
						endforeach;
					endif;
					?>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="add_petition_student">Add</button>
						<a class="btn btn-danger" href="index.php?view=petition_student&view_id=<?php echo $petition_id ?>">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
