<ol class="breadcrumb">
  <li class="breadcrumb-item active">Account List</li>
  <li class="breadcrumb-item active"></li>
</ol>
<h2 class="text-center">Account List</h2>
<div class="mt-3">
    <div class="form-group">
        <a class="btn btn-outline-primary" href="index.php?new=account">New Account</a>
    </div>
    <div class="table-responsive">
         <h3 class="text-center">Admin</h3>
        <table class="table table-sm table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $select_admin = query("select id
                                            , name
                                            , username
                                            , account_type 
                                            , password 
                                        from account_list 
                                        where account_type = 'Admin'");
                if ($select_admin):
                    while ($row = mysqli_fetch_assoc($select_admin)): 
                            ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <td>
                                    <a href="index.php?edit=account&edit_id=<?php echo $row['id'] ?>&account_type=<?php echo $row['account_type'] ?>">Edit</a>
                                    <a href="index.php?delete=account&delete_id=<?php echo $row['id'] ?>&account_type=<?php echo $row['account_type'] ?>">Delete</a>
                                </td>
                            </tr>
                            <?php 
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>
    </div>
    <div class="table-responsive mt-5">
        <h3 class="text-center">Student</h3>
        <table class="table table-sm table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $select_student = query("select id
                                            ,   name
                                            ,   username
                                            ,   account_type
                                            ,   password 
                                        from account_list 
                                        where account_type = 'Student'");
                if ($select_student):
                    while ($row = mysqli_fetch_assoc($select_student)):
                            ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <td>
                                    <a href="index.php?edit=account&edit_id=<?php echo $row['id'] ?>&account_type=<?php echo $row['account_type'] ?>">Edit</a>
                                    <a href="index.php?delete=account&delete_id=<?php echo $row['id'] ?>&account_type=<?php echo $row['account_type'] ?>">Delete</a>
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
