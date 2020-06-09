<?php require_once 'actions/delete_degree.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=degree_list">Degree List</a></li>
  <li class="breadcrumb-item active">Delete Degree</li>
</ol>
<?php

if(isset($_GET['delete_id'])):
    $delete_id = $_GET['delete_id'];
    $result = query("SELECT id
                        ,   degree_name
                    from degree_list
                    where id = '$delete_id'");
    if($result):
        while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?delete=degree&delete_id=<?php echo $row['id'] ?>" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                        <div class="form-group">
                            <p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['degree_name']?>?</strong></p>
                            <button class="btn btn-danger" name="delete_degree" type="submit">Yes</button>
                            <a class="btn btn-secondary" href="index.php?menu=degree_list">No</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        endwhile;
    endif;
endif;
?>
