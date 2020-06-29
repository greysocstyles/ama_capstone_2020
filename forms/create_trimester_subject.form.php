<?php require_once 'actions/create_trimester_subject.php'; ?>

<?php

if (isset($_GET['trimester_id'])) {
    $trimester_id = $_GET['trimester_id'];

    $select_trimester = query("select * from trimester_list where id = '$trimester_id'");

    if($select_trimester) {
        $trimester_selected = array();
        while ($row = mysqli_fetch_assoc($select_trimester)) {
          $trimester_selected[] = $row;
        }
    }

    $select_subject_list = query("SELECT  id
                                        , subject_code
                                from subject_list
                                where subject_status = true
                                order by subject_code asc");

    if ($select_subject_list) {
        $subject_list = array();
        while ($row = mysqli_fetch_assoc($select_subject_list)) {
                $subject_list[] = $row;
        }
    }

    $select_section_list = query("SELECT id, section_code from section_list");

    if ($select_section_list) {
        $section_list = array();
        while ($row = mysqli_fetch_assoc($select_section_list)) {
            $section_list[] = $row;
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
    <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
  <li class="breadcrumb-item"><a href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Trimester Subject List</a></li>
  <li class="breadcrumb-item active">New Subject</li>
</ol>
<div class="card">
    <div class="card-body">
        <form action="index.php?new=trimester_subject&trimester_id=<?php echo $trimester_id ?>" method="POST">
            <input type="hidden" name="trimester_id" value="<?php echo $trimester_id ?>"/>
            <div class="form-row">
                <div class="form-group col-sm-8">
                    <?php

                    if (isset($trimester_selected)):
                        foreach ($trimester_selected as $row):
                                ?>
                                <h3><?php echo year_trimester($row['year']) .' '. 'Year' . ', ' . year_trimester($row['trimester']) . ' ' . 'Trimester' ?></h3>
                                <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="form-group col-sm-4">
                    <label for="num_of_trimester_subj">No. of Subject</label>
                    <input class="form-control-sm" type="number" min="1" max="10" name="num_of_trimester_subj" id="num_of_trimester_subj" placeholder="1" value="<?php if(isset($_POST['num_of_trimester_subj'])) echo $_POST['num_of_trimester_subj'] ?>">
                    <button class="btn btn-secondary" type="submit">Go</button>
                </div>
            </div>
            <div class="form-row">
                <!-- Select Subject -->
                <div class="form-group col-md-2">
                    <select class="form-control" name="subject[]">
                        <option value="">Select Subject</option>
                        <?php

                        if(isset($subject_list)):
                            foreach($subject_list as $row): ?>
                                    <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['subject'][0]) && $_POST['subject'][0] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                    <?php
                            endforeach;
                        endif;
                        ?>
                        </select>
                    </div>
                    <!-- Select Section -->
                    <div class="form-group col-md-2">
                        <select class="form-control" name="section[]">
                            <option value="">Section Section</option>
                            <?php

                            if(isset($section_list)):
                                foreach($section_list as $row): ?>
                                     <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['section'][0]) && $_POST['section'][0] == $row['id']) echo 'selected' ?>><?php echo $row['section_code'] ?></option>
                                     <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    <!-- Room -->
                    <div class="form-group col-md-2">
                        <input class="form-control" type="text" name="room[]" placeholder="Room" value="<?php if(isset($_POST['room'][0])) echo $_POST['room'][0] ?>">
                    </div>
                    <!-- Select Days -->
                    <div class="form-group col-md-2" name="days[][]">
                        <label>Mon<br>
                        <input type="checkbox" name="days[0][0]" value="Mon" <?php if(isset($_POST['days'][0][0])) echo "checked='checked'" ?>>
                        </label>
                         <label>Tue<br>
                        <input type="checkbox" name="days[0][1]" value="Tue" <?php if(isset($_POST['days'][0][1])) echo "checked='checked'" ?>>
                        </label>
                         <label>Wed<br>
                        <input type="checkbox" name="days[0][2]" value="Wed" <?php if(isset($_POST['days'][0][2])) echo "checked='checked'" ?>>
                        </label>
                         <label>Th<br>
                        <input type="checkbox" name="days[0][3]" value="Thu" <?php if(isset($_POST['days'][0][3])) echo "checked='checked'" ?>>
                        </label>
                         <label>Fri<br>
                        <input type="checkbox" name="days[0][4]" value="Fri" <?php if(isset($_POST['days'][0][4])) echo "checked='checked'" ?>>
                        </label>
                         <label>Sat<br>
                        <input type="checkbox" name="days[0][5]" value="Sat" <?php if(isset($_POST['days'][0][5])) echo "checked='checked'" ?>>
                        </label>
                    </div>
                    <!-- Time -->
                    <div class="form-group col-md-2">
                        <input class="form-control" type="text" name="time[]" placeholder="Time" value="<?php if(isset($_POST['time'][0])) echo $_POST['time'][0] ?>">
                    </div>
                    <!-- Professor -->
                    <div class="form-group col-md-2">
                        <input class="form-control" type="text" name="professor[]" placeholder="Professor" value="<?php if(isset($_POST['professor'][0])) echo $_POST['professor'][0] ?>">
                    </div>
                </div>
                <?php

                if (isset($_POST['num_of_trimester_subj'])):
                    $num_of_trimester_subj = $_POST['num_of_trimester_subj'];
                    for ($i = 1; $i < $num_of_trimester_subj; $i++): ?>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <select class="form-control" name="subject[]">
                                    <option value="">Select Subject</option>
                                    <?php

                                    if(isset($subject_list)):
                                        foreach($subject_list as $row): ?>
                                                <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['subject_code'] ?></option>
                                                <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" name="section[]">
                                        <option value="">Section Section</option>
                                        <?php

                                        if(isset($section_list)):
                                            foreach($section_list as $row): ?>
                                                 <option value="<?php echo $row['id'] ?>" <?php if(isset($_POST['section'][$i]) && $_POST['section'][$i] == $row['id']) echo 'selected' ?>><?php echo $row['section_code'] ?></option>
                                                 <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input class="form-control" type="text" name="room[]" placeholder="Room" value="<?php if(isset($_POST['room'][$i])) echo $_POST['room'][$i] ?>">
                                </div>
                                <div class="form-group col-md-2" name="days[][]">
                                    <label>Mon<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][0]" value="Mon" <?php if(isset($_POST['days'][$i][0])) echo "checked='checked'" ?>>
                                    </label>
                                     <label>Tue<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][1]" value="Tue" <?php if(isset($_POST['days'][$i][1])) echo "checked='checked'" ?>>
                                    </label>
                                     <label>Wed<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][2]" value="Wed" <?php if(isset($_POST['days'][$i][2])) echo "checked='checked'" ?>>
                                    </label>
                                     <label>Th<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][3]" value="Thu" <?php if(isset($_POST['days'][$i][3])) echo "checked='checked'" ?>>
                                    </label>
                                     <label>Fri<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][4]" value="Fri" <?php if(isset($_POST['days'][$i][4])) echo "checked='checked'" ?>>
                                    </label>
                                     <label>Sat<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][5]" value="Sat" <?php if(isset($_POST['days'][$i][5])) echo "checked='checked'" ?>>
                                    </label>
                                </div>
                                <div class="form-group col-md-2">
                                    <input class="form-control" type="text" name="time[]" placeholder="Time" value="<?php if(isset($_POST['time'][$i])) echo $_POST['time'][$i] ?>">
                                </div>
                                <div class="form-group col-md-2">
                                    <input class="form-control" type="text" name="professor[]" placeholder="Professor" value="<?php if(isset($_POST['professor'][$i])) echo $_POST['professor'][$i] ?>">
                                </div>
                            </div>
                            <?php
                        endfor;
                    endif;
                    ?>
                    <div class="form-group">
                    <?php

                    if(isset($trimester_subj_exist)): ?>
                            <strong>Subject Exist: </strong><?php
                            foreach($trimester_subj_exist as $value):
                                    $k = implode(" - ", $value); ?>
                                    <strong class="text-danger"><?php echo $k; ?></strong>,
                                <?php
                        endforeach;
                    endif;
                    ?>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4">
                            <button class="btn btn-primary" name="create_trimester_subject">Create</button>
                            <a class="btn btn-danger" href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
