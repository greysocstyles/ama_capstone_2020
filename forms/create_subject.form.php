<?php require_once 'actions/create_subject.php'; ?>
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
	<li class="breadcrumb-item active"><a href="index.php?menu=subject_list">Subject List</a></li>
	<li class="breadcrumb-item active">New Subject</li>
</ol>
<div class="card">
	<div class="card-body">
		<form action="index.php?new=subject" method="POST">
			<div class="form-row">
				<div class="form-group col-sm-8">
					<h3>New Subject</h3>
				</div>
				<div class="form-group col-md-4">
					<label for="num_of_subj">No. of Subject</label>
					<input class="form-control-sm" name="num_of_subj" id="num_of_subj" type="number" min="1" max="10" value="<?php echo isset($_POST['num_of_subj']) ? $_POST['num_of_subj'] : 1 ?>">
					<button class="btn btn-secondary" type="submit">Go</button>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
					<input class="form-control" type="text" pattern="([a-zA-Z]+[ ][0-9]+)" title="6 - 11 characters, eq. CS 202" minlength="6" maxlength="11" name="subject_code[]" placeholder="Subject Code" value="<?php if(isset($_POST['subject_code'][0])) echo $_POST['subject_code'][0] ?>">
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5,}" title="5 to 21 characters only." name="subject_name[]" placeholder="Subject Name" value="<?php if(isset($_POST['subject_name'][0])) echo $_POST['subject_name'][0] ?>">
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5,}" title="5 to 21 chracters only." name="subject_desc[]" placeholder="Subject Desc" value="<?php if(isset($_POST['subject_desc'][0])) echo $_POST['subject_desc'][0] ?>">
				</div>
				<div class="form-group col-md-2">
					<select class="form-control" name="subject_status[]">
						<?php

						$z = ['Enable' => 1, 'Disable' => 0];

						foreach($z as $key => $value): ?>
							<option value="<?php echo $value ?>"><?php echo $key ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="number" min="1" max="9" title="1 to 9 lec unit only." name="lec_unit[]" placeholder="Lec Unit" value="<?php if(isset($_POST['lec_unit'][0])) echo $_POST['lec_unit'][0] ?>">
				</div>
				<div class="form-group col-md-2">
					<input class="form-control" type="number" min="0" max="9" title="0 to 9 lab unit only." name="lab_unit[]" placeholder="Lab Unit" value="<?php if(isset($_POST['lab_unit'][0])) echo $_POST['lab_unit'][0] ?>">
				</div>
			</div>
			<?php

			if (isset($_POST['num_of_subj'])):
				for ($i = 1; $i < $_POST['num_of_subj']; $i++):
					?>
					<div class="form-row">
						<div class="form-group col-md-2">
							<input class="form-control" type="text" minlength="6" maxlength="10" title="6 to 10 characters only, ex. cs 101" name="subject_code[]" placeholder="Subject Code" value="<?php if(isset($_POST['subject_code'][$i])) echo $_POST['subject_code'][$i] ?>">
						</div>
						<div class="form-group col-md-2">
							<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5, 21}" title="5 to 21 characters only." name="subject_name[]" placeholder="Subject Name" value="<?php if(isset($_POST['subject_name'][$i])) echo $_POST['subject_name'][$i] ?>">
						</div>
						<div class="form-group col-md-2">
							<input class="form-control" type="text" pattern="[a-zA-Z0-9]+.{5,}" title="5 to 21 chracters only." name="subject_desc[]" placeholder="Subject Desc" value="<?php if(isset($_POST['subject_desc'][$i])) echo $_POST['subject_desc'][$i] ?>">
						</div>
						<div class="form-group col-md-2">
							<select class="form-control" name="subject_status[]">
								<?php

								foreach($z as $key => $value): ?>
									<option value="<?php echo $value ?>"><?php echo $key ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-2">
							<input class="form-control" type="number" min="1" max="9" title="1 to 9 lec unit only." name="lec_unit[]" placeholder="Lec Unit" value="<?php if(isset($_POST['lec_unit'][$i])) echo $_POST['lec_unit'][$i] ?>">
						</div>
						<div class="form-group col-md-2">
							<input class="form-control" type="number" min="0" max="9" title="0 to 9 lab unit only." name="lab_unit[]" placeholder="Lab Unit" value="<?php if(isset($_POST['lab_unit'][$i])) echo $_POST['lab_unit'][$i] ?>">
						</div>
					</div>
					<?php
				endfor;
			endif;
			?>
			<div class="form-group">
				<?php

				if(isset($subj_exists)):
					echo 'Subject Exists: ';
					$k = count($subj_exists);
					for($j = 0; $j < $k; $j++): ?>
						<strong class="text-danger"><?php echo implode(", ", $subj_exists[$j])	. ',' ?></strong>
						<?php
					endfor;
				endif;
				?>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<button class="btn btn-primary" type="submit" name="create_subject">Create</button>&nbsp;
					<a class="btn btn-danger" href="index.php?menu=subject_list">Cancel</a>
				</div>
			</div>
		</form>
	</div>
</div>
