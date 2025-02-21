<?php
if($_SESSION['role'] !== ROLE_ADMIN){
    header('location: index.php');
    //faire le bon chemin
}