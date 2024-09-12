<!DOCTYPE html>
<html>    
  <head>
    <meta charset="utf-8" />

    <title>Database Library</title>
    <script src="http://www.w3schools.com/lib/w3data.js"></script>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
  <?php
    require_once 'func.php';
    if ( isset($_POST["submit"]) ) {
      //echo is_null($_POST["type1"]);
      if($_POST["bname"]=="" && $_POST["bid"]=="" && $_POST["wname"]=="" 
      && $_POST["wcountry"]=="" && $_POST["category"]=="" && typecheck())
      {?>
          <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <center><strong>至少填寫一格!</strong></center>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    <?php  }
      else{
          session_start();
          $_SESSION["temp"]=array($_POST["bid"],$_POST["bname"] ,$_POST["wname"],$_POST["wcountry"]
          ,$_POST["category"]);
        
          for( $i=1;$i<=11;$i++){
            $s="type".$i;
            array_push($_SESSION["temp"], $_POST[$s]);
            print_r($_SESSION["temp"]);
          }
          
        header("Location: search.php");

                      
        }


    } ?>
    <main>
    <div w3-include-html="header.html"></div>

    <script>
      w3IncludeHTML();
    </script>
      <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
          </ol>
        </nav>
      </div>

<center><h2>書籍查詢</h2><!--主題-->
        <form id="entryForm" action="library.php" method="post" enctype="multipart/form-data"><!--表單--><!--加enctype那個才可將資料上傳-->
        
        <table class="entryTable">
            
            <tr>
                <th>書編號 </th>
                <td><input type="text" name="bid" ></td>
            </tr>
            <tr>
                <th>書名</th>
                <td><input type="text" name="bname" ></td>
            </tr>
            <tr>
                <th>作者名 </th>
                <td><input type="text" name="wname" ></td>
            </tr>
            <tr>
                <th>作者國籍</th>
                <td><input type="text" name="wcountry" ></td>
            </tr>
            <tr>
                <th>類型</th>
                <td>
                    <select name="category">
                      <option value="" selected>請選擇</option><!--(空的代表沒有傳資訊)-->
                      <option value="0">參考書</option>
                      <option value="1">小說</option>
                      <option value="2">雜誌</option>
                      <option value="3">電影</option>
                      <option value="4">漫畫</option>
                      <option value="5">其他</option>
                    </select>
                </td>
            </tr>
            <tr><br>
                <th><br>類別</th>
                <td><br>
                <input type="checkbox" name="type1" value="1" />溫馨
                <input type="checkbox" name="type2" value="2"/>愛情
                <input type="checkbox" name="type3" value="3"/>驚悚
                <input type="checkbox" name="type4" value="4" />奇幻<br>
                <input type="checkbox" name="type5" value="5"/>語文
                <input type="checkbox" name="type6" value="6"/>數學
                <input type="checkbox" name="type7" value="7" />懸疑
                <input type="checkbox" name="type8" value="8"/>推理<br>
                <input type="checkbox" name="type9" value="9"/>冒險
                <input type="checkbox" name="type10" value="10" />諷刺
                <input type="checkbox" name="type11" value="11"/>喜劇<br>
                </td>
            </tr>
            
        </table><br>
        <div class="entryBtns">
            <input type="reset" class="btn btn-warning" value="清除">
            <input type="submit" class="btn btn-primary" name="submit" value="查詢">
            <!--<input type="submitbutton" value="送出">-->
        </div>

    </form></center>
    
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    
  </body>
  <hr>
  <center>
    <a href="allbooks.php">全部書籍</a> |
    <a href="ranking.php">排行榜</a>
</center>
</html>