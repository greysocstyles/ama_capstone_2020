<?php

if (isset($_GET['view_id'])) {
	$curriculum_id = $_GET['view_id'];

	$select_curriculum = query("SELECT	dl.degree_name
									, 	cl.curriculum_year
								from curriculum_list cl
								inner join degree_list dl
										on cl.degree_id = dl.id
								where cl.id = '$curriculum_id'");

	if ($select_curriculum) {
		$curriculum_list = array();
		while ($row = mysqli_fetch_assoc($select_curriculum)) {
				$curriculum_list[] = $row;
		}
	}

}

?>

<?php

if(isset($_SESSION['msg']) && isset($_SESSION['alert'])): ?>
	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong><?php echo $_SESSION['msg'] ?></strong>
	</div>
	<?php
endif;
?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
  <li class="breadcrumb-item active">Curriculum Subject List</li>
</ol>
<?php

if(isset($curriculum_list)):
	foreach($curriculum_list as $row): ?>
			<h2 class="text-center text-dark"><?php echo $row['degree_name'] . ', ' . $row['curriculum_year'] ?></h2>
			<?php
	endforeach;
endif;
?>
<div class="mt-3">
	<div class="form-group">
		<a class="btn btn-outline-primary" href="index.php?new=curriculum_subject&curriculum_id=<?php echo $curriculum_id ?>">New Subject</a>
	</div>

<?php

$year_count = query("select count(year) from curriculum_subject group by year");

if ($year_count) {
	$row_count = mysqli_num_rows($year_count);
}

for ($i = 1; $i <= $row_count; $i++):
	?>
	<div class="table-responsive mt-5">
	<h3 class="text-center text-dark"><?php echo year_trimester($i) . ' Year'?></h3>
	<table class="table table-sm table-hover table-bordered">
	<?php

	$curriculum_subj_list = query("SELECT 	cs.id
										,	sl.subject_code as subject_code
										,	cs.year
										,	cs.trimester
										,	group_concat(sl2.subject_code
									order by sl2.subject_code asc separator ', ') as prerequisite_subj
									  from 	curriculum_subj_prereq csp
							    inner join 	curriculum_subject cs
											on csp.curriculum_subj_id = cs.id
								inner join	subject_list sl
											on cs.subject_id = sl.id
								left join 	subject_list sl2
											on csp.preq_subj_id = sl2.id
									where   cs.curriculum_id = '$curriculum_id'
									  and	cs.year = '$i'

								 group by 	cs.year
								 		,	cs.trimester
										,	sl.subject_code
								order by	cs.year
										,	cs.trimester");

	if ($curriculum_subj_list):
		$yr = null;
		while ($row = mysqli_fetch_assoc($curriculum_subj_list)):
				$year = year_trimester($row['year']);
				$trimester = year_trimester($row['trimester']);
				if ($yr != $year . ' Year' . ', ' . $trimester . ' Trimester'):
					$yr = $year . ' Year' . ', ' . $trimester . ' Trimester';
					?>
					<h3></h3>
					<thead>
						<tr>
							<th colspan="4" class="text-center text-dark bg-light"><?php echo $trimester . ' Trimester'; ?></th>
						</tr>
						<tr>
							<th class="text-muted">Id</th>
							<th class="text-muted">Subject</th>
							<th class="text-muted">Prerequisite</th>
							<th class="text-muted">Action</th>
						</tr>
					</thead>
		 <?php endif; ?>
					<tbody>
						<tr>
							<td width="5%"><?php echo $row['id'] ?></td>
							<td width="35%"><?php echo $row['subject_code'] ?></td>
							<td width="40%"><?php echo $row['prerequisite_subj'] ?></td>
							<td width="15%">
								<a href="index.php?new=prerequisite_subject&curriculum_subj_id=<?php echo $row['id'] ?>" title="Add Prerequisite"><i class="fas fa-book"></i></a>&nbsp;
								<a href="index.php?edit=prerequisite_subject&edit_id=<?php echo $row['id'] ?>" title="Edit"><i class="fas fa-edit"></i></a>&nbsp;
								<a href="index.php?delete=curriculum_subject&delete_id=<?php echo $row['id'] ?>" title="Delete"><i class="fas fa-trash"></i></a>
							</td>
						<tr>
					</tbody>
				<?php
		endwhile;
	endif;
	?>
	</table>
	</div>
	<?php
endfor;
?>
</div>
