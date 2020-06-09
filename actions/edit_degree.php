<?php

if (isset($_POST['edit_degree']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $edit_id = $_POST['edit_id'];
    $degree_name = strtoupper($_POST['degree_name']);
    $degree_desc = strtoupper($_POST['degree_desc']);

    if (empty($degree_name) or empty($degree_desc)) {
        $msg = 'Please fill in empty fields.';
        $alert_class = 'alert-danger';

    } elseif (!preg_match("/^[a-zA-Z\s]+$/i", $degree_name)) {
            $msg = 'Invalid characters on Degree Name.';
            $alert_class = 'alert-danger';

    } elseif (!preg_match("/^[a-zA-Z0\s]+$/i", $degree_desc)) {
            $msg = 'Invalid characters on Degree Description.';
            $alert_class = 'alert-danger';
            
    } else {
            $result = query("select degree_name
                                ,   degree_desc
                            from degree_list
                            where degree_name = '$degree_name'
                            and degree_desc = '$degree_desc'");
            $row_count = mysqli_num_rows($result);

            if($row_count > 0 ) {
                $msg = 'Degree Already Exists.';
                $alert_class = 'alert-warning';

            } else {
                    $update_degree = query("UPDATE degree_list
                                            set degree_name = '$degree_name'
                                            , degree_desc = '$degree_desc'
                                            where id = '$edit_id'");
                    if ($update_degree){
                        $_SESSION['msg'] = 'Edit Success!';
                        $_SESSION['alert'] = 'alert-info';
                        header('Location: index.php?menu=degree_list');
                        exit;
                    }
            }
        }

    }
