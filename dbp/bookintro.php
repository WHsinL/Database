<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>search.php</title>

<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/modals/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="http://www.w3schools.com/lib/w3data.js"></script>
</head>
<body>
<?php
  if ( isset($_POST["id"]) ) {
    $p=$_POST["id"];
    $page=$_POST["page"];
 ?>
<div w3-include-html="header.html"></div>
<script>
        w3IncludeHTML();
    </script>

<main>
    
      <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="library.php">Home</a></li>
            <?php if($page==1){?>
            <li class="breadcrumb-item"><a href="search.php">search</a></li>
            <?php }else if($page==2){?>
            <li class="breadcrumb-item"><a href="ranking.php">ranking</a></li>
            <?php }else if($page==3){?>
            <li class="breadcrumb-item"><a href="allbooks.php">allbooks</a></li><?php }?>
            <li class="breadcrumb-item active" aria-current="page">書籍資訊</li>
          </ol>
        </nav> 
      </div>
        <div class="container">
          <div class="row">
            <div class="col-6 col-sm-3">
              <figure class="figure">
                <img src="img/<?php echo $p?>.png" class="figure-img img-fluid rounded" alt="書的圖片">
              </figure>
            </div>
            <div class="col">
            <h3><strong>書籍資訊</strong></h3>
            <?php
                require_once 'func.php';
                $sql="SELECT * FROM books where bid='".$_POST["id"]."'";
                $link = @mysqli_connect("localhost", "root", "") 
                      or die("無法開啟MySQL資料庫連接!<br/>");
                mysqli_select_db($link, "library");
          
                $result = @mysqli_query($link, $sql);
                if ( mysqli_errno($link) != 0 ) {
                    echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
                    echo "錯誤訊息: ".mysqli_error($link)."<br/>";     
                } 
                else {
                    $total_fields = mysqli_num_fields($result);
                    $a=0;
                    $rows = mysqli_fetch_array($result, MYSQLI_NUM);?>
                    <table class="table table-bordered table-striped">
                        <tr>
                          <th scope="row">書籍編號:</th>
                          <td><?php echo $rows[0];?></td>
                        </tr>
                        <tr>
                          <th scope="row">書籍名稱:</th>
                          <td><?php echo $rows[1];?></td>
                        </tr>
                        <tr>
                          <th scope="row">作者名稱:</th>
                          <?php sql($rows[0],0,$link);?>
                        </tr>
                        <tr>
                          <th scope="row">作者國籍:</th>
                          <?php sql($rows[0],3,$link);?>
                        </tr>
                        <tr>
                          <th scope="row">書籍類型:</th>
                          <?php sql($rows[0],1,$link);?>
                        </tr>
                        <tr>
                          <th scope="row">書籍類別:</th>
                          <?php sql($rows[0],2,$link);?>
                        </tr>
                        <tr>
                          <th scope="row">出版日期:</th>
                          <td ><?php echo $rows[4];?></td>
                        </tr>
                    </table>
            </div>
          </div>
          <div class="row">
          <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                  內容大意
                </button>
              </h2>
              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body"><strong>
                <?php echo $rows[3]; ?>
                </strong>
                </div>
              </div>
            </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                作者介紹
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
              <div class="accordion-body">
                <strong><?php sql($rows[0],4,$link);?></strong>
              </div>
            </div>
          </div>
        </div>   
            <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
      </div></main>
                       
      <?php
                    $sql = "UPDATE books SET ";
                    $sql.= "count='".++$rows[2]."'";
                    $sql.= " WHERE bid = '".$rows[0]."'";
                    //echo "<b>SQL指令: $sql</b><br/>";
                    mysqli_query($link, 'SET NAMES utf8'); 
                    if ( mysqli_query($link, $sql) ) // 執行SQL指令
                        //echo "資料庫更新記錄成功, 影響記錄數: ". 
                            mysqli_affected_rows($link) . "<br/>";
                    else
                        die("資料庫更新記錄失敗<br/>");
                    mysqli_free_result($result);
                    
                }   
              } 
              else echo "no";
                    ?>
</body>
<hr>
  <center>
    <a href="allbooks.php">全部書籍</a> |
    <a href="ranking.php">排行榜</a>
</center>


</html>