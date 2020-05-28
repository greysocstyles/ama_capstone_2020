<?php require_once 'actions/edit_section.php'; ?>

<div class="row">
	<div class="col-lg-8 m-auto">
		<?php

		if(isset($msg) && isset($alert_class)): ?>
			<div class="alert alert-dismissible <?php echo $alert_class ?>">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong><?php echo $msg ?></strong>
			</div>
			<?php
		endif;
		?>
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="index.php?menu=section_list">Section List</a></li>
		  <li class="breadcrumb-item active">Edit Section</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title">
					<h3>Edit Section</h3>
				</div>
				<?php

				if(isset($_GET['edit_id'])):
					$edit_id = $_GET['edit_id'];
					$result = query("SELECT 	s.id
											, 	s.section_code
											, 	dl.degree_name
									from section_list s
									inner join degree_list dl
									on s.degree_id = dl.id
									where s.id = '$edit_id'");

					if($result):
						while($row = mysqli_fetch_assoc($result)): ?>
						<form action="index.php?edit=section&edit_id=<?php echo $row['id'] ?>" method="POST">
							<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
							<div class="form-group">
								<label for="section_code">Section Code</label>
								<input class="form-control" type="text" id="section_code" name="section_code" value="<?php
								echo $row['section_code'] ?>">
							</div>
							<div class="form-group">
								<label for="degree_id">Degree</label>
								<select class="form-control" id="degree_id" name="degree_id">
									<option><?php echo $row['degree_name'] ?></option>
								</select>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="edit_section">Update</button>
								<a class="btn btn-danger" href="index.php?menu=section_list">Cancel</a>
							</div>
						</form>
						<?php
						endwhile;
					endif;
				endif;
				?>
			</div>
		</div>
	</div>
</div>
