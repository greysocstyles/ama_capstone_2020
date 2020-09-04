<?php 

if (isset($_GET['v_id'])) {
	$curriculum_id = $_GET['v_id'];

	$curriculum_list = query("SELECT  dl.degree_name
									, cl.curriculum_year	
							FROM curriculum_list cl
							inner join degree_list dl 
									on cl.degree_id = dl.id
							where cl.id = '$curriculum_id'");

} 

?>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="index.php?m=cl">Curriculum List</a></li>
	<li class="breadcrumb-item active">Curriculum Subject List</li>
</ol>

<!-- curriculum degree & year -->
<?php 

if ($curriculum_list) :
	while ($curriculum = mysqli_fetch_assoc($curriculum_list)) : ?>
			<h2 class="text-center"><?php echo $curriculum['degree_name']  ?></h2>
			<h3 class="text-center"><?php echo $curriculum['curriculum_year'] ?></h2>
			<?php
	endwhile; 
endif;
?>

<?php

$year_count = query("select count(year) from curriculum_subject group by year");

if ($year_count) {
	$row_count = mysqli_num_rows($year_count);
}
for ($i = 1; $i <= $row_count; $i++) : ?>
	<div class="table-responsive mt-4">
	<h3><i><?php echo year_trimester($i) . ' Year'?></i></h3>
	<table class="table table-sm table-hover table-bordered">
		<?php

		$curriculum_subject_list = query("SELECT
										   		cs.id,
										   		sl.subject_code AS subject_code,
										   		cs.year,
										   		cs.trimester,
										   		Group_concat(sl2.subject_code 
										ORDER BY
										   sl2.subject_code ASC SEPARATOR ', ') AS prerequisite_subj 
										FROM
										   curriculum_subj_prereq csp 
										   INNER JOIN
										      curriculum_subject cs 
										      ON csp.curriculum_subj_id = cs.id 
										   LEFT JOIN
										      curriculum_subject cs2 
										      ON csp.preq_subj_id = cs2.id 
										   INNER JOIN
										      subject_list sl 
										      ON cs.subject_id = sl.id 
										   LEFT JOIN
										      subject_list sl2 
										      ON cs2.subject_id = sl2.id 
										WHERE
										   cs.curriculum_id = '$curriculum_id' 
										   AND cs.year = '$i' 
										GROUP BY
										   cs.year,
										   cs.trimester,
										   sl.subject_code 
										ORDER BY
										   cs.year,
										   cs.trimester");

		if ($curriculum_subject_list):
			$yr = null;
			while ($curriculum_subject = mysqli_fetch_assoc($curriculum_subject_list)):
					$year = year_trimester($curriculum_subject['year']);
					$trimester = year_trimester($curriculum_subject['trimester']);
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
								<td width="50%"><?php echo $curriculum_subject['subject_code'] ?></td>
								<td width="50%"><?php echo $curriculum_subject['prerequisite_subj'] ?></td>
							<tr>
						</tbody>
					<?php
			endwhile;
		endif;
		?>
		</table>
	</div>
<?php endfor; ?>