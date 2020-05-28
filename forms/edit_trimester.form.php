<?php require_once 'actions/edit_trimester.php'; ?>

<div class="row">
    <div class="col-md-8 m-auto">
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
      <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
      <li class="breadcrumb-item active">Edit Trimester</li>
    </ol>
   	<div class="card">
        <div class="card-body">
			<div class="card-title"><h2>Edit Trimester</h2></div>
			<?php

			if (isset($_GET['edit_id'])):
				$edit_id = $_GET['edit_id'];
				$select_tl = query("select * from trimester_list where id = '$edit_id'");
				if ($select_tl):
					while ($row = mysqli_fetch_assoc($select_tl)):
    					    ?>
    						<form action="index.php?edit=trimester&edit_id=<?php echo $row['id'] ?>" method="POST">
    							<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
    							<div class="form-group">
    							 	<label>Year</label>
    							 	<input class="form-control" type="number" name="year" value="<?php echo $row['year'] ?>">
    							</div>
    							<div class="form-group">
    							 	<label>Trimester</label>
    							 	<input class="form-control" type="number" name="trimester" value="<?php echo $row['trimester'] ?>">
    							</div>
    							<div class="form-group">
    							    <?php 
    							    
    							    if (isset($trimester_exist)):
    							        echo 'Trimester Exist: ';
    							        foreach ($trimester_exist as $value): 
    							                ?>
    							                <strong class="text-danger"><?php echo year_trimester($value['year']) . ' Year'  . ', ' . year_trimester($value['trimester']) . ' Trimester' ?></strong>
    							                <?php
    							        endforeach;
    							    endif;
    							    ?>
    							</div>
    							<div class="form-group">
    							 	<button class="btn btn-primary" type="submit" name="edit_trimester">Update</button>
    							 	<a class="btn btn-danger" href="index.php?menu=trimester_list">Cancel</a>
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
