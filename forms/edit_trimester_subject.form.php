<?php require_once 'actions/edit_trimester_subject.php'; ?>

<?php

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $select_tsl = query("SELECT   tsl.id
                            ,     tsl.trimester_id
                            ,     tsl.subject_id
                            ,     tsl.section_id
                            ,     tsl.room
                            ,     tsl.days
                            ,     tsl.time
                            ,     tsl.professor
                        FROM   trimester_subject_list tsl
                        INNER  JOIN subject_list sl ON
                              tsl.subject_id = sl.id
                        INNER  JOIN section_list s ON
                              tsl.section_id = s.id
                        WHERE  tsl.id = '$edit_id'");

    if ($select_tsl) {
        $trimester_subject_list = array();
        while ($row = mysqli_fetch_assoc($select_tsl)) {
                $trimester_subject_list[] = $row;
                $trimester_id = $row['trimester_id'];
        }
    }


}

?>

<?php

if (isset($msg) && isset($alert_class)) : ?>
    <div class="alert alert-dismissible <?php echo $alert_class ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $msg ?></strong>
    </div>
    <?php
endif;
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
    <li class="breadcrumb-item"><a href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Trimester Subject List</a></li>
    <li class="breadcrumb-item active">Edit Trimester Subject</li>
</ol>
<div class="card">
    <div class="card-body">
        <div class="card-title"><h2>Edit Trimester Subject</h2></div>
            <?php

            if(isset($trimester_subject_list)):
                foreach($trimester_subject_list as $row):
                ?>
                <form action="index.php?edit=trimester_subject&edit_id=<?php echo $row['id'] ?>" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                    <input type="hidden" name="trimester_id" value="<?php echo $row['trimester_id'] ?>">
                    <div class="form-row mt-4">
                        <div class="form-group col-md-6">
                            <label>Subject</label>
                            <select class="form-control" name="subject_id">
                                <?php

                                $subject_list = query("select id, subject_code from subject_list");

                                if ($subject_list) :
                                     while ($subj = mysqli_fetch_assoc($subject_list)): ?>
                                            <option value="<?php echo $subj['id'] ?>" <?php if (isset($row['subject_id']) && $row['subject_id'] == $subj['id']) echo 'selected' ?>><?php echo $subj['subject_code'] ?></option>
                                         <?php
                                     endwhile;
                                endif;
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Section</label>
                            <select class="form-control" name="section_id">
                                <?php

                                $section_list = query("select * from section_list");

                                if ($section_list) :
                                    while ($sec = mysqli_fetch_assoc($section_list)) :
                                        ?>
                                        <option value="<?php echo $sec['id'] ?>" <?php if (isset($row['section_id']) && $row['section_id'] == $sec['id']) echo 'selected' ?>><?php echo $sec['section_code'] ?></option>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Room</label>
                            <input class="form-control" type="text" name="room" value="<?php echo $row['room'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Days</label>
                            <input class="form-control" type="text" name="days" value="<?php echo $row['days'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Time</label>
                            <input class="form-control" type="text" name="time" value="<?php echo $row['time'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Professor</label>
                            <input class="form-control" type="text" name="professor" value="<?php echo $row['professor'] ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <?php 
                            if (isset($trimester_subj_exist)):
                                echo 'Subject Exist: ';
                                foreach ($trimester_subj_exist as $value):
                                        ?>
                                        <strong class="text-danger"><?php echo $value['subject_code'] . ' - ' . $value['section_code'] ?></strong>
                                        <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <button class="btn btn-info" type="submit" name="edit_trimester_subject">Udpate</button>&nbsp;
                            <a class="btn btn-danger" href="index.php?view=trimester_subject&view_id=<?php echo $row['trimester_id'] ?>">Cancel</a>
                        </div>
                    </div>
                </form>
                <?php
            endforeach;
        endif;
        ?>
    </div>
</div>
