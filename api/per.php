<?php
  include_once "base.php";
  $Per=new DB("personal");
  $Cont=new DB("contact");
  $Intro=new DB("introduction");
  
  if(!empty($_POST['table'])){
    print_r($_POST);
    $_POST['data']=$data;
    $_POST['table']=$table;

    if($table=="intro"){
      foreach($data as $k => $v){
        print_r($k);
        print_r($v);
        echo "<hr>";
      }
    }


  }else{

    $Array['contact']=$Cont->all();
    $Array['intro']=$Intro->all();
    $Array['per']=$Per->all();
  
    echo json_encode($Array);

  }
