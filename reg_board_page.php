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

    <title>reg_board</title>

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
      <li><a href="return_page.php">Return</a></li>
    </ul>


    <article>
      <form class="form-horizontal" action="reg_board_process.php" method="post">

        <div class='form-group'>
          <label class='col-sm-2 control-label'>type</label>
          <div class='col-sm-10'>
            <select class="form-control" name="type" onchange="if(this.value) window.location.href='reg_board_page.php?type='+this.value">
              <?php
              if(empty($_GET['type'])===true){
                echo "<option value='ref' selected='selected'>Reference Board</option>";
                echo "<option value='tuner'>Tuner Board</option>";
                echo "<option value='demod'>Demod Board</option>";
                echo "<option value='etc'>etc</option>";
              }
              else {
                if ($_GET['type']=='ref') {
                  echo "<option value='ref' selected='selected'>Reference Board</option>";
                  echo "<option value='tuner'>Tuner Board</option>";
                  echo "<option value='demod'>Demod Board</option>";
                  echo "<option value='etc'>etc</option>";
                }
                elseif ($_GET['type']=='tuner') {
                  echo "<option value='ref'>Reference Board</option>";
                  echo "<option value='tuner' selected='selected'>Tuner Board</option>";
                  echo "<option value='demod'>Demod Board</option>";
                  echo "<option value='etc'>etc</option>";
                }
                elseif ($_GET['type']=='demod') {
                  echo "<option value='ref'>Reference Board</option>";
                  echo "<option value='tuner'>Tuner Board</option>";
                  echo "<option value='demod' selected='selected'>Demod Board</option>";
                  echo "<option value='etc'>etc</option>";
                }
                elseif ($_GET['type']=='etc') {
                  echo "<option value='ref'>ref</option>";
                  echo "<option value='tuner'>tuner</option>";
                  echo "<option value='demod'>demod</option>";
                  echo "<option value='etc' selected='selected'>etc</option>";
                }
              }
               ?>

            </select>
          </div>

        </div>

          <?php
          if(empty($_GET['id'])===true){
            echo "
              <div class='form-group'>
              <label class='col-sm-2 control-label'>
              Board Name(IC)</label>
              <div class='col-sm-10'>
              <select class='form-control' name='bname'>";

#              $sql = "SELECT bname FROM ref GROUP BY bname";

              $sql = "SELECT bname FROM ".$_GET['type']." GROUP BY bname";
              $result = mysqli_query($conn, $sql);
              if(empty($_GET['type'])===true){
                echo "<option disabled>Ref.Board</option>";
              }
              else {
                if ($_GET['type']=='ref') {
                  echo "<option disabled>Ref.Board</option>";
                }
                elseif ($_GET['type']=='tuner') {
                  echo "<option disabled>Tuner.Board</option>";
                }
                elseif ($_GET['type']=='demod') {
                  echo "<option disabled>Demod.Board</option>";
                }
                elseif ($_GET['type']=='etc') {
                  echo "<option disabled>Etc</option>";
                }
              }
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option>".$row['bname']."</option>";
              }

              echo "
              </select>
              <a href='reg_board_page.php?type=";
              echo $_GET['type']."&id=1'>If not, Click here</a><br>
              </div>

            </div>";

          }
          else {
            if ($_GET['id']==1) {
              echo "
              <div class='form-group'>
                <label class='col-sm-2 control-label'>Board Name(IC)</label>
                <div class='col-sm-10'>
                <input class='form-control' type='text' name='bname'>
                <a href='reg_board_page.php?type=";
                echo $_GET['type']."'>Back</a><br>
                </div>

              </div>";
            }
            else {
              echo "false";
            }

          }
           ?>

        <div class='form-group'>

          <label class='col-sm-2 control-label'>DATE</label>
          <div class='col-sm-10'>
            <input class='form-control' type="date" name="date" value="<?php echo date('Y-m-d'); ?>">
          </div>


        </div>
        <div class='form-group'>

          <label class='col-sm-2 control-label'>Count</label>
          <div class='col-sm-10'>
            <input class='form-control' type="number" name="count" min="1" value="1">
          </div>

        </div>

        <div class='form-group'>
          <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-default" type="submit" name="name" value="Register">
          </div>
        </div>
      </form>
    </article>

    <!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
    <script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>
