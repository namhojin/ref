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

    <title>Lend</title>

    <!-- 부트스트랩 -->
    <link href="bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">


  </head>
  <body>
    <header class="page-header">
      <?php require("lib/header.php"); ?>
    </header>
    <ul class="nav nav-tabs">
      <li><a href="index.php">Current state</a></li>
      <li class="active"><a href="lend_page.php">Lend state</a></li>
    </ul>

    <ul class="nav nav-tabs">
      <?php
      if (empty($_GET['id'])==true) {
        echo "<li class='active'><a href='lend_page.php'>Reference Board</a></li>";
        echo "<li><a href='lend_page.php?id=tuner'>Tuner</a></li>";
        echo "<li><a href='lend_page.php?id=demod'>Demod</a></li>";
      }
      else {
        if($_GET['id']=='ref'){
          echo "<li class='active'><a href='lend_page.php'>Reference Board</a></li>";
          echo "<li><a href='lend_page.php?id=tuner'>Tuner</a></li>";
          echo "<li><a href='lend_page.php?id=demod'>Demod</a></li>";
        }
        elseif($_GET['id']=='tuner'){
          echo "<li><a href='lend_page.php'>Reference Board</a></li>";
          echo "<li class='active'><a href='lend_page.php?id=tuner'>Tuner</a></li>";
          echo "<li><a href='lend_page.php?id=demod'>Demod</a></li>";
        }
        elseif($_GET['id']=='demod'){
          echo "<li><a href='lend_page.php'>Reference Board</a></li>";
          echo "<li><a href='lend_page.php?id=tuner'>Tuner</a></li>";
          echo "<li class='active'><a href='lend_page.php?id=demod'>Demod</a></li>";
        }
        elseif($_GET['id']=='etc'){
          echo "<li class='active'><a href='lend_page.php'>Reference Board</a></li>";
          echo "<li><a href='lend_page.php?id=tuner'>Tuner</a></li>";
          echo "<li><a href='lend_page.php?id=demod'>Demod</a></li>";
        }
      }
       ?>
     </ul>


    <form class="form-horizontal" action="return_process.php" method="post">

      <input class="btn btn-default pull-right" type="submit" name="return_name" value="return">
      <input class="pull-right" type="date" name="return_date" value="<?php echo date('Y-m-d'); ?>">

      <table class="table table-bordered table-condensed">
        <tr>
          <th></th>
          <th>type</th>
          <th>Num</th>
          <th>Lend Date</th>
          <th>return Date</th>
          <th>Main</th>
          <th>Num</th>
          <th>Customer</th>
          <th>MStar</th>
        </tr>

        <?php
        if (empty($_GET['id'])==true) {
          $sql = "SELECT * FROM lend WHERE type='ref'";
        }
        else {
          if($_GET['id']=='ref'){
            $sql = "SELECT * FROM lend WHERE type='ref'";
          }
          elseif($_GET['id']=='tuner'){
            $sql = "SELECT * FROM lend WHERE type='tuner'";
          }
          elseif($_GET['id']=='demod'){
            $sql = "SELECT * FROM lend WHERE type='demod'";
          }
          elseif($_GET['id']=='etc'){
            $sql = "SELECT * FROM lend WHERE type='etc'";
          }
        }

        $result = mysqli_query($conn, $sql);
        while( $row = mysqli_fetch_assoc($result)){
          if (htmlspecialchars($row['return_date'])!=NULL) {
            echo "<tr bgcolor=darkgray>";
          }
          else {
            echo "<tr>";
          }
          echo "
          <td><input type='checkbox' name='return_num[]' value=".htmlspecialchars($row['num'])." ";
          if (htmlspecialchars($row['return_date'])!=NULL) {
            echo "disabled";
          }
          echo "></td>
          <td>".htmlspecialchars($row['type'])."</td>
          <td>".htmlspecialchars($row['num'])."</td>
          <td>".htmlspecialchars($row['lend_date'])."</td>
          <td>".htmlspecialchars($row['return_date'])."</td>
          <td>".htmlspecialchars($row['bname'])."</td>
          <td>".htmlspecialchars($row['bnum'])."</td>
          <td>".htmlspecialchars($row['cus'])."</td>
          <td>".htmlspecialchars($row['mstar'])."</td> </tr>";
        }
        ?>


      </table>

    </form>


    <form class="form-horizontal" action="lend_process.php" method="post">
      <div class="form-group">
        <label class='col-sm-2 control-label'>type</label>
        <div class='col-sm-10'>
          <?php
          if (empty($_GET['id'])==true) {                     #lend_page.php 일경우 ref table
            echo "<input class='form-control' type='text' name='type' value='ref' readonly>";
          }
          else {
            if($_GET['id']=='ref'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<input class='form-control' type='text' name='type' value='ref' readonly>";
            }
            elseif($_GET['id']=='tuner'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<input class='form-control' type='text' name='type' value='tuner' readonly>";
            }
            elseif($_GET['id']=='demod'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<input class='form-control' type='text' name='type' value='demod' readonly>";
            }
          }
           ?>


        </div>
      </div>
      <div class="form-group">
        <label class='col-sm-2 control-label'>Lend Date</label>
        <div class='col-sm-10'>
          <input class='form-control' type='date' name='lend_date' value="<?php echo date('Y-m-d'); ?>">
        </div>
      </div>
      <div class="form-group">
        <label class='col-sm-2 control-label'>Board(IC)</label>
        <div class='col-sm-10'>
          <select class='form-control' name='bname'>

          <?php
          if (empty($_GET['id'])==true) {                     #lend_page.php 일경우 ref table
            echo "<option disabled>Ref.Board</option>";
            $sql = "SELECT bname FROM ref GROUP BY bname";
          }
          else {
            if($_GET['id']=='ref'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<option disabled>Ref.Board</option>";
              $sql = "SELECT bname as bname FROM ref GROUP BY bname";
            }
            if($_GET['id']=='tuner'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<option disabled>Tuner.Board</option>";
              $sql = "SELECT bname as bname FROM tuner GROUP BY bname";
            }
            if($_GET['id']=='demod'){                         #lend_page.php?id=tuner 일경우 tuner table
              echo "<option disabled>Demod.Board</option>";
              $sql = "SELECT bname as bname FROM demod GROUP BY bname";
            }
          }


          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo "<option>".$row['bname']."</option>";
          }
          ?>

          </select>
        </div>

      </div>
      <div class="form-group">
        <label class='col-sm-2 control-label'>Num<br>(Not Count)</label>
        <div class='col-sm-10'>
          <input class='form-control' type='text' name='bnum' value=''>
        </div>
      </div>
      <div class="form-group">
        <label class='col-sm-2 control-label'>Customer</label>
        <div class='col-sm-10'>
          <input class='form-control' type='text' name='cus' value=''>
        </div>
      </div>
      <div class="form-group">
        <label class='col-sm-2 control-label'>MStar</label>
        <div class='col-sm-10'>
          <input class='form-control' type='text' name='mstar' value=''>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input class='btn btn-default' type='submit' name='' value='ADD' onclick='location.href='reg_board_page.php''>
        </div>
      </div>
    </form>



    <script type="text/javascript" src="js/checkbox.js"></script>

    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>

  </body>
</html>
