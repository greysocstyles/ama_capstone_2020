<?php require_once 'actions/edit_subject.php'; ?>
<!-- alert msg -->
<?php

if (isset($msg) && isset($alert_class)) : ?>

	<div class="alert alert-dismissible <?php echo $alert_class ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $msg ?></strong>
	</div>

<?php endif; ?>
<!-- end of alert msg -->
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="index.php?menu=subject_list">Subject List</a></li>
	<li class="breadcrumb-item active">Edit Subject</li>
</ol>
<div class="card">
	<div class="card-body">
		<h2 class="card-title">Edit Subject</h2>
		<?php

		if (isset($_GET['edit_id'])):
			$edit_id = $_GET['edit_id'];
			$select_sl = query("select * from subject_list where id = '$edit_id'");
			if ($select_sl) :
				while($row = mysqli_fetch_assoc($select_sl)) : ?>
					<form action="index.php?edit=subject&edit_id=<?php echo $row['id'] ?>" method="POST">
						<div class="form-row">
							<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
							<div class="form-group col-md-6">
								<label for="subject_code">Subject Code</label>
								<input class="form-control" type="text" pattern="([a-zA-Z]+[ ][0-9]+)" id="subject_code" name="subject_code" value="<?php echo $row['subject_code'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="subject_name">Subject Name</label>
								<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5,}" id="subject_name" name="subject_name" value="<?php echo $row['subject_name'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="subject_desc">Subject Description</label>
								<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5,}" name="subject_desc" value="<?php echo $row['subject_desc'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="subject_status">Subject Status</label>
								<select class="form-control" id="subject_status" name="subject_status">
									<?php

									$z = ['Enable' => 1, 'Disable' => 0];

									foreach($z as $key => $value): ?>
										<option value="<?php echo $value ?>" <?php if($row['subject_status'] == $value) echo 'selected' ?>><?php echo $key?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="lec_unit">Lec Unit</label>
								<input class="form-control" type="number" min="1" max="9" id="lec_unit" name="lec_unit" value="<?php echo $row['lec_unit'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="lab_unit">Lab Unit</label>
								<input class="form-control" type="number" min="1" max="9" id="lab_unit" name="lab_unit" value="<?php echo $row['lab_unit'] ?>">
							</div>
						</div>
						<!-- error msg -->
						<div class="form-group">
							<?php

							if (isset($subject_exist)):
								echo 'Subject Exist: ';
								foreach ($subject_exist as $value): ?>
									<strong class="text-danger"><?php echo implode($value) ?></strong>
									<?php
								endforeach;
							endif;
							?>
						</div>
						<!-- end of error msg -->
						<div class="form-group">
							<button class="btn btn-primary" type="submit" name="edit_subject">Update</button>
							<a class="btn btn-danger" href="index.php?menu=subject_list">Cancel</a>
						</div>
					</form>
					<?php
				endwhile;
			endif;
		endif;
		?>
	</div>
</div>
