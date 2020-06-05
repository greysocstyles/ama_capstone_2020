<?php 

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) && empty($password)) {
		$msg = 'Please fill in empty fields.';
		$alert_class = 'alert-warning';
	} elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/", $username) {
				$msg = 'Invalid Username.';
				$alert_class = 'alert-warning';
	} elseif (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password) {
				$msg = 'Invalid Password.';
				$alert_class = 'alert-warning';
	} else {
			$select_exist = query(" select al.username
										 , al.password
										 , al.account_type
										 , sl.usn 
									from account_list al
									inner join student_list sl 
												on al.student_id = sl.id 
									where al.username = '$username' or sl.usn = '$username' 
									and al.password = '$password'");
			if ($select_exist){
				$row_count = mysqli_num_rows($select_exist);

				if ($row_count == 1) {
					while ($row = mysqli_fetch_assoc($select_exist)) {
							$account_type = $row['account_type'];
							$usn = $row['usn'];	
					}
					if ($account_type == 'Admin') {
						$_SESSION['username'] = $username;
						$_SESSION['account_type'] = $account_type;
					} elseif ($account_type == 'Student') {
						$_SESSION['username'] = $usn;
						$_SESSION['account_type'] = $account_type;
					}
				}
			}

	}
}