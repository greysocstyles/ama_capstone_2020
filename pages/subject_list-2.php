<?php 

$subject_list = query("select * from subject_list where subject_status = 1");
	
?>

<div class="mt-5">
	<h2 class="text-center">Subject List</h2>
	<div class="mt-4">
		<!-- table-div -->
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

					if($subject_list):
						while($subject = mysqli_fetch_assoc($subject_list)):
							?>
							<tr>
								<td><?php echo $subject['subject_code'] ?></td>
								<td><?php echo $subject['subject_name'] ?></td>
								<td><?php echo $subject['subject_desc'] ?></td>
								<td><?php echo $subject['lec_unit'] ?></td>
								<td><?php echo $subject['lab_unit'] ?></td>
								<td><?php echo $subject['lec_unit'] + $subject['lab_unit'] ?></td>
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
</div>