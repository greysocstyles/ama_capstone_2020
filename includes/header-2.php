<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
	<div class="container">
		<a class="navbar-brand" href="index.php"><img src="img/ama-logo.jpg" width="30" height="30" alt="" class="d-inline-block align-top"/>AMA Advising & Scheduling</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarContent">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="index.php?m=sl">Subject List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?m=tl">Trimester List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?m=cl">Curriculum List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?m=pl">Petition</a>
				</li>
				<li class="nav-item dropdown">
				    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['student_name'] ?></a>
				    <div class="dropdown-menu" style="">
				      <a class="dropdown-item" href="index.php?v=mg&v_id=<?php echo $_SESSION['student_id'] ?>">My Grades</a>
				      <div class="dropdown-divider"></div>
				      <a class="dropdown-item" href="actions/logout.php">Log out</a>
				    </div>
				</li>
			</ul>
		</div>
	</div>
</nav>