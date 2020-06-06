<div class="mt-5">
	<h2 class="text-center">Trimester List</h2>
	<div class="mt-4">
	<div class="table-responsive">
		<table class="table table-sm table-bordered table-hover table-striped">
			<thead class="thead-light">
				<tr>
					<th>Year</th>
					<th>Trimester</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
				<?php

				$trimester_list = query("SELECT * from trimester_list");

				if ($trimester_list):
					while ($row = mysqli_fetch_assoc($trimester_list)): ?>
						<tr>
							<td><?php echo year_trimester($row['year']) ?></td>
							<td><?php echo year_trimester($row['trimester']) ?></td>
							<td width="25%">
								<a href="index.php?v=tsl&v_id=<?php echo $row['id'] ?>" title="View Subjects"><i class="fas fa-eye"></i></a>
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
</div>