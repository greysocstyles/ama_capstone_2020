<ol class="breadcrumb">
  <li class="breadcrumb-item active">Petition List</a></li>
  <li class="breadcrumb-item"></li>
</ol>
<div class="mt-5">
	<h2 class="text-center">Petition List</h2>
	<div class="mt-3">
		<div class="form-group">
			<a class="btn btn-outline-primary" href="index.php?c=cp">Create Petition</a>
		</div>
		<div class="table-responsive">
			<table class="table table-sm table-bordered table-hover table-striped">
				<thead class="thead-light">
					<tr>
						<th>Id</th>
						<th>Petition Subject</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$petition_subject = query("	select 	ps.id
													, 	sl.subject_code
													, 	ps.status
												from request_to_open_list ps
												inner join subject_list sl
														on ps.subject_id = sl.id");

					if($petition_subject):
						while($row = mysqli_fetch_assoc($petition_subject)):
							?>
							<tr>
								<td><strong><?php echo $row['id'] ?></strong></td>
								<td><?php echo $row['subject_code'] ?></td>
								<td><?php echo $row['status'] ?></td>
								<td>
									<a href="index.php?v=ps&v_id=<?php echo $row['id'] ?>" title="View"><i class="fas fa-eye"></i></a>
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