<?php require_once 'actions/delete_subject.php'; ?>

<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index.php?menu=subject_list">Subject List</a></li>
  <li class="breadcrumb-item active">Delete Subject</li>
</ol>
<div class="card">
	<div class="card-body bg-light">
	<?php

		if(isset($_GET['delete_id'])):
				$delete_id = $_GET['delete_id'];
				$result = query("SELECT  id
									, 	 subject_code
								 from 	 subject_list
								 where id = '$delete_id'");
				if($result):
					while($row = mysqli_fetch_assoc($result)): ?>
					<form action="index.php?delete=subject" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['subject_code']?></strong>?</p>
							<button class="btn btn-danger" type="submit" name="delete_subject">Yes</button>
							<a class="btn btn-secondary active" href="index.php?menu=subject_list">No</a>
						</div>
					</form>
					<?php
				endwhile;
			endif;
		endif;
		?>
	</div>
</div>
