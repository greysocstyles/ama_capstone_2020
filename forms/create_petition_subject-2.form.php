<?php require_once 'actions/create_petition_subject-2.php'; ?>

<form action="index.php?c=cp" method="POST">
	<div class="row">
		<div class="col-md-8 m-auto">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<h3>Create Petition</h3>
					</div>
					<div class="form-group">
						<label>Select Subject</label>
						<select class="form-control" name="petition_subject">
							<?php 
							$subject_list = query("select id, subject_code from subject_list where subject_status = 0"); 
							if ($subject_list):
								while ($row = mysqli_fetch_assoc($subject_list)):
									  ?>
									  <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['petition_subject']) && $_POST['petition_subject'] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
									  <?php 
								endwhile;
							endif;
							?>
						</select>
					</div>
					<div class="form-group">
						<?php 
						if (isset($petition_exist)):
							echo 'Petition Exist: ';
							foreach ($petition_exist as $value):
									?>
									<strong class="text-danger"><?php echo implode($value) ?></strong>
									<?php
							endforeach;
						endif; 
						?>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" name="create_petition">Submit</button>
						<a class="btn btn-danger" href="index.php?m=pl">Cancel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>