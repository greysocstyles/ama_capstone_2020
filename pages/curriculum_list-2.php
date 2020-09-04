<?php 

$curriculum_list = query("SELECT  cl.id
								, dl.degree_name
								, cl.curriculum_year
						from curriculum_list as cl
						inner join degree_list as dl
									on cl.degree_id = dl.id");

?>

<ol class="breadcrumb">
  <li class="breadcrumb-item active">Curriculum List</li>
  <li class="breadcrumb-item active"></li>
</ol>

<div class="mt-5">
	<h2 class="text-center">Curriculum List</h2>
	<!-- table-div -->
	<div class="table-responsive mt-4">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Degree</th>
					<th>Curriculum Year</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
			<?php

			if($curriculum_list) :
				while($curriculum = mysqli_fetch_assoc($curriculum_list)) : ?>
						<tr>
							<td><?php echo $curriculum['degree_name'] ?></td>
							<td><?php echo $curriculum['curriculum_year'] ?></td>
							<td width="21%">
								<a href="index.php?v=csl&v_id=<?php echo $curriculum['id'] ?>" title="View"><i class="fas fa-eye"></i></a>&nbsp;
							</td>
						</tr>
						<?php
				endwhile;
			endif;
			?>
			</tbody>
		</table>
	</div>
	<!-- end of table-div -->
</div>
