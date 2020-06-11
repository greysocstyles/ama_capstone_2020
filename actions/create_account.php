<?php

if (isset($_POST['create_account']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$account_type = $_POST['select_account_type'];
	$password = $_POST['password'];

	if ($account_type == 'Admin') {
		$name = $_POST['name'];
		$username = $_POST['username'];

		if (empty($name) || empty($username) || empty($password)) {
			$msg = 'Please fill in required fields.';
			$alert_class = 'alert-warning';

		} elseif (!preg_match("/[a-zA-Z\s]+/", $name)) {
			$msg = 'Invalid Name.';
			$alert_class = 'alert-danger';

		} elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$/", $username)) {
			$msg = 'Invalid Username.';
			$alert_class = 'alert-danger';

		} elseif (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,26}$/", $password)) {
			$msg = 'Invalid Password, must contain atleast 1 or more numerical digits';
			$alert_class = 'alert-danger';

		} else {
			$select_username = query("select username from account_list where username = '$username'");

			if ($select_username) {
				$username_count = mysqli_num_rows($select_username);

				if ($username_count > 0) {
					$username_exist = array();
					while ($row = mysqli_fetch_assoc($select_username)) {
						$username_exist[] = $row;
					}
				} else {
					$insert_account_ad = query("insert into account_list (
													  account_type
													, name
													, username
													, password
												) 
											 	values (
											 		  '$account_type'
											 		, '$name'
											 		, '$username'
											 		, '$password'
											 	)");

					if ($insert_account_ad) {
						header('location: index.php?menu=account_list');
						exit;
					}
				}
			}
		}

	} elseif ($account_type == 'Student') {
		$student_id = $_POST['student_id'];

		if (empty($password)) {
			$msg = 'Please fill in empty fields.';
			$alert_class = 'alert-warning';

		} elseif (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,26}$/", $password)) {
			$msg = 'Invalid Password, must contain atleast 1 or more numerical digits';
			$alert_class = 'alert-danger';

		} else {
			$select_student = query("	
										select  sl.usn 
		 	 								,	sl.name	
		 	 		 					from 	account_list al
		 	 		 					inner 	join student_list sl 
		 	 		 							on al.student_id = sl.id
		 	 		 					where 	al.student_id = '$student_id'
		 	 		 				");

			if ($select_student) {
				$student_count = mysqli_num_rows($select_student);

				if ($student_count > 0) {
					$student_exist = array();
					while ($row = mysqli_fetch_assoc($select_student)) {
						$student_exist[] = $row;
					}

				} else {
					$x = query("select usn, name from student_list where id = '$student_id'");

					if ($x) {
						while ($row = mysqli_fetch_assoc($x)) {
							$usn = $row['usn'];
							$student_name = $row['name'];
						}
						$insert_account_st = query("	insert into account_list 
														(
															  account_type
															, student_id
															, name
															, username
															, password
														) 
														values 
														(
															  '$account_type'
															, '$student_id'
															, '$student_name'
															, '$usn'
															, '$password'
														)"
													);
						if ($insert_account_st) {
							header('location: index.php?menu=account_list');
							exit;
						}
					}
				}
			}
		}
	}
}
