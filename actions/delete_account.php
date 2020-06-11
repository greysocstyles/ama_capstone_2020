<?php

if (isset($_POST['delete_account']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$delete_id = $_POST['delete_id'];
	$delete_account = query("delete from account_list where id = '$delete_id'");
	
	if ($delete_account) {
		header('Location: index.php?menu=account_list');
		exit;
	}
}
