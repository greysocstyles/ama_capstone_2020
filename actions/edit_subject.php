<?php

if (isset($_POST['edit_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$edit_id = $_POST['edit_id'];
		$subject_code = $_POST['subject_code'];
		$subject_name = $_POST['subject_name'];
		$subject_desc = $_POST['subject_desc'];
		$subject_status = $_POST['subject_status'];
		$lec_unit = $_POST['lec_unit'];
		$lab_unit = $_POST['lab_unit'];

		if (empty($subject_code) || empty($subject_name) || empty($subject_desc || empty($subject_status))) {
			$msg = 'please fill in required fields.';
			$alert_class = 'alert-warning';

		} elseif (!preg_match('/([a-zA-Z])( )([1-9][0-9]*$)/', $subject_code)) {
				$msg = 'Invalid Subject Code Format.';
				$alert_class = 'alert-danger';

		} elseif (!preg_match('/([1-9])/', $lec_unit)) {
				$msg = 'Invalid Lec unit, 1-9 only.';
				$alert_class = 'alert-warning';

		} elseif (!preg_match('/([0-9])/', $lab_unit)) {
				$msg = 'Invalid Lab unit, 1-9 only.';
				$alert_class = 'alert-warning';

		} else {

				$update_subject = query("UPDATE subject_list SET
												subject_code = '$subject_code'
											, 	subject_name = '$subject_name'
											, 	subject_desc = '$subject_desc'
											, 	subject_status = '$subject_status'
											, 	lec_unit = '$lec_unit'
											, 	lab_unit = '$lab_unit'
										where 	id = '$edit_id'");

				if ($update_subject) {
					$_SESSION['msg'] = 'Edit Success!';
					$_SESSION['alert']= 'alert-info';
					header('Location: index.php?menu=subject_list');
					exit;
					
				} else {
				        $select_exist = query("select subject_code from subject_list where subject_code = '$subject_code'");
				        
				        if ($select_exist) {
				            $subject_exist = array();
				            while ($row = mysqli_fetch_assoc($select_exist)) {
				                  $subject_exist[] = $row;
				            }    
				        }
				}


		}
}
