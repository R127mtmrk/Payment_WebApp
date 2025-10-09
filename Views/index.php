<?php
session_start();

if($_SESSION['connected'] == true){
    header('Location: dashboard.php');
    exit();
}else{
header('Location: connexion.php');
exit();
}