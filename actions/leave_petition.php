<?php 

if (isset($_POST['leave_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$petition_id = $_POST['petition_id'];
	$student_id = $_POST['student_id'];
	$leave_petition = query("delete from request_to_open_student_list where student_id = '$student_id'");
	if ($leave_petition) {
		header('location: index.php?v=ps&v_id=' . $petition_id);
		exit;
	}
}