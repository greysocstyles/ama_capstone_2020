<?php

ob_start();
session_start();

require_once 'includes/db_connection.php';
require_once 'includes/functions.php';
require_once 'index.view.php'; 

ob_end_flush();