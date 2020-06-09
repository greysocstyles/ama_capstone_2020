<?php

if(isset($_POST['create_trimester_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$trimester_id = $_POST['trimester_id'];
		$subject = $_POST['subject'];
	  	$section = $_POST['section'];
		$room = $_POST['room'];
		$days = $_POST['days'];
		$time = $_POST['time'];
		$professor = $_POST['professor'];
		$insert_values = array();
		$filter_values = array();
		$tri_subject_count = count($subject);

		for($i = 0; $i < $tri_subject_count; $i++) {

			if(empty($subject[$i]) || empty($section[$i]) || empty($days[$i]) || empty($time[$i])) {
					 $msg = 'Please fill in empty fields.';
					 $alert_class = 'alert-warning';
					 break;

			} else {
					 $insert_values[] = "(	  '$trimester_id'
											, '$subject[$i]'
											, '$section[$i]'
											, '$room[$i]'
											, '$days[$i]'
											, '$time[$i]'
											, '$professor[$i]'
										)";

					 $filter_values[] = "sl.id = '$subject[$i]' and s.id = '$section[$i]'";
			}

		}

		$insert_values_count = count($insert_values);

		if ($insert_values_count == $tri_subject_count) {
			$sql = "select sl.subject_code
						 , s.section_code
					from trimester_subject_list tsl
					inner join subject_list sl
								on tsl.subject_id = sl.id
					inner join section_list s
								on tsl.section_id = s.id
					where tsl.trimester_id = '$trimester_id' and ";

			$sql .= implode(" or ", $filter_values);
			$select_exist = query($sql);

			if ($select_exist){
				$row_count = mysqli_num_rows($select_exist);
				if ($row_count > 0) {
					$trimester_subj_exist = array();
					while ($row = mysqli_fetch_assoc($select_exist)) {
						   $trimester_subj_exist[] = $row;
					}

				} else {
						$insert_header = "INSERT into trimester_subject_list (trimester_id, subject_id, section_id, room, days, time, professor) VALUES";
						$insert_tri_subject = multiple_insert($insert_header, $insert_values);

						if ($insert_tri_subject) {
							$_SESSION['msg'] = 'Create Success!.';
							$_SESSION['alert'] = 'alert-success';
							header('Location: index.php?view=trimester_subject' . '&view_id=' . $trimester_id);
							exit;
						}

				}
			}
		}
}
