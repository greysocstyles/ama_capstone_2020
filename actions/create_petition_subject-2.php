<?php

if (isset($_POST['create_petition']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
	$petition_subject = $_POST['petition_subject'];
	$select_exist = query("	select subject_code 
						 	from request_to_open_list rto 
						 	inner join subject_list sl 
										on rto.subject_id = sl.id 
							where subject_id = '$petition_subject' 
						 	and status = 'Pending' or status = 'Approved'
						");

	if ($select_exist) {
		$row_count = mysqli_num_rows($select_exist);

		if ($row_count > 0) {
			$petition_exist = array();
			while ($row = mysqli_fetch_assoc($select_exist)) {
				$petition_exist[] = $row;
			}

		} else {
			$insert_petition = query("insert into request_to_open_list (subject_id) values ('$petition_subject')");
			
			if ($insert_petition) {
				header('Location: index.php?m=pl');
				exit;
			}
		}
	}
}
