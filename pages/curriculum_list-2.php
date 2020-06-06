<div class="mt-5">
	<h2 class="text-center">Curriculum List</h2>
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

			$select_curriculum_list = query("SELECT cl.id
												, 	dl.degree_name
												, 	cl.curriculum_year
											from curriculum_list as cl
											inner join degree_list as dl
													on cl.degree_id = dl.id");

			if($select_curriculum_list):
				while($row = mysqli_fetch_assoc($select_curriculum_list)):
					?>
					<tr>
						<td><?php echo $row['degree_name'] ?></td>
						<td><?php echo $row['curriculum_year'] ?></td>
						<td width="21%">
							<a href="index.php?v=csl&v_id=<?php echo $row['id'] ?>" title="View"><i class="fas fa-eye"></i></a>&nbsp;
						</td>
					</tr>
					<?php
				endwhile;
			endif;
			?>
			</tbody>
		</table>
	</div>
</div>
