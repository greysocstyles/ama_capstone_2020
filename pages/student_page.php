<div class="container">
<?php 

if(!isset($_GET['m']) && !isset($_GET['v']) && !isset($_GET['c']) && !isset($_GET['d'])) {
	require_once 'subject_list-2.php';
}

if (isset($_GET['m'])) {
	switch($_GET['m']) {
		case 'sl': 
				require_once 'subject_list-2.php';
				break;

		case 'tl':
				require_once 'trimester_list-2.php';
				break;

		case 'cl':
				require_once 'curriculum_list-2.php';
				break;

		case 'pl':
				require_once 'request_to_open_list-2.php';
				break;
	}
}

if (isset($_GET['v'])) {
	switch($_GET['v']) {
		case 'tsl':
				require_once 'trimester_subject_list-2.php';
				break;

		case 'csl':
				require_once 'curriculum_subject_list-2.php';
				break;
		case 'mg':
				require_once 'my_grades.php';
				break;

		case 'ps':
				require_once 'request_to_open_student_list-2.php';
				break;
	}
}

if (isset($_GET['c'])) {
	switch($_GET['c']) {
		case 'cp':
				require_once 'forms/create_petition_subject-2.form.php';
				break;

		case 'jp':
				require_once 'forms/join_petition.form.php';
				break;
	}
}

if(isset($_GET['d'])) {
	switch($_GET['d']) {
		case 'lp':
				require_once 'forms/leave_petition.form.php';
				break;
	}
}

?>
</div>
