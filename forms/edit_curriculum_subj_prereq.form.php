<?php require_once 'actions/delete_curriculum_subj_prereq.php'; ?>

<?php

if(isset($_GET['edit_id'])){
        $edit_id = $_GET['edit_id'];
        $result = query("select cs.curriculum_id
                            ,   sl.subject_code
                        from curriculum_subject cs
                        inner join subject_list sl
                                on cs.subject_id = sl.id
                            where cs.id = '$edit_id'");
        if($result) {
            while($row = mysqli_fetch_assoc($result)) {
                $subject_code = $row['subject_code'];
                $curriculum_id = $row['curriculum_id'];
            }
        }
}
?>
<div class="row">
    <div class="col-md-10 m-auto">
        <?php

        if(isset($_SESSION['msg']) && isset($_SESSION['alert'])): ?>
        	<div class="alert alert-dismissible <?php echo $_SESSION['alert'] ?>">
        		<button type="button" class="close" data-dismiss="alert">&times;</button>
        		<strong><?php echo $_SESSION['msg'] ?></strong>
        	</div>
            <?php
        endif;
        ?>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
          <li class="breadcrumb-item"><a href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Curriculum Subject List</a></li>
          <li class="breadcrumb-item">Edit Curriculum Subject</li>
        </ol>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <h3 class="text-center"><?php echo $subject_code ?></h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Prerequisite Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $select_curri_subj_prereq = query("select csp.id
                                                                    , sl.subject_code
                                                            from curriculum_subj_prereq csp
                                                            left join curriculum_subject cs
                                                                    on csp.preq_subj_id = cs.id
                                                            inner join subject_list sl
                                                                    on cs.subject_id = sl.id
                                                            where csp.curriculum_subj_id = '$edit_id'");
                            if($select_curri_subj_prereq):
                                while($row = mysqli_fetch_assoc($select_curri_subj_prereq)):
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $row['subject_code'] ?></strong></td>
                                        <td width="5%">
                                            <a class="btn btn-danger" href="index.php?delete=prerequisite_subject&delete_id=<?php echo $row['id'] ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <a class="btn btn-info" href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

unset($_SESSION['msg']);
unset($_SESSION['alert']);

?>
