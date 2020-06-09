<?php require_once 'actions/create_curriculum_subject.php'; ?>
<?php
if(isset($msg) && isset($alert_class)): ?>
	<div class="alert alert-dismissible <?php echo $alert_class ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $msg ?></strong>
	</div>
	<?php
endif;
?>
<?php

if (isset($_GET['curriculum_id'])) {
	$curriculum_id = $_GET['curriculum_id'];
	$select_subject = query("SELECT   sl.id
									, sl.subject_code
							 FROM subject_list sl
							 WHERE NOT EXISTS (SELECT cs.subject_id
												FROM curriculum_subject cs
												WHERE cs.subject_id = sl.id
												and cs.curriculum_id = '$curriculum_id')");

	if ($select_subject) {
		$subject_list = array();
		while ($row = mysqli_fetch_assoc($select_subject)) {
				$subject_list[] = $row;

		}
	}
}
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
  <li class="breadcrumb-item"><a href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Curriculum Subject List</a></li>
  <li class="breadcrumb-item">New Curriculum Subject</li>
</ol>
<div class="card">
	<div class="card-body">
		<form action="index.php?new=curriculum_subject&curriculum_id=<?php echo $curriculum_id ?>" method="POST">
			<div class="form-row">
				<div class="form-group col-md-8">
					<h2>New Curriculum Subject</h2>
				</div>
				<div class="form-group col-md-4">
					<label for="num_of_curri_subj"></label>
					<input class="form-control-sm" id="num_of_curri_subj" name="num_of_curri_subj" type="number" min="1" max="10" value="<?php echo isset($_POST['num_of_curri_subj']) ? $_POST['num_of_curri_subj'] : 1 ?>">
					<button class="btn btn-secondary" type="submit">Go</button>
				</div>
			</div>
			<div class="form-row">
				<input type="hidden" name="curriculum_id" value="<?php echo $curriculum_id ?>">
				<div class="form-group col-md-4">
					<select class="form-control" name="curriculum_subj[]">
						<option value=""> Select Subject </option>
						<?php

						if(isset($subject_list)):
							foreach($subject_list as $row):
								?>
								<option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['curriculum_subj'][0]) && $_POST['curriculum_subj'][0] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
								<?php
							endforeach;
						endif;
						?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<input class="form-control" name="year[]" type="text" placeholder="Year" value="<?php if(isset($_POST['year'][0])) echo $_POST['year'][0] ?>">
				</div>
				<div class="form-group col-md-4">
					<input class="form-control" name="trimester[]" type="text" placeholder="Trimester" value="<?php if(isset($_POST['trimester'][0])) echo $_POST['trimester'][0] ?>">
				</div>
			</div>
			<?php

			if(isset($_POST['num_of_curri_subj'])):
				for($i = 1; $i < $_POST['num_of_curri_subj']; $i++):
					?>
					<div class="form-row">
						<div class="form-group col-md-4">
							<select class="form-control" name="curriculum_subj[]">
								<option value=""> Select Subject </option>
								<?php

								if(isset($subject_list)):
									foreach($subject_list as $row):
										?>
										<option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['curriculum_subj'][$i]) && $_POST['curriculum_subj'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
										<?php
									endforeach;
								endif;
								?>
							</select>
						</div>
						<div class="form-group col-md-4">
							<input class="form-control" name="year[]" type="text" placeholder="Year" value="<?php if(isset($_POST['year'][$i])) echo $_POST['year'][$i] ?>">
						</div>
						<div class="form-group col-md-4">
							<input class="form-control" name="trimester[]" type="text" placeholder="Trimester" value="<?php if(isset($_POST['trimester'][$i])) echo $_POST['trimester'][$i] ?>">
						</div>
					</div>
					<?php
				endfor;
			endif;
			?>
			<div class="form-row">
				<div class="form-group col-md-4">
					<button class="btn btn-primary" name="create_curriculum_subject" type="submit">Create</button>
					<a class="btn btn-danger" href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
