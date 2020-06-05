<?php

ob_start();
session_start();
require_once 'includes/db_config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AMA Advising & Scheduling</title>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/mystyle.css">
	<link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/b5023ced18.js" crossorigin="anonymous"></script>
</head>
<body>
<?php require_once 'includes/header.php'; ?>
<div class="container">
<?php
// default page
if(!isset($_GET['menu']) && !isset($_GET['new']) && !isset($_GET['delete']) && !isset($_GET['view']) && !isset($_GET['edit'])) {
    require_once 'pages/subject_list.php';
}

// MENU ...
if(isset($_GET['menu'])) {
	switch ($_GET['menu']) {
		case 'subject_list':
				require_once 'pages/subject_list.php';
				break;

		case 'trimester_list':
				require_once 'pages/trimester_list.php';
				break;

		case 'student_list':
				require_once 'pages/student_list.php';
				break;

		case 'curriculum_list':
				require_once 'pages/curriculum_list.php';
				break;

		case 'section_list':
				require_once 'pages/section_list.php';
				break;

		case 'degree_list':
				require_once 'pages/degree_list.php';
				break;

		case 'petition_list':
				require_once 'pages/request_to_open_list.php';
				break;

		case 'account_list':
				require_once 'pages/account_list.php';
				break;

	}
}

// NEW
if(isset($_GET['new'])) {
	switch($_GET['new']) {
		case 'subject':
				require_once 'forms/create_subject.form.php';
				break;

		case 'trimester':
				require_once 'forms/create_trimester.form.php';
				break;

		case 'trimester_subject':
				require_once 'forms/create_trimester_subject.form.php';
				break;

		case 'student':
				require_once 'forms/create_student.form.php';
				break;

		case 'student_subject':
				require_once 'forms/create_student_subject.form.php';
				break;

		case 'curriculum':
				require_once 'forms/create_curriculum.form.php';
				break;

		case 'curriculum_subject':
				require_once 'forms/create_curriculum_subject.form.php';
				break;

		case 'prerequisite_subject':
				require_once 'forms/add_prerequisite.form.php';
				break;

		case 'section':
				require_once 'forms/create_section.form.php';
				break;

		case 'degree':
				require_once 'forms/create_degree.form.php';
				break;

		case 'petition':
				require_once 'forms/create_petition_subject.form.php';
				break;

		case 'petition_student':
				require_once 'forms/create_petition_student.form.php';
				break;

		case 'account':
				require_once 'forms/create_account.form.php';
				break;
	}
}

// VIEW
if(isset($_GET['view'])) {
	switch($_GET['view']) {
		case 'trimester_subject':
				require_once 'pages/trimester_subject_list.php';
				break;

		case 'student_subject':
				require_once 'pages/student_subject_list.php';
				break;

		case 'curriculum_subject':
				require_once 'pages/curriculum_subject_list.php';
				break;

		case 'petition_student':
				require_once 'pages/request_to_open_student_list.php';
				break;
	}
}

// EDIT
if(isset($_GET['edit'])) {
	switch($_GET['edit']) {
		case 'subject':
				require_once 'forms/edit_subject.form.php';
				break;

		case 'trimester':
				require_once 'forms/edit_trimester.form.php';
				break;

		case 'trimester_subject':
				require_once 'forms/edit_trimester_subject.form.php';
				break;

		case 'student':
				require_once 'forms/edit_student.form.php';
				break;

		case 'student_subject':
				require_once 'forms/edit_student_subject.form.php';
				break;

		case 'curriculum':
				require_once 'forms/edit_curriculum.form.php';
				break;

		case 'prerequisite_subject':
				require_once 'forms/edit_curriculum_subj_prereq.form.php';
				break;

		case 'section':
				require_once 'forms/edit_section.form.php';
				break;

		case 'degree':
				require_once 'forms/edit_degree.form.php';
				break;

		case 'petition':
				require_once 'forms/edit_petition_subject.form.php';
				break;

		case 'account':
				require_once 'forms/edit_account.form.php';
				break;
	}
}

// DELETE
if(isset($_GET['delete'])) {
	switch($_GET['delete']) {
		case 'subject':
				require_once 'forms/delete_subject.form.php';
				break;

		case 'trimester':
				require_once 'forms/delete_trimester.form.php';
				break;

		case 'trimester_subject':
				require_once 'forms/delete_trimester_subject.form.php';
				break;

		case 'student':
				require_once 'forms/delete_student.form.php';
				break;

		case 'student_subject':
				require_once 'forms/delete_student_subject.form.php';
				break;

		case 'curriculum':
				require_once 'forms/delete_curriculum.form.php';
				break;

		case 'curriculum_subject':
				require_once 'forms/delete_curriculum_subject.form.php';
				break;

		case 'prerequisite_subject':
				require_once 'forms/delete_subj_prereq.form.php';
				break;

		case 'section':
				require_once 'forms/delete_section.form.php';
				break;

		case 'degree':
				require_once 'forms/delete_degree.form.php';
				break;

		case 'petition':
				require_once 'forms/delete_petition_subject.form.php';
				break;

		case 'petition_student':
				require_once 'forms/delete_petition_student.form.php';
				break;

		case 'account':
				require_once 'forms/delete_account.form.php';
				break;
	}
}
mysqli_close($connect);
unset($_SESSION['msg']);
unset($_SESSION['alert']);
?>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
