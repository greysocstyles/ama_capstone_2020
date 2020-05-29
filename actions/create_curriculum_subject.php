<?php

if(isset($_POST['create_curriculum_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST')  {
        $curriculum = $_POST['curriculum_id'];
        $subject = $_POST['curriculum_subj'];
        $year = $_POST['year'];
        $trimester = $_POST['trimester'];
        $insert_values_cs = array();
        $subject_count = count($subject);

        for($i = 0; $i < $subject_count; $i++) {

            $insert_values_cs[] = "('$curriculum', '$subject[$i]', '$year[$i]', '$trimester[$i]')";

        }

        $sql_cs = "INSERT INTO curriculum_subject(curriculum_id, subject_id, year, trimester) VALUES";
        $result_cs = multiple_insert($sql_cs, $insert_values_cs);

        if($result_cs) {
            $insert_values_csp = array();
            $last_id_cs = mysqli_insert_id($connect);

            for($i = 0; $i < $subject_count; $i++) {
                $insert_values_csp[] = "('$last_id_cs',  NULL)";
                $last_id_cs++;
                
            }

            $sql_csp = "INSERT into curriculum_subj_prereq(curriculum_subj_id, preq_subj_id) VALUES";
            $result_csp = multiple_insert($sql_csp, $insert_values_csp);

            if($result_csp) {
                $msg = 'create success!';
                $alert_class = 'alert-success';
                header('location: index.php?view=curriculum_subject&view_id=' . $curriculum);
                exit;
            }

        }

}