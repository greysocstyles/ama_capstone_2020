<div class="mt-5">
	<h2 class="text-center">Subject List</h2>
	<div class="mt-4">
		<div class="table-responsive">
			<table class="table table-sm table-bordered table-hover table-striped">
				<caption>List of Subjects</caption>
				<thead class=thead-light>
					<tr>
						<th>Subject Code</th>
						<th>Subject Name</th>
						<th>Subject Description</th>
						<th>Lec Unit</th>
						<th>Lab Unit</th>
						<th>Total Unit</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$subject_list = query("select * from subject_list where subject_status = 1");

					if($subject_list):
						while($row = mysqli_fetch_assoc($subject_list)):
							?>
							<tr>
								<td><?php echo $row['subject_code'] ?></td>
								<td><?php echo $row['subject_name'] ?></td>
								<td><?php echo $row['subject_desc'] ?></td>
								<td><?php echo $row['lec_unit'] ?></td>
								<td><?php echo $row['lab_unit'] ?></td>
								<td><?php echo $row['lec_unit'] + $row['lab_unit'] ?></td>
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