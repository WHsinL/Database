<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>show all books</title>

<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/modals/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="http://www.w3schools.com/lib/w3data.js"></script>

</head>
<body>
<div w3-include-html="header.html"></div>

<main>
<script>
  w3IncludeHTML();
</script>
        <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="library.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">排行榜</li>
          </ol>
        </nav>
        <h3>排行榜</h3>
      

<table class="table table-striped">
<thead>
          <tr>
            <th scope="col">名次</th>
            <th scope="col">書編號</th>
            <th scope="col">書名</th>
            <th scope="col">作者</th>
            <th scope="col">類別</th>
            
          </tr>
        </thead>
<?php
    require_once 'func.php';
   $sql="SELECT * FROM books ORDER BY count DESC";
   $link = @mysqli_connect("localhost", "root", "") 
         or die("無法開啟MySQL資料庫連接!<br/>");
   mysqli_select_db($link, "library");  // 選擇myschool資料庫
   // 執行SQL查詢
   $result = @mysqli_query($link, $sql);
   if ( mysqli_errno($link) != 0 ) {
      echo "錯誤代碼: ".mysqli_errno($link)."<br/>";
      echo "錯誤訊息: ".mysqli_error($link)."<br/>";     
   } 
   else {
      // 取得欄位數
      $total_fields = mysqli_num_fields($result);
      $a=0;
      while ($rows = mysqli_fetch_array($result, MYSQLI_NUM)) {
        echo "<tr><td>".++$a."</td><td>";?>
        <form action="bookintro.php" method="post">
        <input type="hidden" name="page" value="2" />
        <input type="submit" class="btn btn-link" name="id" value="<?php echo $rows[0] ?>"/></form>
        <?php
         for ( $i = 1; $i < 2; $i++ )
            echo "<td>".$rows[$i]."</td>";
        sql($rows[0],0,$link);
        sql($rows[0],1,$link);
        //sql($rows[0],2,$link);
          echo "</tr>";
      }
             
      echo "</table>";
      // 取得記錄數
      $total_records = mysqli_num_rows($result);
      echo "記錄總數: $total_records 筆<br/><br/>";
      mysqli_free_result($result);
   }   
   mysqli_close($link); // 關閉資料庫連接*/
   
   $sql = "SELECT * FROM students"; 
?>
    
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </div></main>
</body>
<hr>
  <center>
    <a href="allbooks.php">全部書籍</a> |
    <a href="ranking.php">排行榜</a>
</center>


</html>