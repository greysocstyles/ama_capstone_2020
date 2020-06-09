<?php require_once 'actions/join_petition.php'; ?>
<?php
if (isset($_GET['p_id'])) {
	$petition_id = $_GET['p_id'];
	$select_petition = query("select sl.subject_code
							from request_to_open_list rto
							inner join subject_list sl 
										on rto.subject_id = sl.id 
							where rto.id = '$petition_id'");
	if ($select_petition) {
		while ($row = mysqli_fetch_assoc($select_petition)) {
				$subject_code = $row['subject_code'];
		}
	}
} 
?>
<form action="index.php?c=jp" method="POST">
	<div class="card">
		<div class="card-body">
			<input type="hidden" name="student_id" value="<?php echo $_SESSION['student_id'] ?>">
			<input type="hidden" name="petition_id" value="<?php echo $petition_id ?>">
			<p>Are you sure you want to Join the petition for <strong class="text-primary"><?php echo $subject_code ?></strong>?</p>
			<div class="form-group">
				<button class="btn btn-primary" name="join_petition" type="submit">Yes</button>
				<a class="btn btn-danger" href="index.php?v=ps&v_id=<?php echo $petition_id ?>">No</a>
			</div>
		</div>
	</div>
</form>