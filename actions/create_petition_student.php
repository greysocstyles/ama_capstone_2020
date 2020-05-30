<?php


if(isset($_POST['add_petition_student']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$petition_subject_id = $_POST['petition_subject_id'];
		$petition_student_id = $_POST['petition_student_id'];

		if(empty($petition_subject_id) || empty($petition_student_id)) {
				 $msg = 'Please fill in all required fields.';
				 $alert_class = 'alert-warning';

		} else {

				$select_exist = query("select sl.name
									from request_to_open_student_list rtos
									inner join student_list sl
											on rtos.student_id = sl.id
									where req_to_open_id = '$petition_subject_id'
									and student_id = '$petition_student_id'");
				if($select_exist) {
						$row_count = mysqli_num_rows($select_exist);

						if ($row_count > 0) {
							$student_exist = array();
							while($row = mysqli_fetch_assoc($select_exist)) {
									$student_exist[] = $row;
							}

						} else {
								$insert_petition_student = query("insert into request_to_open_student_list (req_to_open_id, student_id)
																  values ('$petition_subject_id', '$petition_student_id')");
								if ($insert_petition_student) {
									$_SESSION['msg'] = 'Create Success!';
									$_SESSION['alert'] = 'alert-success';
									header('Location: index.php?view=petition_student&view_id=' . $petition_subject_id);
									exit;
								}
						}

				}

		}

}
