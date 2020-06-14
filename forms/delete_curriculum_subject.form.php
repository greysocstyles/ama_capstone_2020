<?php require_once 'actions/delete_curriculum_subject.php'; ?>
<?php

if (isset($_GET['delete_id'])) {
	$delete_id = $_GET['delete_id'];
	$select_csl = query("select  cs.id
							 ,	 sl.subject_code
							 , 	 cs.curriculum_id
						from curriculum_subject cs
						inner join subject_list sl
									on cs.subject_id = sl.id
						where cs.id = '$delete_id'");

	if ($select_csl) {
		$curriculum_subject_list = array();
		while ($row = mysqli_fetch_assoc($select_csl)) {
				$curriculum_subject_list[] = $row;
				$curriculum_id = $row['curriculum_id'];
		}
	}

}
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
  <li class="breadcrumb-item"><a href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Curriculum Subject List</a></li>
  <li class="breadcrumb-item">Delete Curriculum Subject</li>
</ol>
<?php

if (isset($curriculum_subject_list)):
	foreach ($curriculum_subject_list as $row):
			?>
			<div class="card">
				<div class="card-body">
					<form action="index.php?delete=curriculum_subject&delete_id=<?php echo $row['id'] ?>" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<input type="hidden" name="curriculum_id" value="<?php echo $row['curriculum_id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to delete <strong class="text-danger"><?php echo $row['subject_code'] ?></strong>?</p>
							<button class="btn btn-danger" type="submit" name="delete_curriculum_subject">Yes</button>
							<a class="btn btn-secondary" href="index.php?view=curriculum_subject&view_id=<?php echo $row['curriculum_id'] ?>">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
	endforeach;
endif;
?>
