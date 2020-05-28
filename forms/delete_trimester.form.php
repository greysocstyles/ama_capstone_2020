<?php require_once 'actions/delete_trimester.php'; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
  <li class="breadcrumb-item active">Delete Trimester</li>
</ol>
<div class="card">
  <div class="card-body bg-light">
  <?php

  if(isset($_GET['delete_id'])):
      $delete_id= $_GET['delete_id'];
      $select_tl = query("select * from trimester_list where id = '$delete_id'");
      if($select_tl):
          while($row = mysqli_fetch_assoc($select_tl)): ?>
                <form action="index.php?delete=trimester&delete_id=<?php echo $row['id'] ?>" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                    <div class="form-group">
                        <p>Are you sure you want to Delete <strong class="text-danger"><?php echo year_trimester($row['year']) . ' Year, ' . year_trimester($row['trimester']) . ' Trimester' ?></strong>?</p>
                        <button class="btn btn-danger" type="submit" name="delete_trimester">Yes</button>
                        <a class="btn btn-secondary active" href="index.php?menu=trimester_list">No</a>
                    </div>
                </form>
                <?php
          endwhile;
      endif;
  endif;
  ?>
  </div>
</div>
