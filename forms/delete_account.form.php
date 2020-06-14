<?php require_once 'actions/delete_account.php'; ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?menu=account_list">Account List</a></li>
     <li class="breadcrumb-item active">Delete Account</li>
    </ol>
<?php

if(isset($_GET['delete_id'])):
        $delete_id = $_GET['delete_id'];
        ?>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $delete_id ?>"/>
                        <div class="form-group">
                            <p>Are you sure you want to Delete 
                                <strong class="text-danger">
                                <?php
                                if (isset($_GET['account_type']) && $_GET['account_type'] == 'Admin') {
                                    $select_ad = query("select username from account_list where id = '$delete_id'");
                                    if ($select_ad) {
                                        while ($row = mysqli_fetch_assoc($select_ad)) {
                                                echo $row['username'];
                                        }
                                    }

                                } elseif (isset($_GET['account_type']) && $_GET['account_type'] == 'Student') {
                                    $select_st = query("select sl.name
                                                            ,  sl.usn 
                                                        from account_list al 
                                                        inner join student_list sl 
                                                                    on al.student_id = sl.id 
                                                        where al.id = '$delete_id'");
                                    if ($select_st) {
                                        while ($row = mysqli_fetch_assoc($select_st)) {
                                                echo $row['usn'] . ', ' . $row['name']; 
                                        }
                                    }
                                }
                                ?>    
                                </strong>?
                            </p>
                            <button class="btn btn-danger" type="submit" name="delete_account">Yes</button>
                            <a class="btn btn-secondary" href="index.php?menu=account_list">No</a>
                        </div>
                    </form>
                </div>
            </div>
<?php endif; ?>
