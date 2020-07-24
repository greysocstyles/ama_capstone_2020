<?php

if (isset($_POST['create_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$code = $_POST['subject_code'];
	$name = $_POST['subject_name'];
	$desc = $_POST['subject_desc'];
	$status = $_POST['subject_status'];
	$lec = $_POST['lec_unit'];
	$lab = $_POST['lab_unit'];
	$insert_values = array();
	$filter_values = array();
	$subject_count = count($code);

	for ($i = 0; $i < $subject_count; $i++) {

		if (empty($code[$i]) || empty($name[$i]) || empty($desc[$i])) {
			$msg = 'Please fill in all required fields.';
			$alert_class = 'alert-warning';
			break;

		} elseif (!preg_match('/([a-zA-Z])( )([0-9]*$)/', $code[$i])) {
			$msg = 'Invalid Subject Code Format.';
			$alert_class = 'alert-danger';
			break;

		} elseif (!preg_match('/[a-zA-Z0-9]+/', $name[$i])) {
			$msg = 'Invalid Subject Name.';
			$alert_class = 'alert-danger';
			break;

		} elseif (!preg_match('/[a-zA-Z0-9]+/', $desc[$i])) {
			$msg = 'Invalid Subject Description.';
			$alert_class = 'alert-danger';
			break;

		} elseif (!preg_match('/([1-9])/', $lec[$i])) {
			$msg = 'Invalid Lec unit, 1-9 only.';
			$alert_class = 'alert-danger';
			break;

		} elseif (!preg_match('/([0-9])/', $lab[$i])) {
			$msg = 'Invalid Lab unit, 0-9 only.';
			$alert_class = 'alert-danger';
			break;

		} else {
			$insert_values[] = "(		'$code[$i]'
									, 	'$name[$i]'
									, 	'$desc[$i]'
									, 	'$status[$i]'
									, 	'$lec[$i]'
									, 	'$lab[$i]'
								)";

			$filter_values[] = "subject_code = '$code[$i]'";
		}
	}

	$insert_values_count = count($insert_values);

	if ($insert_values_count == $subject_count) {
		$sql = "select subject_code from subject_list where ";
		$sql .= implode(" or ", $filter_values);
		$select_exist = query($sql);

		if ($select_exist) {
			$row_count = mysqli_num_rows($select_exist);

			if ($row_count > 0) {
				$subj_exists = array();
				while ($row = mysqli_fetch_assoc($select_exist)) {
					$subj_exists[] = $row;
				}
			} else {
				$insert_header = "	INSERT into subject_list
									(
											subject_code
										, 	subject_name
										, 	subject_desc
										, 	subject_status
										, 	lec_unit
										, 	lab_unit
									)
									VALUES
								";

				$insert_values = array_map("strtoupper", $insert_values);
				$insert_values = array_map("trim", $insert_values);
				$insert_subject = multiple_insert($insert_header, $insert_values);

				if ($insert_subject) {
					$_SESSION['msg'] = 'Create Success!';
					$_SESSION['alert'] = 'alert-success';
					header('Location: index.php?menu=subject_list');
					exit;
				}
			}
		}
	}
}
