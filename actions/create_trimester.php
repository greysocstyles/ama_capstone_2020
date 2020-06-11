<?php

if (isset($_POST['create_trimester']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$year = $_POST['year'];
	$trimester = $_POST['trimester'];

	if (empty($year) || empty($trimester)) {
		$msg = 'Please fill in required fields.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[1-9]*$/", $year) || $year > 4 || $year <= 0) {
		$msg = 'Invalid year, 1-4 only.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[1-9]*$/", $trimester) || $trimester > 3 || $trimester <= 0) {
		$msg = 'Invalid trimester, 1-3 only.';
		$alert_class = 'alert-danger';

	} else {
		$select_exist = query("	select year
									,  trimester
								from trimester_list
								where year = '$year'
								and trimester = '$trimester'
							");

		if ($select_exist) {
			$row_count = mysqli_num_rows($select_exist);

			if ($row_count > 0) {
				$trimester_exist = array();
				while ($row = mysqli_fetch_assoc($select_exist)) {
					$trimester_exist[] = $row;
				}
			} else {
				$insert_trimester = query("insert into trimester_list (year, trimester) values ('$year', '$trimester')");

				if ($insert_trimester) {
					$_SESSION['msg'] = 'Create Success!';
					$_SESSION['alert'] = 'alert-success';
					header('Location: index.php?menu=trimester_list');
					exit;
				}
			}
		}
	}
}
