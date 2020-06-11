<?php

if (isset($_POST['create_curriculum']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$degree_name = $_POST['degree_name'];
	$curriculum_year = $_POST['curriculum_year'];

	if (empty($degree_name) || empty($curriculum_year)) {
		$msg = 'Please fill in required fields.';
		$alert_class = 'alert-warning';
	} elseif (!preg_match('/([0-9])(-)([0-9]*$)/', $curriculum_year)) {
		$msg = 'Invalid Curriculum Year.';
		$alert_class = 'alert-danger';
	} else {
		$select_exist = query(" select  dl.degree_name
									,	cl.curriculum_year
								from curriculum_list cl
								inner join degree_list dl
									        on cl.degree_id = dl.id
								where degree_id = '$degree_name'
								and curriculum_year = '$curriculum_year'
							");

		$row_count = mysqli_num_rows($select_exist);

		if ($row_count > 0) {
			$curriculum_exist = array();
			while ($row = mysqli_fetch_assoc($select_exist)) {
				$curriculum_exist[] = $row;
			}

		} else {
			$insert_curriculum = query("	insert into curriculum_list 
											(
												  degree_id
												, curriculum_year
											)
											values 
											(
												  '$degree_name'
												, '$curriculum_year'
											)
										");
			
			if ($insert_curriculum) {
				$_SESSION['msg'] = 'Create Success!';
				$_SESSION['alert'] = 'alert-success';
				header('Location: index.php?menu=curriculum_list');
				exit;
			}
		}
	}
}
