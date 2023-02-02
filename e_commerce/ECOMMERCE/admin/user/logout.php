<?php
session_start();
// si on est pas co on ne doit pas accéder à cette page

if(!$_SESSION['user_id']){
    header('location: ../index.php');
}
session_destroy();

header('location: ../index.php');
?>