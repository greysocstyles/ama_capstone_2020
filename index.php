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
<?php if (isset($_SESSION['username']) && isset($_SESSION['account_type']) || isset($_SESSION['student_name'])) : ?>

	<?php if ($_SESSION['account_type'] == 'Admin') : ?>

		<?php require_once 'includes/header.php'; ?>
		<?php require_once 'pages/admin_page.php'; ?>

	<?php elseif ($_SESSION['account_type'] == 'Student') : ?>

		<?php require_once 'includes/header-2.php'; ?>
		<?php require_once 'pages/student_page.php'; ?>

	<?php endif; ?>

<?php else: ?>

	<div class="container-fluid">
		<div class="mt-5">
			<?php require_once 'forms/login.form.php'; ?>
		</div>
	</div>

<?php endif; ?>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>

<?php ob_end_flush(); ?>
