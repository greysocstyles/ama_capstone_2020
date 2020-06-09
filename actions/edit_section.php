<?php

if(isset($_POST['edit_section']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$edit_id = $_POST['edit_id'];
		$section_code = strtoupper($_POST['section_code']);

		if(empty($section_code)) {
				$msg = 'Please fill in all required fields.';
				$alert_class = 'alert-danger';

		} elseif(strlen($section_code) < 3) {
				$msg = 'Invalid length.';
				$alert_class = 'alert-danger';

		} elseif(!preg_match("/[a-zA-Z0-9]+/", $section_code)) {
				$msg = 'Invalid Section code.';
				$alert_class = 'alert-danger';

		} else {
				$update_section = query("update section_list set section_code = '$section_code' where id = '$edit_id'");

				if($update_section){
						$_SESSION['msg']= 'Edit Success!';
						$_SESSION['alert'] = 'alert-info';
						header('Location: index.php?menu=section_list');
						exit;
				}
		}

}
