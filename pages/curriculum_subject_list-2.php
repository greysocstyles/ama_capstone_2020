<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?m=cl">Curriculum List</a></li>
  <li class="breadcrumb-item active">Curriculum Subject List</li>
</ol>
<?php 

if (isset($_GET['v_id'])) {
	$curriculum_id = $_GET['v_id'];
}

?>
<?php 

$curriculum = query("select dl.degree_name
						,	cl.curriculum_year	
					from curriculum_list cl
					inner join degree_list dl 
								on cl.degree_id = dl.id
					where cl.id = '$curriculum_id'");
if ($curriculum):
	while ($row = mysqli_fetch_assoc($curriculum)):
		?>
		<h2 class="text-center"><?php echo $row['degree_name']  ?></h2>
		<h3 class="text-center"><?php echo $row['curriculum_year'] ?></h2>
		<?php
	endwhile; 
endif;
?>
<?php

$year_count = query("select count(year) from curriculum_subject group by year");

if ($year_count) {
	$row_count = mysqli_num_rows($year_count);
}
for ($i = 1; $i <= $row_count; $i++):
	?>
	<div class="table-responsive mt-5">
	<h3><i><?php echo year_trimester($i) . ' Year'?></i></h3>
	<table class="table table-sm table-hover table-bordered">
	<?php

	$curriculum_subj_list = query("SELECT 	cs.id
										,	sl.subject_code as subject_code
										,	cs.year
										,	cs.trimester
										,	group_concat(sl2.subject_code order by sl2.subject_code asc separator ', ') as prerequisite_subj
									  from 	curriculum_subj_prereq csp
							    inner join 	curriculum_subject cs
											on csp.curriculum_subj_id = cs.id
								left join   curriculum_subject cs2
											on csp.preq_subj_id = cs2.id
								inner join	subject_list sl
											on cs.subject_id = sl.id
								left join 	subject_list sl2
											on cs2.subject_id = sl2.id
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
					<thead>
						<tr>
							<th colspan="4" class="text-center text-dark bg-secondary"><?php echo $trimester . ' Trimester'; ?></th>
						</tr>
						<tr>
							<th class="text-muted">Subject</th>
							<th class="text-muted">Prerequisite</th>
						</tr>
					</thead>
		 <?php endif; ?>
					<tbody>
						<tr>
							<td width="50%"><?php echo $row['subject_code'] ?></td>
							<td width="50%"><?php echo $row['prerequisite_subj'] ?></td>
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