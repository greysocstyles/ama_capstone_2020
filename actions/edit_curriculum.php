<?php

if(isset($_POST['edit_curriculum']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$edit_id = $_POST['edit_id'];
		$degree_name = $_POST['degree_name'];
		$curriculum_year = $_POST['curriculum_year'];

		if (empty($degree_name) || empty($curriculum_year)) {
			$msg = 'Please fill in empty fields.';
			$alert_class = 'alert-danger';

		} elseif (!preg_match('/([0-9])(-)([0-9]*$)/', $curriculum_year)) {
			$msg = 'Invalid curriculum year.';
			$alert_class = 'alert-danger';

		} else {

				$select_curriculum = query("select  degree_id
												,	curriculum_year
										   from curriculum_list
										   where degree_id = '$degree_name'
										   and curriculum_year = '$curriculum_year'");

				if($select_curriculum) {
						$row_count = mysqli_num_rows($select_curriculum);

						if($row_count > 0) {
								$msg = 'curriculum already exist';
								$alert_class = 'alert-danger';

						} else {
								$update_curriculum = query("update curriculum_list
															set curriculum_year = '$curriculum_year'
															,	degree_id = '$degree_name'
															where id = '$edit_id'");
								if($update_curriculum) {
										$_SESSION['msg'] = 'Edit Success!';
										$_SESSION['alert'] = 'alert-info';
										header('Location: index.php?menu=curriculum_list');
										exit;
								}
						}
				}
		}
}
