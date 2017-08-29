<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


$num = $_POST['return_num'];
$date = $_POST['return_date'];

$i=0;



while ($i < count($num)) {



  $sql = "UPDATE lend SET return_date='".$date."' WHERE num=".$num[$i]." and return_date IS NULL";
  if ($result = mysqli_query($conn, $sql)) {

    $sql = "SELECT type FROM lend WHERE num=".$num[$i];
    if($result = mysqli_query($conn, $sql)){
      $row = mysqli_fetch_assoc($result);
      $sql = "UPDATE ".$row['type']." SET current=current+1 WHERE bname = (SELECT bname FROM lend WHERE num = ".$num[$i].")";
    }
    else {
      echo "type is null";
    }



#select bname,current from ref where bname = (select bname from lend where num =3)
#update ref set current=current+1 where bname = (select bname from lend where num =3);

#    $sql = "UPDATE ref SET current=current+1 WHERE bname = (SELECT bname FROM lend WHERE num = ".$num[$i].")"; # 수정해야함!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    if ($result = mysqli_query($conn, $sql)) {
      echo "ref OK";
    }
    else {
      echo "ref not OK";
    }

  }
  else {
    echo "lend not OK";
  }



#  echo $sql;
  $i = $i + 1;
}

header('Location: lend_page.php');


 ?>
