<?php 

if (isset($_POST['edit_account']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$edit_id = $_POST['edit_id'];
	$z = query("select account_type from account_list where id = '$edit_id'");
	if ($z) {
		while ($row = mysqli_fetch_assoc($z)) {
			  $account_type	= $row['account_type'];
		}
		if ($account_type == 'Admin') {
			$name = $_POST['name'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$result = query ("update account_list set 
							  name = '$name'
							  , username = '$username'
							  ,	password = '$password'
							  where id = '$edit_id'");
			if ($result) {
				header('location: index.php?menu=account_list');
				exit;
			}

		} elseif ($account_type == 'Student') {
			$password = $_POST['password'];
			$result2 = query("update account_list set 
							  password = '$password'
							  where id = '$edit_id'");
			if ($result2) {
				header('location: index.php?menu=account_list');
				exit;
			}
		}
	}
}