<?php require_once 'actions/create_section.php'; ?>
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
		  <li class="breadcrumb-item active">New Section</li>
		</ol>
		<div class="card">
			<div class="card-body">
				<div class="card-title"><h3>New Section</h3></div>
				<form action="index.php?new=section" method="POST">
					<div class="form-group">
						<label>Section Code</label>
						<input class="form-control" type="text" pattern="[a-zA-Z0-9]+" placeholder="ex. 23CF" title="section name" name="section_code">
					</div>
					<div class="form-group">
						<label>Degree</label>
						<select class="form-control" name="degree_id">
							<?php

							$select_degree = query("select id, degree_name from degree_list");

							if($select_degree):
								while($row = mysqli_fetch_assoc($select_degree)):
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['degree_name'] ?></option>
									<?php
								endwhile;
							endif;
							?>
						</select>
					</div>
					<div class="form-group">
					    <?php 
					    
					    if (isset($section_exist)):
					        echo 'Section Exist: ';
					        foreach ($section_exist as $value) : ?>
					                <strong class="text-danger"><?php echo implode(" - ", $value) ?></strong>
					                <?php
					        endforeach;
					    endif;
					    ?>
					</div>
					<div class="form-group">
						<button class="btn btn-primary" type="submit" name="create_section">Create</button>
						<a class="btn btn-danger" href="index.php?menu=section_list">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
