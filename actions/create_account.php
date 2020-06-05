<?php 

if (isset($_POST['create_account']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$account_type = $_POST['select_account_type'];
	$password = $_POST['password'];

	if ($account_type == 'Admin') {
		$name = $_POST['name'];
		$username = $_POST['username'];

		if (empty($name) || empty($username) ||empty($password)) {
			$msg = 'Please fill in required fields.';
			$alert_class = 'alert-warning';

		} elseif (!preg_match("/[a-zA-Z\s]+/", $name)) {
				  	$msg = 'Invalid Name.';
				 	$alert_class = 'alert-danger';

		} elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/", $username)) {
					$msg = 'Invalid Username.';
				 	$alert_class = 'alert-danger';

		} elseif (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
					$msg = 'Invalid Password.';
				  	$alert_class = 'alert-danger';
		} else {
				$insert_account_ad = query("insert into account_list (account_type, name, username, password) 
									 	 	values ('$account_type', '$name', '$username', '$password')");
				if ($insert_account_ad) {
					header('location: index.php?menu=account_list');
					exit;
				}
		}

	} elseif ($account_type == 'Student') {
			 $usn = $_POST['usn'];

			 if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
				 $msg = 'Invalid Password.';
				 $alert_class = 'alert-danger';

			} else {
					$insert_account_st = query("insert into account_list (account_type, student_id, password) 
										 	 	values ('$account_type', '$usn', '$password')");
					if ($insert_account_st) {
						header('location: index.php?menu=account_list');
						exit;
					} 
			}
	}

}
