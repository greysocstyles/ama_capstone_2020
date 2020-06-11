<?php

if (isset($_POST['add_prerequisite']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$curriculum_subj_id = $_POST['curriculum_subj_id'];
	$curriculum_id = $_POST['curriculum_id'];
	$prerequisite_subject = $_POST['prerequisite_subject'];

	$insert_values = array();
	$prerequisite_count = count($prerequisite_subject);

	for ($i = 0; $i < $prerequisite_count; $i++) {
		$insert_values[] = "('$curriculum_subj_id', '$prerequisite_subject[$i]')";
	}

	$sql = "INSERT INTO curriculum_subj_prereq (curriculum_subj_id, preq_subj_id) VALUES";
	$insert_prerequisite = multiple_insert($sql, $insert_values);

	if ($insert_prerequisite) {
		$_SESSION['msg'] = 'Prerequisite has been added.';
		$_SESSION['alert'] = 'alert-success';
		header('location: index.php?view=curriculum_subject&view_id=' . $curriculum_id);
		exit;
	}
}
