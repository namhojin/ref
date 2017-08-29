<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$type = mysqli_real_escape_string($conn, $_POST['type']);
$bname = mysqli_real_escape_string($conn, $_POST['bname']);
$lend_date = mysqli_real_escape_string($conn, $_POST['lend_date']);
$bnum = mysqli_real_escape_string($conn, $_POST['bnum']);
$cus = mysqli_real_escape_string($conn, $_POST['cus']);
$mstar = mysqli_real_escape_string($conn, $_POST['mstar']);



var_dump($type);

if(strcmp($bnum,"0")&&strcmp($bnum,null)){
  $sql = "INSERT INTO `lend` (`type`, `bname`, `lend_date`, `bnum`, `cus`, `mstar`) VALUES('".$type."','".$bname."','".$lend_date."','".$bnum."','".$cus."', '".$mstar."')";
}
else {
  $sql = "INSERT INTO `lend` (`type`, `bname`, `lend_date`, `cus`, `mstar`) VALUES('".$type."','".$bname."','".$lend_date."','".$cus."', '".$mstar."')";
}

echo "$sql";

if($result = mysqli_query($conn,$sql)){
  if (strcmp($type,'ref')==false) {
    $sql = "UPDATE ref SET current=current-1 WHERE bname = '".$bname."'";
  }
  elseif (strcmp($type,'tuner')==false) {
    $sql = "UPDATE tuner SET current=current-1 WHERE bname = '".$bname."'";
  }
  elseif (strcmp($type,'demod')==false) {
    $sql = "UPDATE demod SET current=current-1 WHERE bname = '".$bname."'";
  }
  elseif (strcmp($type,'etc')==false) {
    $sql = "UPDATE etc SET current=current-1 WHERE bname = '".$bname."'";
  }


  if($result = mysqli_query($conn,$sql)){
    echo "OK";

  }
  else {
    echo "not OK";
  }

  echo "OK";
}
else{
  echo "not OK";
}





$tmp = "Location: lend_page.php?id=".$type;
header($tmp);


 ?>
