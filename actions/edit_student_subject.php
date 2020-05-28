<?php

if (isset($_POST['edit_student_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		 $edit_id = $_POST['edit_id'];
		 $student_id = $_POST['student_id'];
		 $grade = $_POST['grade'];
		 $add_info = $_POST['add_info'];
		 $grade_status = grade_status($grade);

		 $update_subject = query("update student_subject_list
									set grade = '$grade'
									, status = '$grade_status'
									, add_info = '$add_info'
									where id = '$edit_id'");
		if ($update_subject) {
			$_SESSION['msg'] = 'Edit Success!';
			$_SESSION['alert'] = 'alert-info';
			header('Location: index.php?view=student_subject&view_id=' . $student_id);
			exit;
		}

}
