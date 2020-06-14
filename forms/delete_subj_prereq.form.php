<?php

require_once 'actions/delete_curriculum_subj_prereq.php';

if(isset($_GET['delete_id'])):
	$delete_id = $_GET['delete_id'];
	$result = query("select csp.id
						, 	csp.curriculum_subj_id
						, 	sl.subject_code
					from curriculum_subj_prereq csp
					left join curriculum_subject cs
								on csp.preq_subj_id = cs.id
					inner join subject_list sl
								on cs.subject_id = sl.id
					where csp.id = '$delete_id'");
	if($result):
		while($row = mysqli_fetch_assoc($result)):
			?>
			<div class="card">
				<div class="card-body">
					<form action="index.php?delete=prerequisite_subject&delete_id=<?php echo $row['id'] ?>" method="POST">
						<input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
						<input type="hidden" name="curriculum_subj_id" value="<?php echo $row['curriculum_subj_id'] ?>">
						<div class="form-group">
							<p>Are you sure you want to delete <strong class="text-danger"><?php echo $row['subject_code'] ?></strong>?</p>
							<button type="submit" class="btn btn-danger" name="delete_subj_prereq">Yes</button>
							<a class="btn btn-secondary" href="index.php?edit=prerequisite_subject&edit_id=<?php echo $row['curriculum_subj_id'] ?>">No</a>
						</div>
					</form>
				</div>
			</div>
			<?php
		endwhile;
	endif;
endif;
?>
