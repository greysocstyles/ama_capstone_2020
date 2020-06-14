<?php require_once 'actions/delete_curriculum.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item active"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
  <li class="breadcrumb-item active">Delete Curriculum</li>
</ol>
<?php

if(isset($_GET['delete_id'])):
		$delete_id = $_GET['delete_id'];
		$select_curriculum = query("select  cl.id
										, 	dl.degree_name
										, 	cl.curriculum_year
									from curriculum_list cl
									inner join degree_list dl
									on cl.degree_id = dl.id
									where cl.id = '$delete_id'");
		if($select_curriculum):
			while($row = mysqli_fetch_assoc($select_curriculum)):
				?>
				<div class="card">
					<div class="card-body">
						<form action="index.php?delete=curriculum" method="POST">
							<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
							<div class="form-group">
								<p>Are you sure you want to delete <strong class="text-danger"><?php echo $row['degree_name'] . ', ' . $row['curriculum_year'] ?></strong>?</p>
								<button class="btn btn-danger" type="submit" name="delete_curriculum">Yes</button>
								<a class="btn btn-secondary" href="index.php?menu=curriculum_list">No</a>
							</div>
						</form>
					</div>
				</div>
			<?php
		endwhile;
	endif;
endif;
?>
