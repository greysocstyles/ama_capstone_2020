<?php

if (isset($_POST['create_section']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$section = strtoupper($_POST['section_code']);
	$degree_id = $_POST['degree_id'];

	if (empty($section) || empty($degree_id)) {
		$msg = 'Please fill in all required fields.';
		$alert_class = 'alert-warning';

	} elseif (!preg_match('/[a-zA-Z0-9]{4,}+/', $section)) {
		$msg = 'Invalid Section code.';
		$alert_class = 'alert-danger';

	} else {
		$select_exist = query("	select s.section_code
									, 	dl.degree_name
								from section_list s
								inner join degree_list dl
											on s.degree_id = dl.id
								where s.section_code = '$section'
								and s.degree_id = '$degree_id'
							");

		if ($select_exist) {
			$row_count = mysqli_num_rows($select_exist);

			if ($row_count > 0) {
				$section_exist = array();
				while ($row = mysqli_fetch_assoc($select_exist)) {
					$section_exist[] = $row;
				}

			} else {
				$insert_section = query("insert into section_list (section_code, degree_id) values('$section',  '$degree_id')");
				
				if ($insert_section) {
					$_SESSION['msg'] = 'Create Success!';
					$_SESSION['alert'] = 'alert-success';
					header('Location: index.php?menu=section_list');
					exit;
				}
			}
		}
	}
}
