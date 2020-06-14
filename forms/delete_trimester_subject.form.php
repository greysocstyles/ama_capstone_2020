<?php require_once 'actions/delete_trimester_subject.php'; ?>

<?php

if (isset($_GET['delete_id'])) {
	$delete_id = $_GET['delete_id'];
	$select_tsl = query("SELECT    tsl.id
					             , tsl.trimester_id
					             , sl.subject_code
					             , s.section_code
					    FROM trimester_subject_list tsl
					    INNER JOIN subject_list sl ON
					               tsl.subject_id = sl.id
					    INNER JOIN section_list s ON
					               tsl.section_id = s.id
					    where tsl.id = '$delete_id'");

	if ($select_tsl) {
		$trimester_subject_list = array();
		while ($row = mysqli_fetch_assoc($select_tsl)) {
				$trimester_subject_list[] = $row;
				$trimester_id = $row['trimester_id'];
		}
	}
}

?>
<ol class="breadcrumb">
  	<li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
	<li class="breadcrumb-item"><a href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Trimester Subject List</a></li>
  	<li class="breadcrumb-item active">Delete Trimester Subject</li>
</ol>
<?php

if(isset($trimester_subject_list)):
	foreach($trimester_subject_list as $row):
			?>
			<div class="card">
				<div class="card-body">
					<form action="index.php?delete=trimester_subject" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<input type="hidden" name="trimester_id" value="<?php echo $row['trimester_id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['subject_code'] . ', ' . $row['section_code'] ?></strong>?</p>
							<button class="btn btn-danger" type="submit" name="delete_trimester_subject">Yes</button>
							<a class="btn btn-secondary" href="index.php?view=trimester_subject&view_id=<?php echo $row['trimester_id'] ?>">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
	endforeach;
endif;
?>
