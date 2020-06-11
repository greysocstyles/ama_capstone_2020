<?php

if (isset($_POST['create_student_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject_id'];
    $grade = $_POST['grade'];
    $status = $_POST['status'];
    $add_info = $_POST['add_info'];
    $insert_values = array();
    $subject_count = count($subject);

    for ($i = 0; $i < $subject_count; $i++) {

        if (empty($subject[$i]) || empty($grade[$i])) {
            $msg = 'Please fill in empty fields.';
            $alert_class = 'alert-warning';
            break;

        } else {
            $status[$i] = grade_status($grade[$i]);
            $insert_values[] = "(     '$student_id'
                                            , '$subject[$i]'
                                            , '$grade[$i]'
                                            , '$status[$i]'
                                            , '$add_info[$i]'
                                        )";
        }
        
    }

    $insert_values_count = count($insert_values);

    if ($insert_values_count == $subject_count) {
        $insert_header = "insert into student_subject_list (student_id, subject_id, grade, status, add_info) values ";
        $insert_student_subject = multiple_insert($insert_header, $insert_values);

        if ($insert_student_subject) {
            $_SESSION['msg'] = 'Create Success!';
            $_SESSION['alert'] = 'alert-success';
            header('Location: index.php?view=student_subject&view_id=' . $student_id);
            exit;
        }
    }
}
