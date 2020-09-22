<?php require_once 'actions/create_trimester_subject.php'; ?>

<?php

if (isset($_GET['trimester_id'])) {
    $trimester_id = $_GET['trimester_id'];

    $trimester_selected = query("SELECT * FROM trimester_list where id = '$trimester_id'");

    $subject_list = query(" SELECT  id
                                ,   subject_code
                            FROM subject_list
                            where subject_status = true
                            order by subject_code asc");

    $section_list = query("SELECT s.id, s.section_code, dl.degree_name FROM section_list s inner join degree_list dl where s.degree_id = dl.id");

    if ($subject_list) {
        while ($row = mysqli_fetch_assoc($subject_list)) {
                $subjects[] = $row;
        }
    }

    if ($section_list) {
        while ($row = mysqli_fetch_assoc($section_list)) {
                $sections[] = $row;
        }
    }

}

?>
<!-- alert msg -->
<?php 

if (isset($msg) && isset($alert_class)) : ?>

    <div class="alert alert-dismissible <?php echo $alert_class ?>">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $msg ?></strong>
    </div>

<?php endif; ?>
<!-- end of alert msg -->

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?menu=trimester_list">Trimester List</a></li>
  <li class="breadcrumb-item"><a href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Trimester Subject List</a></li>
  <li class="breadcrumb-item active">New Subject</li>
</ol>

<!-- card-div -->
<div class="card">
    <div class="card-body">
        <form action="index.php?new=trimester_subject&trimester_id=<?php echo $trimester_id ?>" method="POST">
            <input type="hidden" name="trimester_id" value="<?php echo $trimester_id ?>"/>
            <div class="form-row">
                <div class="form-group col-sm-8">
                    <?php

                    if ($trimester_selected):
                        while ($trimester = mysqli_fetch_assoc($trimester_selected)) : ?>

                                <h3>
                                    <?php echo year_trimester($trimester['year']) .' '. 'Year' . ', ' . year_trimester($trimester['trimester']) . ' ' . 'Trimester' ?> 
                                </h3>
                                <?php
                        endwhile;
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

                            <?php foreach ($subjects as $subject) : ?>

                                    <option value="<?php echo $subject['id'] ?>" <?php if(isset($_POST['subject'][0]) && $_POST['subject'][0] == $subject['id']) echo 'selected' ?>><?php echo $subject['subject_code'] ?></option>

                            <?php endforeach; ?>
                    </select>
                </div>
                <!-- Select Section -->
                <div class="form-group col-md-2">
                    <select class="form-control" name="section[]">
                        <option value="">Section Section</option>

                            <?php foreach ($sections as $section) : ?>

                                    <option value="<?php echo $section['id'] ?>" <?php if(isset($_POST['section'][0]) && $_POST['section'][0] == $section['id']) echo 'selected' ?>><?php echo $section['section_code'] .' - '. $section['degree_name'] ?></option>

                            <?php endforeach; ?>
                    </select>
                </div>
                <!-- Room -->
                <div class="form-group col-md-2">
                    <input class="form-control" type="text" pattern="[a-zA-Z0-9 ]+" name="room[]" placeholder="Room" value="<?php if(isset($_POST['room'][0])) echo $_POST['room'][0] ?>">
                </div>
                <!-- Select Days -->
                <div class="form-group col-md-2" name="days[][]">
                    <label>Mon<br>
                        <input type="checkbox" name="days[0][0]" value="Mon" <?php if(isset($_POST['days'][0][0])) echo 'checked' ?>>
                    </label>

                    <label>Tue<br>
                        <input type="checkbox" name="days[0][1]" value="Tue" <?php if(isset($_POST['days'][0][1])) echo 'checked' ?>>
                    </label>

                    <label>Wed<br>
                        <input type="checkbox" name="days[0][2]" value="Wed" <?php if(isset($_POST['days'][0][2])) echo 'checked' ?>>
                    </label>

                    <label>Th<br>
                        <input type="checkbox" name="days[0][3]" value="Thu" <?php if(isset($_POST['days'][0][3])) echo 'checked' ?>>
                    </label>

                    <label>Fri<br>
                        <input type="checkbox" name="days[0][4]" value="Fri" <?php if(isset($_POST['days'][0][4])) echo 'checked' ?>>
                    </label>

                    <label>Sat<br>
                        <input type="checkbox" name="days[0][5]" value="Sat" <?php if(isset($_POST['days'][0][5])) echo 'checked' ?>>
                    </label>
                </div>
                <!-- Time -->
                <div class="form-group col-md-2">
                    <input class="form-control" type="text" pattern="((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))-((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))" name="time[]" placeholder="Time" value="<?php if(isset($_POST['time'][0])) echo $_POST['time'][0] ?>">
                </div>
                <!-- Professor -->
                <div class="form-group col-md-2">
                    <input class="form-control" type="text" name="professor[]" placeholder="Professor" value="<?php if(isset($_POST['professor'][0])) echo $_POST['professor'][0] ?>">
                </div>
            </div>

            <!-- multiple rows -->
            <?php

            if (isset($_POST['num_of_trimester_subj'])) :
                $num_of_trimester_subj = $_POST['num_of_trimester_subj'];
                for ($i = 1; $i < $num_of_trimester_subj; $i++) : ?>
                        <div class="form-row">
                            <!-- subject -->
                            <div class="form-group col-md-2">
                                <select class="form-control" name="subject[]">
                                    <option value="">Select Subject</option>

                                    <?php foreach ($subjects as $subject) : ?>

                                            <option value="<?php echo $subject['id'] ?>" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == $subject['id']) echo 'selected' ?>>
                                                <?php echo $subject['subject_code'] ?>
                                            </option>

                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- section -->
                            <div class="form-group col-md-2">
                                <select class="form-control" name="section[]">
                                    <option value="">Section Section</option>

                                    <?php foreach ($sections as $section) : ?>

                                            <option value="<?php echo $section['id'] ?>" <?php if(isset($_POST['section'][$i]) && $_POST['section'][$i] == $section['id']) echo 'selected' ?>>
                                                <?php echo $section['section_code'] .' - '. $section['degree_name'] ?>
                                            </option>

                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <!-- room -->
                            <div class="form-group col-md-2">
                                <input class="form-control" type="text" name="room[]" pattern="[a-zA-Z0-9 ]+" placeholder="Room" value="<?php if(isset($_POST['room'][$i])) echo $_POST['room'][$i] ?>">
                            </div>
                            <!-- days -->
                            <div class="form-group col-md-2" name="days[][]">
                                <label>Mon<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][0]" value="Mon" <?php if(isset($_POST['days'][$i][0])) echo 'checked' ?>>
                                </label>

                                <label>Tue<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][1]" value="Tue" <?php if(isset($_POST['days'][$i][1])) echo 'checked' ?>>
                                </label>

                                <label>Wed<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][2]" value="Wed" <?php if(isset($_POST['days'][$i][2])) echo 'checked' ?>>
                                </label>

                                <label>Th<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][3]" value="Thu" <?php if(isset($_POST['days'][$i][3])) echo 'checked' ?>>
                                </label>

                                <label>Fri<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][4]" value="Fri" <?php if(isset($_POST['days'][$i][4])) echo 'checked' ?>>
                                </label>
                                    
                                <label>Sat<br>
                                    <input type="checkbox" name="days[<?php echo $i ?>][5]" value="Sat" <?php if(isset($_POST['days'][$i][5])) echo 'checked' ?>>
                                </label>
                            </div>
                            <!-- time -->
                            <div class="form-group col-md-2">
                                <input class="form-control" type="text" pattern="((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))-((1[0-2]|0?[1-9]):([0-5][0-9]) ?([AaPp][Mm]))" name="time[]" placeholder="Time" value="<?php if(isset($_POST['time'][$i])) echo $_POST['time'][$i] ?>">
                            </div>
                            <!-- professor -->
                            <div class="form-group col-md-2">
                                <input class="form-control" type="text" name="professor[]" placeholder="Professor" value="<?php if(isset($_POST['professor'][$i])) echo $_POST['professor'][$i] ?>">
                            </div>
                        </div>
                    <?php
                endfor;
            endif;
            ?>
            <!-- end of multiple rows -->

            <!-- error msg -->
            <div class="form-group">
                <?php if (isset($trimester_subj_exist)) : ?>
                            
                            <strong>Subject Exist: </strong>
                            
                            <?php foreach ($trimester_subj_exist as $value): ?>

                                    <strong class="text-danger"><?php echo implode(' - ', $value); ?></strong>&nbsp;&nbsp;&nbsp;

                            <?php endforeach; ?>

                <?php endif; ?>
            </div>
            <!-- end of error msg -->

            <!-- create trimester subject -->
            <div class="form-row">
                <div class="col-md-4">
                    <button class="btn btn-primary" name="create_trimester_subject">Create</button>
                    <a class="btn btn-danger" href="index.php?view=trimester_subject&view_id=<?php echo $trimester_id ?>">Cancel</a>
                </div>
            </div>
            <!-- end of create trimester subject -->
        </form>
    </div>
</div>
<!-- end of card-div -->