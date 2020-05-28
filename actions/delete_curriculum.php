<?php

if(isset($_POST['delete_curriculum']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$delete_id = $_POST['delete_id'];
		$delete_curriculum = query("delete from curriculum_list where id = '$delete_id'");

		if ($delete_curriculum) {
			$_SESSION['msg'] = 'Curriculum has been deleted.';
			$_SESSION['alert'] = 'alert-danger';
			header('location: index.php?menu=curriculum_list');
			exit;
		}

}
