<?php
include_once "base.php";

$Exp=new DB("experience");
$exp=$Exp->all();
$Pro=new DB("project");
$pro=$Pro->all();
$CTD=new DB("com_title_des");
$ctd=$CTD->all();
$a=[$exp,$pro,$ctd];

echo json_encode($a);
?>