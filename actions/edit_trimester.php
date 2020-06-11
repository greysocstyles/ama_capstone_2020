<?php

if (isset($_POST['edit_trimester']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$edit_id = $_POST['edit_id'];
	$year = $_POST['year'];
	$trimester = $_POST['trimester'];

	if (empty($year) || empty($trimester)) {
		$msg = 'please fill in required field.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[1-9]*$/", $year) || $year > 4 || $year <= 0) {
		$msg = 'Invalid year, 1-4 only.';
		$alert_class = 'alert-danger';

	} elseif (!preg_match("/^[1-9]*$/", $trimester) || $trimester > 3 || $trimester <= 0) {
		$msg = 'Invalid trimester, 1-3 only.';
		$alert_class = 'alert-danger';

	} else {
		$edit_value = query("	select  year
									, 	trimester
								from trimester_list
								where id = '$edit_id'
							");
		if ($edit_value) {
			while ($row = mysqli_fetch_assoc($edit_value)) {
				$e_year = $row['year'];
				$e_trimester = $row['trimester'];
			}
			if ($year == $e_year && $trimester == $e_trimester) {
				header('Location: index.php?menu=trimester_list');
				exit;

			} else {
				$select_exist = query("	select year
    				                         , trimester 
    				                    from trimester_list
    				                    where year = '$year'
    				                    and trimester = '$trimester'
    				                ");

				if ($select_exist) {
					$row_count = mysqli_num_rows($select_exist);

					if ($row_count > 0) {
						$trimester_exist = array();
						while ($rows = mysqli_fetch_assoc($select_exist)) {
							$trimester_exist[] = $rows;
						}

					} else {
						$update_trimester = query("UPDATE trimester_list set year='$year', trimester='$trimester' where id = '$edit_id'");

						if ($update_trimester) {
							$_SESSION['msg'] = 'Edit Success!';
							$_SESSION['alert'] = 'alert-info';
							header('Location: index.php?menu=trimester_list');
							exit;
						}
					}
				}
			}
		}
	}
}

