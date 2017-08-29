<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$type = mysqli_real_escape_string($conn, $_POST['type']);
$bname = mysqli_real_escape_string($conn, $_POST['bname']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$count = mysqli_real_escape_string($conn, $_POST['count']);

if ($type == 'ref') {
  $sql = "INSERT INTO `get_ref` (`bname`,`date`, `count`) VALUES('".$bname."','".$date."',".$count.")";
  $result = mysqli_query($conn, $sql);

  $sql = "SELECT * FROM ref WHERE bname='".$bname."'";
  if($result = mysqli_query($conn,$sql)){

    if($result->num_rows == 0){
      $sql = "INSERT INTO `ref` (`bname`, `total`,`current`) VALUES('".$bname."',".$count.",".$count.")";
      echo "$sql";
    }
    else {
      $sql = "UPDATE ref SET total=total+".$count.", current=current+".$count." WHERE bname = '".$bname."'";
      echo "$sql";
    }

    if($result = mysqli_query($conn,$sql)){
      echo "OK";
    }
    else{
      echo "not OK";
    }
  }
  header('Location: index.php');
}
elseif ($type == 'tuner') {
  $sql = "SELECT * FROM tuner WHERE bname='".$bname."'";
  if($result = mysqli_query($conn,$sql)){

    if($result->num_rows == 0){
      $sql = "INSERT INTO `tuner` (`bname`, `total`,`current`) VALUES('".$bname."',".$count.",".$count.")";
      echo "$sql";
    }
    else {
      $sql = "UPDATE tuner SET total=total+".$count.", current=current+".$count." WHERE bname = '".$bname."'";
      echo "$sql";
    }

    if($result = mysqli_query($conn,$sql)){
      echo "OK";
    }
    else{
      echo "not OK";
    }
  }
  header('Location: index.php?id=tuner');

}








 ?>
