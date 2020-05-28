<?php require_once 'actions/create_student_subject.php'; ?>

<?php

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    $select_student = query("select id, usn, name from student_list where id = '$student_id'");

    if ($select_student) {
        $student_selected = array();
        while ($row = mysqli_fetch_assoc($select_student)) {
                $student_selected[] = $row;
                $student_id = $row['id'];
        }
    }

    $select_csl = query("SELECT  cs.id
                            ,    sl.subject_code
                        from curriculum_subject cs
                        inner join subject_list sl
                                    on cs.subject_id = sl.id
                        where not exists (select ss.subject_id from student_subject_list ss
                                            where ss.subject_id = cs.id
                                            and ss.student_id = '$student_id'
                                            and ss.status = 'PASS')
                        and cs.curriculum_id = (select curriculum_id from student_list
                                                where id = '$student_id')");

    if ($select_csl) {
        $curriculum_subject_list = array();
        while ($row = mysqli_fetch_assoc($select_csl)) {
                 $curriculum_subject_list[] = $row;
        }
    }

}

?>

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
  <li class="breadcrumb-item active"><a href="index.php?menu=student_list">Student List</a></li>
  <li class="breadcrumb-item active"><a href="index.php?view=student_subject&view_id=<?php echo $student_id ?>">Student Subject List</a></li>
  <li class="breadcrumb-item active">Add Student Subject</li>
</ol>
<div class="card">
    <div class="card-body">
        <form action="index.php?new=student_subject&student_id=<?php echo $student_id ?>" method="POST">
            <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
            <div class="form-row">
                <div class="form-group col-md-8">
                    <?php

                    if (isset($student_selected)):
                        foreach ($student_selected as $row):
                                ?>
                                <h3><?php echo $row['usn'] . ', ' . $row['name'] ?></h3>
                                <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="form-group col-md-4">
                    <label>No. of Subject</label>
                    <input class="form-control-sm" type="number" min="1" max="10" name="num_of_student_subject" value="<?php echo isset($_POST['num_of_student_subject']) ? $_POST['num_of_student_subject'] : 1 ?>">
                    <button class="btn btn-secondary" type="submit">Go</button>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <select class="form-control" name="subject_id[]">
                        <option value="">Select Subject</option>
                        <?php

                        if (isset($curriculum_subject_list)):
                            foreach ($curriculum_subject_list as $row):
                                    ?>
                                    <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['subject_id'][0]) && $_POST['subject_id'][0] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                    <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" name="grade[]">
                        <?php

                        $grade_list = array('A+','A','A-','B+','B','B-','C+','C','C-','F','IC','IP');

                        foreach($grade_list as $grade):
                                ?>
                                <option value="<?php echo $grade ?>" <?php if(isset($_POST['grade'][0]) && $_POST['grade'][0] == $grade) echo 'selected' ?>><?php echo $grade ?></option>
                                <?php
                        endforeach;
                        ?>
                    </select>
                    <input class="form-control" name="status[]" type="hidden" placeholder="Status">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control"  name="add_info[]" type="text" placeholder="Additional Info. (optional)">
                </div>
            </div>
            <?php

            if(isset($_POST['num_of_student_subject'])):
                for($i = 1; $i < $_POST['num_of_student_subject']; $i++): ?>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="form-control" name="subject_id[]">
                                <option value="">Select Subject</option>
                                <?php

                                if(isset($curriculum_subject_list)):
                                    foreach($curriculum_subject_list as $row):
                                            ?>
                                            <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['subject_id'][$i]) && $_POST['subject_id'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                            <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <select class="form-control" name="grade[]">
                                <?php

                                foreach($grade_list as $grade):
                                        ?>
                                        <option value="<?php echo $grade ?>" <?php if(isset($_POST['grade'][$i]) && $_POST['grade'][$i] == $grade) echo 'selected' ?>><?php echo $grade ?></option>
                                        <?php
                                endforeach;
                                ?>
                            </select>
                            <input class="form-control" name="status[]" type="hidden" placeholder="Status">
                        </div>
                        <div class="form-group col-md-4">
                            <input class="form-control"  name="add_info[]" type="text" placeholder="Additional Info. (optional)">
                        </div>
                    </div>
                    <?php
                    endfor;
                endif;
                ?>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="create_student_subject">Submit</button>
                    <a class="btn btn-danger" href="index.php?view=student_subject&view_id=<?php echo $student_id ?>">Cancel</a>
                </div>
            </form>
        </div>
    </div>
