<?php require_once 'actions/edit_account.php'; ?>
<?php 

if (isset($_GET['edit_id'])):
	$edit_id = $_GET['edit_id'];

	$select_ad = query("select * from account_list where id = '$edit_id'");

	if ($select_ad) {
		$account_ad = array();
		while ($row = mysqli_fetch_assoc($select_ad)) {
				$account_ad[] = $row;
		}
	}

	$select_st = query("select  al.id
						    ,   al.password
						    ,	sl.usn
						    ,   sl.name
						from account_list al 
						inner join student_list sl 
						            on al.student_id = sl.id 
						where al.id = '$edit_id'");
	if ($select_st) {
		$account_st = array();
		while ($row = mysqli_fetch_assoc($select_st)) {
				$account_st[] = $row;
		}
	}

?>
<form action="index.php?edit=account&edit_id=<?php echo $edit_id ?>&account_type=<?php echo $_SESSION['account_type'] ?>" method="POST">
	<div class="form-row">
		<div class="col-md-8 m-auto">
			<?php

			if(isset($msg) && isset($alert_class)): ?>
				<div class="alert alert-dismissible <?php echo $alert_class ?>">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><?php echo $msg ?></strong>
				</div>
				<?php
			endif;
			?>
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="index.php?menu=account_list">Account List</a></li>
			  <li class="breadcrumb-item active">Edit Account</li>
			</ol>
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h3>Edit Account</h3>
					</div>
					<input type="hidden" name="edit_id" value="<?php echo $edit_id ?>">
					<?php if (isset($_GET['account_type']) && $_GET['account_type'] == 'Admin'): 
							foreach ($account_ad as $row):
							?>
							<div class="form-group">
								<label>Name</label>
								<input class="form-control" type="text" name="name" placeholder="name" value="<?php echo $row['name'] ?>">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input class="form-control" type="text" name="username" placeholder="username" value="<?php echo $row['username'] ?>">
							</div>
					<?php 	endforeach; ?>
					<?php elseif (isset($_GET['account_type']) && $_GET['account_type'] == 'Student'): 
							foreach ($account_st as $row):
							?>
							<div class="row">
								<div class="form-group col-sm-6">
									<label>USN</label>
									<input class="form-control" type="text" value="<?php echo $row['usn'] ?>" readonly>
								</div>
								<div class="form-group col-sm-6">
									<label>Name</label>
									<input class="form-control" type="text" value="<?php echo $row['name'] ?>" readonly>
								</div>
							</div>
					<?php 	endforeach; ?>
					<?php endif; ?>
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="text" name="password" placeholder="password" value="<?php echo $row['password'] ?>">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" name="edit_account" type="submit">Update</button>
						<a class="btn btn-danger" href="index.php?menu=account_list">Cancel</a>
					</div>
					</div>
				</div>
			</div>
		</form>
<?php endif; ?>