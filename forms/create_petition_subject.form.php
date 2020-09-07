<?php require_once 'actions/create_petition_subject.php'; ?>

<?php 

$petition_subjects = query("select id
								,  subject_code 
							from subject_list 
							where id not in (
								select subject_id
								from request_to_open_list
								where status = 'Pending'
							) 
							and subject_status = 0");

?>

<div class="row">
	<div class="col-md-8 m-auto">
		<!-- alert msg -->
		<?php

		if (isset($msg) && isset($alert_class)) : ?>

			<div class="alert alert-dismissible <?php echo $alert_class?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>

		<?php endif; ?>
		<!-- end of alert msg -->

		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
			<li class="breadcrumb-item active">New Petition</li>
		</ol>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<h3>New Petition</h3>
				</div>
				<form action="index.php?new=petition" method="POST">
					<div class="form-group">
						<label>Subject</label>
						<select class="form-control" name="petition_subject">
							<option value="">Select Subject</option>
							<?php

							if ($petition_subjects) :
								while ($row = mysqli_fetch_assoc($petition_subjects)) : ?>

										<option value="<?php echo $row['id'] ?>"><?php echo $row['subject_code'] ?></option>
										<?php
								endwhile;
							endif;
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Status</label>
						<select class="form-control" name="status">
							<?php

							$petition_status = ['Pending', 'Approved', 'Declined'];

							foreach ($petition_status as $value) : ?>

									<option value="<?php echo $value ?>"><?php echo $value ?></option>
									<?php
							endforeach;
							?>
						</select>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="create_petition_subject">Create</button>
						<a class="btn btn-danger" href="index.php?menu=petition_list">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
