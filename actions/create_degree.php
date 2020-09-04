<?php

if (isset($_POST['create_degree']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$degree_name = strtoupper($_POST['degree_name']);
	$degree_desc = strtoupper($_POST['degree_desc']);

	if (empty($degree_name) or empty($degree_desc)) {
		$msg = 'Please fill in empty field.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[a-zA-Z\s]+$/i", $degree_name)) {
		$msg = 'Invalid characters on Degree Name.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[a-zA-Z\s]+$/i", $degree_desc)) {
		$msg = 'Invalid characters on Degree Description.';
		$alert_class = 'alert-danger';

	} else {
		$select_exist = query("	select degree_name
									  , degree_desc
								from degree_list
								where degree_name='$degree_name'
								and degree_desc='$degree_desc'
							");

		$row_count = mysqli_num_rows($result);

		if ($row_count > 0) {
			$msg = 'Degree already exists.';
			$alert_class = 'alert-warning';

		} else {
			$insert_degree = query("INSERT into degree_list (degree_name, degree_desc) values ('$degree_name', '$degree_desc')");

			if ($insert_degree) {
				$_SESSION['msg'] = 'Create Success!';
				$_SESSION['alert'] = 'alert-success';
				header('Location: index.php?menu=degree_list');
				exit;
			}
		}
	}
}
