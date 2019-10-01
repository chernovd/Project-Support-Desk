<?php

if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index2.php?login");
    exit();
    
}

// session_start();
//
//if(isset($_SESSION['u_uid']))
//{
//   
//    session_unset();
//    session_destroy();
//    header("Location: ../index2.php");
//    exit();
//}






?>