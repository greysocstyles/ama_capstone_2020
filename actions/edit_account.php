<?php

if (isset($_POST['edit_account']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$edit_id = $_POST['edit_id'];
	$z = query("select account_type from account_list where id = '$edit_id'");
	if ($z) {
		while ($row = mysqli_fetch_assoc($z)) {
			$account_type = $row['account_type'];
		}

		if ($account_type == 'Admin') {
			$name = $_POST['name'];
			$username = $_POST['username'];
			$password = $_POST['password'];

			if (empty($name) || empty($username) || empty($password)) {
				$msg = 'Please fill in required fields.';
				$alert_class = 'alert-warning';

			} elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$/", $username)) {
				$msg = 'Invalid username 8 - 20 characters only.';
				$alert_class = 'alert-warning';

			} elseif (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,26}$/", $password)) {
				$msg = 'Invalid Password, 8-26 characters only and must contain atleast 1 or more numerical digits.';
				$alert_class = 'alert-warning';

			} else {
				$update_admin = query("	update account_list 
										set name = '$name'
										, username = '$username'
									  	,	password = '$password'
										where id = '$edit_id'
									");
				
				if ($update_admin ) {
					header('location: index.php?menu=account_list');
					exit;
				}
			}

		} elseif ($account_type == 'Student') {
			$password = $_POST['password'];

			if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,26}$/", $password)) {
				$msg = 'Invalid Password, 8-26 characters only and must contain atleast 1 or more numerical digits.';
				$alert_class = 'alert-warning';

			} else {
				$update_student = query("	update account_list set 
											password = '$password'
											where id = '$edit_id' ");
				
				if ($update_student) {
					header('location: index.php?menu=account_list');
					exit;
				}
			}
		}
	}
}
