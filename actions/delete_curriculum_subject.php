<?php

if (isset($_POST['delete_curriculum_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$delete_id = $_POST['delete_id'];
		$curriculum_id = $_POST['curriculum_id'];
		$delete_curri_subj = query("delete from curriculum_subject where id = '$delete_id'");

		if ($delete_curri_subj) {
			$_SESSION['msg'] = 'Curriculum Subject has been deleted.';
			$_SESSION['alert']= 'alert-danger';
			header('location: index.php?view=curriculum_subject&view_id=' . $curriculum_id);
			exit;
		}

}
