<?php require_once 'actions/create_account.php'; ?>

<form action="index.php?new=account" method="POST">
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
			  <li class="breadcrumb-item"><a href="index.php?menu=account_list">Account List</a></li>
			  <li class="breadcrumb-item active">New Account</li>
			</ol>
    		<div class="card">
    			<div class="card-body">
    				<div class="row">
	    				<div class="card-title col-md-6 ">
	    					<h3>New Account</h3>
	    				</div>
	    				<div class="col-md-6">
		    				<label>Select Account Type</label>
				    		<select class="form-control-sm" name="select_account_type">
				    			<?php
				    			$account_type = array('Admin', 'Student');
				    			foreach ($account_type as $value):
				    			?>
				    			<option value="<?php echo $value ?>" <?php if (isset($_POST['select_account_type']) && $_POST['select_account_type'] == $value) echo 'selected' ?>><?php echo $value ?></option>
				    			<?php 
				    			endforeach; 
				    			?>
				    		</select>
				    		<button class="btn btn-secondary" type="submit">Go</button>
			    		</div>
    				</div>
		    		<?php if (isset($_POST['select_account_type']) && $_POST['select_account_type'] == 'Admin'): ?>
			    		<div class="form-group">
			    			<input class="form-control" type="text" name="name" placeholder="Name">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" type="text" name="username" placeholder="Username">
			    		</div>
		    		<?php elseif (isset($_POST['select_account_type']) && $_POST['select_account_type'] == 'Student'): ?>
			    		<div class="form-group">
			    			<select class="form-control" name="usn">
			    				<?php 
			    				$student_list = query("select id, usn, name from student_list");
			    				if ($student_list):
			    					while ($row = mysqli_fetch_assoc($student_list)):
					    				  ?>
					    				  <option value="<?php echo $row['id'] ?>"><?php echo $row['usn'] . ' - ' . $row['name'] ?></option>
					    				  <?php
			    					endwhile; 
			    				endif;
			    				?>
			    			</select>
			    		</div>
		    		<?php endif; ?>
		    		<?php if (isset($_POST['select_account_type'])): ?>
			    		<div class="form-group">
			    			<input class="form-control" type="text" name="password" placeholder="Password">
			    		</div>
			    		<div class="form-group">
				    		<button class="btn btn-primary" name="create_account" type="submit">Submit</button>
				    		<a class="btn btn-danger" href="index.php?menu=account_list">Cancel</a>
			    		</div>
		    		<?php endif; ?>
		    	</div>
		    </div>
    	</div>
    </div>
</form>
