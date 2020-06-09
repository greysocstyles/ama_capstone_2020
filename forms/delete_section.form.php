<?php require_once 'actions/delete_section.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=section_list">Section List</a></li>
  <li class="breadcrumb-item active">Delete Section</li>
</ol>
<?php

if(isset($_GET['delete_id'])):
        $delete_id = $_GET['delete_id'];
        $result = query("SELECT id
                            ,   section_code
                        from section_list
                        where id = '$delete_id' ");

        if($result):
            while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <div class="card-body">
                    <form action="index.php?delete=section&delete_id=<?php echo $row['id'] ?>" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>"/>
                        <div class="form-group">
                            <p>Are you sure you want to Delete <strong class="text-danger"><?php echo $row['section_code'] ?></strong>?</p>
                            <button class="btn btn-danger" type="submit" name="delete_section">Yes</button>
                            <a class="btn btn-secondary" href="index.php?menu=section_list">No</a>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        endwhile;
    endif;
endif;
?>
