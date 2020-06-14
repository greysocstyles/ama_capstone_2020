<?php require_once 'actions/delete_petition_subject.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=petition_list">Request To Open List</a></li>
  <li class="breadcrumb-item active">Delete Petition</li>
</ol>
<?php

if(isset($_GET['delete_id'])):
	$delete_id = $_GET['delete_id'];
	$result = query("SELECT ps.id
						,	sl.subject_code
					from request_to_open_list ps
					inner join subject_list sl
							on ps.subject_id = sl.id
					where ps.id = '$delete_id'");
		if($result):
			while($row = mysqli_fetch_assoc($result)): ?>
			<div class="card">
				<div class="card-body">
					<form action="index.php?delete=petition&delete_id=<?php echo $row['id'] ?>" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['subject_code'] ?></strong>?</p>
							<button class="btn btn-danger" name="delete_petition" type="submit">Yes</button>
							<a class="btn btn-secondary" href="index.php?menu=petition_list">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
		endwhile;
	endif;
endif;
?>
