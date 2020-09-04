<?php

if (isset($_POST['edit_trimester_subject']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit_id = $_POST['edit_id'];
    $trimester_id = $_POST['trimester_id'];
    $subject_id = $_POST['subject_id'];
    $section_id = $_POST['section_id'];
    $room = $_POST['room'];
    $days = $_POST['days'];
    $time = $_POST['time'];
    $professor = $_POST['professor'];

    if (empty($subject_id) || empty($section_id)) {
        $msg = 'Please fill in required fields.';
        $alert_class = 'alert-danger';

    } else {
        $edit_value = query("   select  subject_id
                                    ,   section_id
                                from trimester_subject_list
                                where id = '$edit_id'
                            ");

        $days = implode(' - ', $days);

        if ($edit_value) {
            while ($row = mysqli_fetch_assoc($edit_value)) {
                $e_subject_id = $row['subject_id'];
                $e_section_id = $row['section_id'];
            }
            if ($subject_id == $e_subject_id && $section_id == $e_section_id) {
                $update_trimester_subject = query(" update trimester_subject_list 
                                                    set   room = '$room'
                                                        , days = '$days'
                                                        , time = '$time'
                                                        , professor = '$professor'
                                                    where id = '$edit_id'");
                if ($update_trimester_subject) {
                    $_SESSION['msg'] = 'Edit Success!';
                    $_SESSION['alert'] = 'alert-info';
                    header('Location: index.php?view=trimester_subject' . '&view_id=' . $trimester_id);
                    exit;
                }

            } else {
                $select_exist = query(" select  sl.subject_code
                                            ,   s.section_code
                                        from trimester_subject_list tsl
                                        inner join subject_list sl
                                                    on tsl.subject_id = sl.id
                                        inner join section_list s
                                                    on tsl.section_id = s.id
                                        where tsl.trimester_id = '$trimester_id'
                                        and tsl.subject_id = '$subject_id'
                                        and tsl.section_id = '$section_id'
                                    ");

                if ($select_exist) {
                    $row_count = mysqli_num_rows($select_exist);

                    if ($row_count > 0) {
                        $trimester_subj_exist = array();
                        while ($row = mysqli_fetch_assoc($select_exist)) {
                            $trimester_subj_exist[] = $row;
                        }

                    } else {
                        $update_trimester_subject = query(" update trimester_subject_list set
                                                                subject_id = '$subject_id'
                                                                , section_id = '$section_id'
                                                                , room = '$room'
                                                                , days = '$days'
                                                                , time = '$time'
                                                                , professor = '$professor'
                                                            where id = '$edit_id'
                                                        ");

                        if ($update_trimester_subject) {
                            $_SESSION['msg'] = 'Edit Success!';
                            $_SESSION['alert'] = 'alert-info';
                            header('Location: index.php?view=trimester_subject' . '&view_id=' . $trimester_id);
                            exit;
                        }
                    }
                }
            }
        }
    }
}
