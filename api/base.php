<?php
date_default_timezone_set("Asia/Taipei");
session_start();

class DB{
  private $dsn="mysql:host=localhost;dbname=s1090423;charset=utf8";
  private $root="s1090423";
  private $pw="s1090423";
  private $pdo;
  private $table;

  public function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,$this->root,$this->pw);
  }

  public function all(...$arg){
    $sql="select * from $this->table";
    if(!empty($arg[0]) &&  is_array($arg[0])){
      foreach($arg[0] as $k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }
    if(!empty($arg[1])){
      $sql=$sql.$arg[1];
    }
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function count(...$arg){
    $sql="select count(*) from $this->table";
    if(!empty($arg[0]) &&  is_array($arg[0])){
      foreach($arg[0] as $k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }
    if(!empty($arg[1])){
      $sql=$sql.$arg[1];
    }
    return $this->pdo->query($sql)->fetchColumn();
  }
  
  public function find($arg){
    $sql="select * from $this->table";
    if(is_array($arg)){
      foreach($arg as $k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }else{
      $sql=$sql." where `id`='$arg'";
    }
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }
  
  public function del($arg){
    $sql="delete from $this->table";
    if(is_array($arg)){
      foreach($arg as $k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }else{
      $sql=$sql." where `id`='$arg'";
    }
    return $this->pdo->exec($sql);
  }

  public function save($arg){
    if(!empty($arg['id'])){
      foreach($arg as $k=>$v){
        if($k!="id"){
          $tmp[]=sprintf("`%s`='%s'",$k,$v);
        }
      }
      $sql="update $this->table set ".implode(",",$tmp)." where `id`='".$arg['id']."'";
    }else{
      $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) values ('".implode("','",$arg)."')";
    }
    return $this->pdo->exec($sql);
  }

  public function q($sql){
    return $this->pdo->query($sql)->fetchAll();
  }
}
function to($url){
  header("location:".$url);
}

?>