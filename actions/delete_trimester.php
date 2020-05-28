<?php


if (isset($_POST['delete_trimester']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		 $delete_id = $_POST['delete_id'];
		 $delete_trimester = query("delete from trimester_list where id = '$delete_id'");

		if ($delete_trimester) {
			$_SESSION['msg'] = 'Trimester has been deleted.';
			$_SESSION['alert'] = 'alert-danger';
			header('Location: index.php?menu=trimester_list');
			exit;
		}

}
