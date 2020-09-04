<?php

if (isset($_POST['create_student']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$usn = $_POST['usn'];
	$name = $_POST['name'];
	$curriculum = $_POST['curriculum'];

	$insert_values = array();
	$filter_values = array();
	$student_count = count($usn);

	for ($i = 0; $i < $student_count; $i++) {

		if (empty($usn[$i]) || empty($name[$i]) || empty($curriculum[$i])) {
			$msg = 'Please fill in empty fields.';
			$alert_class = 'alert-warning';
			break;

		} elseif (!preg_match("/^[1-9][0-9]{10,13}$/", $usn[$i])) {
			$msg = 'Invalid USN.';
			$alert_class = 'alert-danger';
			break;

		} elseif (!preg_match("/^[a-zA-Z\s]{6,50}+$/i", $name[$i])) {
			$msg = 'Invalid Name, 6 or more characters.';
			$alert_class = 'alert-warning';
			break;

		} else {
			$insert_values[] = "('$usn[$i]', '$name[$i]', '$curriculum[$i]')";
			$filter_values[] = "usn = '$usn[$i]'";
		}

	}


	$insert_values_count = count($insert_values);


	if ($insert_values_count == $student_count) {
		$sql = 'select usn, name from student_list where ';
		$sql .= implode(" or ", $filter_values);
		$select_exist = query($sql);

		if ($select_exist) {
			$row_count = mysqli_num_rows($select_exist);

			if ($row_count > 0) {
				$student_exist = array();
				while ($row = mysqli_fetch_assoc($select_exist)) {
					$student_exist[] = $row;
				}
				
			} else {
				$insert_header = "insert into student_list (usn, name, curriculum_id) values ";
				$insert_values = array_map('strtoupper', $insert_values);
				$insert_student = multiple_insert($insert_header, $insert_values);

				if ($insert_student) {
					$_SESSION['msg'] = 'Create Success!';
					$_SESSION['alert'] = 'alert-success';
					header('Location: index.php?menu=student_list');
					exit;
				}
			}
		}
	}
}
