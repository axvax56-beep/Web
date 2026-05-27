<?php 

    header("Content-Type:text/html; charset=utf-8");


    $r_name=$_POST['r_name'];
    $r_phone=$_POST['r_phone'];
    $reason=$_POST['reason'];

    $reason= nl2br($reason);
    echo "<h4>개인정보</h4>";
    echo "<p>이름: $r_name</p>";
    echo "<p>연락처: $r_phone</p>";
    echo "<h4>지원분야</h4>";

    $field=$_POST['field'];
    
    $num= count($field);
    for($i=0; $i<$num; $i++){
        echo "$field[$i],";
    }
    echo "<h4>지원 동기</h4> <p>$reason</p>";
?>