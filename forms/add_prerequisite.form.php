<?php require_once 'actions/add_prerequisite.php'; ?>
<?php

if (isset($_GET['curriculum_subj_id'])) {
    $curriculum_subj_id = $_GET['curriculum_subj_id'];
    $select_curri_subj = query("select sl.subject_code
                                    ,  cs.id
                                    ,  cs.curriculum_id
                                from curriculum_subject cs
                                inner join subject_list sl
                                    on cs.subject_id = sl.id
                                where cs.id = '$curriculum_subj_id'");

    if ($select_curri_subj) {
        $curriculum_subject = array();

        while($row = mysqli_fetch_assoc($select_curri_subj)) {
            $curriculum_subject[] = $row;
            $curriculum_id = $row['curriculum_id'];

        }
    }

    $select_subject = query("select cs.id
                                ,   sl.subject_code
                            from curriculum_subject cs
                            inner join subject_list sl
                                on cs.subject_id = sl.id
                            where cs.curriculum_id = '$curriculum_id'");

    if ($select_subject) {
        $subject_list = array();
        
        while($row = mysqli_fetch_assoc($select_subject)) {
           $subject_list[] = $row;

       }
   }

}

?>
<div class="row">
    <div class="col-md-10 m-auto">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php?menu=curriculum_list">Curriculum List</a></li>
          <li class="breadcrumb-item"><a href="index.php?view=curriculum_subject&view_id=<?php echo $curriculum_id ?>">Curriculum Subject List</a></li>
          <li class="breadcrumb-item">Add Prerequisite</li>
        </ol>
        <div class="card">
            <div class="card-body">
            <?php

            if (isset($curriculum_subject)):
                foreach ($curriculum_subject as $row):
                        $c_id = $row['curriculum_id'];
                ?>
                <form action="index.php?new=prerequisite_subject&curriculum_subj_id=<?php echo $row['id'] ?>" method="POST">
                    <input type="hidden" name="curriculum_id" value="<?php echo $row['curriculum_id'] ?>">
                    <input type="hidden" name="curriculum_subj_id" value="<?php echo $row['id'] ?>">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <h3><?php echo $row['subject_code'] ?></h3>
                        </div>
                        <div class="form-group col-md-6">
                            <label>No. of Prerequisite</label>
                            <input class="form-control-sm" type="number" name="num_of_prereq" min="1" max="4" value="<?php echo isset($_POST['num_of_prereq']) ? $_POST['num_of_prereq'] : 1 ?>">
                            <button class="btn btn-secondary" type="submit">Go</button>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <select class="form-control" name="prerequisite_subject[]">
                                <option value="">Select Prerequisite Subject</option>
                                <?php

                                if(isset($subject_list)):
                                    foreach($subject_list as $row):
                                        ?>
                                        <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['prerequisite_subject'][0]) && $_POST['prerequisite_subject'][0] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php

                    if(isset($_POST['num_of_prereq'])):
                        for($i = 1; $i < $_POST['num_of_prereq']; $i++):
                            ?>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="prerequisite_subject[]">
                                        <option value="">Select Prerequisite Subject</option>
                                        <?php

                                        if(isset($subject_list)):
                                            foreach($subject_list as $row):
                                                ?>
                                                <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['prerequisite_subject'][$i]) && $_POST['prerequisite_subject'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                        endfor;
                    endif;
                    ?>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" name="add_prerequisite">Add</button>
                        <a class="btn btn-danger" href="index.php?view=curriculum_subject&view_id=<?php echo $c_id ?>">Cancel</a>
                    </div>
                </form>
                <?php
                endforeach;
            endif;
            ?>
            </div>
        </div>
    </div>
</div>
