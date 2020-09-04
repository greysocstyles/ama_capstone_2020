<?php 

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = escape(stripslashes($_POST['username']));
	$password = escape(stripslashes($_POST['password']));

	if (empty($username) && empty($password)) {
		echo "Please fill in required fields.";

	} else {
			$select_exist = query("select al.student_id
										, al.account_type
										, al.username
										, al.password 
										, sl.usn
										, sl.name
									from account_list al
									left join student_list sl 
												on al.student_id = sl.id
									where al.username = '$username'
									and al.password = '$password'");
			if ($select_exist) {
				$row_count = mysqli_num_rows($select_exist);

				if ($row_count == 1) {
					while ($row = mysqli_fetch_assoc($select_exist)) {
							$account_type = $row['account_type'];
							$name = $row['name'];
							$id = $row['student_id'];
							$username = $row['username'];
							$usn = $row['usn'];
					}
					if ($account_type == 'Admin') {
						$_SESSION['username'] = $username;
						$_SESSION['account_type'] = $account_type;
						header('location: index.php');
						exit;

					} elseif ($account_type == 'Student') {
						$_SESSION['student_id'] = $id;
						$_SESSION['student_name'] = $name;
						$_SESSION['account_type'] = $account_type;
						header('location: index.php');
						exit;
	
					} else {
							echo "Login failed.";
					}
					
				} else {
						echo "Login failed.";
				}

			} else {
					echo "Login failed.";
			}

	}
}