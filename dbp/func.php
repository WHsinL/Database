<?php
function sql($str,$tt,$link) {
    switch ($tt) {
        case 0://writer
            $sql2="SELECT name  FROM writer WHERE wid=any(SELECT wid FROM wbrelation where bid=$str)";
            break;
        case 1:
            $sql2="SELECT cname FROM bookcategory where cid=any(SELECT cid FROM cbrelation where bid=$str)";
            break;
        case 2:
            $sql2="SELECT typename FROM booktype where tid=any(SELECT tid FROM tbrelation where bid=$str)";
            break;
        case 3://wconutry
            $sql2="SELECT DISTINCT country FROM writer WHERE wid=any(SELECT wid FROM wbrelation where bid=$str)";
            break;
        default:
            $sql2="SELECT introduction FROM writer WHERE wid=any(SELECT wid FROM wbrelation where bid=$str)";
    }
    //echo "<br>".$sql2;
    $r2= @mysqli_query($link, $sql2);
    $t2 = mysqli_num_fields($r2);
    $total_records = mysqli_num_rows($r2);
    //echo "記錄總數: $total_records 筆<br/><br/>";
    echo "<td>";
    while ($a2 = mysqli_fetch_array($r2, MYSQLI_NUM)) {
        echo $a2[0];
        if($tt>3)return $a2[0];
        if(--$total_records!=0)echo ",  ";
        $s=$a2[0];
    
    }echo "</td>";
    mysqli_free_result($r2);
}

function search($i,$str) {
    switch ($i) {
        case 1://用bname查
            $sql="SELECT bid  FROM books WHERE bname like '%".$str."%'";
            break;
        case 2://用wname查
            $sql="SELECT bid FROM wbrelation where wid=any(SELECT wid FROM writer where name like '%".$str."%')";
            break;
        case 3://用wcountry查
            $sql="SELECT bid FROM wbrelation where wid=any(SELECT wid FROM writer where country like '%".$str."%')";
            break;
        case 4://用cid查
            $sql="SELECT bid FROM cbrelation where cid='".$str."'";
            break;
        default://用tid查
            $sql="SELECT bid FROM tbrelation where tid='".$str."'";
            break;

        /*default:
            $sql="";*/
    }
    return $sql;
}

function typecheck() {
    for($i=1;$i<=11;$i++){
        if(isset($_POST["type".$i]))return false;
    }
    return true;
}
?>