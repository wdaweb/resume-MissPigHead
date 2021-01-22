<?php
include_once "base.php";

if($_SESSION['admin']){
    to("./../admin.html");
}else{
    to("./../login.html");
}
?>