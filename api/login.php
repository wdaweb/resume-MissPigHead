<?php
include_once "base.php";

$Ad=new DB("admin");
$user=$Ad->all()[0];

if($_POST['email']==$user['email'] && $_POST['pw']==$user['pw']){
    $re=1;
    $_SESSION['admin']=1;
}else{
    $re=0;
}

echo $re;
?>