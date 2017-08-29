<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reference Board</title>

    <!-- 부트스트랩 -->
    <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <header class="page-header">
      <a href="http://192.168.123.200/mkb/projects/mkb/wiki"><img src="img/1276962_MStarLogo.jpg" alt=""></a>
    </header>

    <ul class="nav nav-tabs">
      <li class="active"><a href="index.php">Current state</a></li>
      <li><a href="lend_page.php">Lend state</a></li>
    </ul>

    <ul class="nav nav-tabs">
    <?php
    if (empty($_GET['id'])==true) {
      echo "<li class='active'><a href='index.php'>Reference Board</a></li>";
      echo "<li><a href='index.php?id=tuner'>Tuner</a></li>";
      echo "<li><a href='index.php?id=demod'>Demod</a></li>";
    }
    else {
      if($_GET['id']=='ref'){
        echo "<li class='active'><a href='index.php'>Reference Board</a></li>";
        echo "<li><a href='index.php?id=tuner'>Tuner</a></li>";
        echo "<li><a href='index.php?id=demod'>Demod</a></li>";
      }
      elseif($_GET['id']=='tuner'){
        echo "<li><a href='index.php'>Reference Board</a></li>";
        echo "<li class='active'><a href='index.php?id=tuner'>Tuner</a></li>";
        echo "<li><a href='index.php?id=demod'>Demod</a></li>";
      }
      elseif($_GET['id']=='demod'){
        echo "<li><a href='index.php'>Reference Board</a></li>";
        echo "<li><a href='index.php?id=tuner'>Tuner</a></li>";
        echo "<li class='active'><a href='index.php?id=demod'>Demod</a></li>";
      }
      elseif($_GET['id']=='etc'){
        echo "<li class='active'><a href='index.php'>Reference Board</a></li>";
        echo "<li><a href='index.php?id=tuner'>Tuner</a></li>";
        echo "<li><a href='index.php?id=demod'>Demod</a></li>";
      }
    }
     ?>

    </ul>


    <input class="btn btn-default pull-right" type="button" name="" value="Register a board" onclick="location.href='reg_board_page.php?type=ref'">

    <table class="table table-bordered table-condensed">

      <?php
      if (empty($_GET['id'])==true) {
        echo "
        <tr>
          <th>ref.board name</th>
          <th>Total</th>
          <th>Lend</th>
          <th>Remain</th>
        </tr>";

#        $sql = "SELECT ref.bname,ref.total,ref.current,a.lend from ref left join (SELECT bname,count(bname) AS lend FROM lend GROUP BY bname)a ON ref.bname = a.bname";
        $sql = "SELECT bname,total,current,total-current AS lend FROM ref";
        $result = mysqli_query($conn, $sql);
        while( $row = mysqli_fetch_assoc($result)){
          echo "<tr><td>".htmlspecialchars($row['bname'])."</td> <td>".htmlspecialchars($row['total'])."</td> <td>".htmlspecialchars($row['lend'])."</td> <td>".htmlspecialchars($row['current'])."</td> </tr>";
        }
      }
      else {
        if (strcmp($_GET['id'],'ref')==false) {
          echo "
          <tr>
            <th>ref.board name</th>
            <th>Total</th>
            <th>Lend</th>
            <th>Remain</th>
          </tr>";

  #        $sql = "SELECT ref.bname,ref.total,ref.current,a.lend from ref left join (SELECT bname,count(bname) AS lend FROM lend GROUP BY bname)a ON ref.bname = a.bname";
          $sql = "SELECT bname,total,current,total-current AS lend FROM ref";
          $result = mysqli_query($conn, $sql);
          while( $row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".htmlspecialchars($row['bname'])."</td> <td>".htmlspecialchars($row['total'])."</td> <td>".htmlspecialchars($row['lend'])."</td> <td>".htmlspecialchars($row['current'])."</td> </tr>";
          }
        }

        elseif (strcmp($_GET['id'],'tuner')==false) {
          echo "
          <tr>
            <th>tuner.board name</th>
            <th>Total</th>
            <th>Lend</th>
            <th>Remain</th>
          </tr>";

  #        $sql = "SELECT ref.bname,ref.total,ref.current,a.lend from ref left join (SELECT bname,count(bname) AS lend FROM lend GROUP BY bname)a ON ref.bname = a.bname";
          $sql = "SELECT bname,total,current,total-current AS lend FROM tuner";
          $result = mysqli_query($conn, $sql);
          while( $row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".htmlspecialchars($row['bname'])."</td> <td>".htmlspecialchars($row['total'])."</td> <td>".htmlspecialchars($row['lend'])."</td> <td>".htmlspecialchars($row['current'])."</td> </tr>";
          }
        }
        elseif (strcmp($_GET['id'],'demod')==false) {
          echo "
          <tr>
            <th>demod.board name</th>
            <th>Total</th>
            <th>Lend</th>
            <th>Remain</th>
          </tr>";

  #        $sql = "SELECT ref.bname,ref.total,ref.current,a.lend from ref left join (SELECT bname,count(bname) AS lend FROM lend GROUP BY bname)a ON ref.bname = a.bname";
          $sql = "SELECT bname,total,current,total-current AS lend FROM demod";
          $result = mysqli_query($conn, $sql);
          while( $row = mysqli_fetch_assoc($result)){
            echo "<tr><td>".htmlspecialchars($row['bname'])."</td> <td>".htmlspecialchars($row['total'])."</td> <td>".htmlspecialchars($row['lend'])."</td> <td>".htmlspecialchars($row['current'])."</td> </tr>";
          }
        }
      }

      ?>


    </table>

    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

  </body>
</html>
