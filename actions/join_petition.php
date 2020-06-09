<?php 

if (isset($_POST['join_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$student_id = $_POST['student_id'];
	$petition_id = $_POST['petition_id'];
	$select_exist = query("select student_id from request_to_open_student_list where req_to_open_id = '$petition_id' and student_id = '$student_id'");
	if ($select_exist) {
		$row_count = mysqli_num_rows($select_exist);

		if ($row_count > 0) {
			header('location: index.php?v=ps&v_id=' . $petition_id);
			exit;

		} else {
				$insert_student = query("insert into request_to_open_student_list (req_to_open_id, student_id) 
										 values ('$petition_id', '$student_id')");
				if ($insert_student) {
					header('location: index.php?v=ps&v_id=' . $petition_id);
					exit;
				}
		}
	}
}