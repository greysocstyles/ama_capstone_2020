<?php require_once 'actions/edit_petition_subject.php'; ?>
<?php

if(isset($msg) && isset($alert_class)): ?>
	<div class="alert alert-dismissible <?php echo $Alert ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $Message ?></strong>
	</div>
	<?php
endif;
?>
<div class="row">
	<div class="col-md-8 m-auto">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
		  <li class="breadcrumb-item active">Edit Petition</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<h3>Edit Petition</h3>
				</div>
				<?php

				if(isset($_GET['edit_id'])):
					$edit_id = $_GET['edit_id'];
					$result = query("select ps.id
										,	ps.subject_id
										,	ps.status
									from request_to_open_list ps
									inner join subject_list sl
											on ps.subject_id = sl.id
									where ps.id = '$edit_id'");
					if($result):
						while($row = mysqli_fetch_assoc($result)): ?>
							<form action="index.php?edit=petition&edit_id=<?php echo $row['id'] ?>" method="POST">
								<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
								<div class="form-group">
									<label>Subject</label>
									<select class="form-control" name="petition_subject">
										<?php

										$select_subject_list = query("select * from subject_list");

										while($subj = mysqli_fetch_assoc($select_subject_list)): ?>
											<option value="<?php echo $subj['id']; ?>" <?php if($row['subject_id'] == $subj['id']) echo 'selected' ?> ><?php echo $subj['subject_code'] ?></option>
											<?php
										endwhile;
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Status</label>
									<select class="form-control" name="status">
										<?php

										$petition_status = array('Pending', 'Approved', 'Declined');

										foreach($petition_status as $value): ?>
											<option value="<?php echo $value ?>" <?php if($row['status'] == $value) { echo 'selected'; } ?>><?php echo $value ?></option>
											<?php
										endforeach;
										?>
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit" name="edit_petition">Update</button>
									<a class="btn btn-danger" href="index.php?menu=petition_list">Cancel</a>
								</div>
							</form>
							<?php
						endwhile;
					endif;
				endif;
				?>
			</div>
		</div>
	</div>
</div>
