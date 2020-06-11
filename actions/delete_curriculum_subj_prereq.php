<?php

if (isset($_POST['delete_subj_prereq']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$curriculum_subj_id = $_POST['curriculum_subj_id'];
	$delete_curri_subj_prereq = query("delete from curriculum_subj_prereq where id = '$delete_id'");

	if ($delete_curri_subj_prereq) {
		$_SESSION['msg'] = 'Prerequisite has been deleted.';
		$_SESSION['alert'] = 'alert-danger';
		header('location: index.php?edit=prerequisite_subject&edit_id=' . $curriculum_subj_id);
		exit;
	}
}
