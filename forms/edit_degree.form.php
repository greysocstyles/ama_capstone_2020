<?php require_once 'actions/edit_degree.php'; ?>

<div class="row">
    <div class="col-lg-8 m-auto">
        <?php

        if(isset($msg) && isset($alert_class)):
             ?>
            <div class="alert alert-dismissible <?php echo $msg ?>">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php echo $alert_class ?></strong>
            </div>
        <?php endif; ?>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php?menu=degree_list">Degree List</a></li>
          <li class="breadcrumb-item active">Edit Degree</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Edit Degree</h3>
                </div>
                <?php

                if(isset($_GET['edit_id'])):
                    $edit_id = $_GET['edit_id'];
                    $result = query("SELECT * from degree_list where id = '$edit_id'");
                    if($result):
                        while($row = mysqli_fetch_assoc($result)): ?>
                        <form action="index.php?edit=degree&edit_id=<?php echo $row['id'] ?>" method="POST">
                            <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                            <div class="form-group">
                                <label>Degree Name</label>
                                <input class="form-control" type="text" name="degree_name" value="<?php echo $row['degree_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Degree Description</label>
                                <input class="form-control" type="text" name="degree_desc" value="<?php echo $row['degree_desc'] ?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="edit_degree">Update</button>
                                <a class="btn btn-danger" href="index.php?menu=degree_list">Cancel</a>
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
