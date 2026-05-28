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
    $field_str = ",";

    $num= count($field);
    for($i=0; $i<$num; $i++){
        echo "$field[$i],";
        $field_str .=$field[$i];

        if($i != $num-1){
            $field_str .=",";
        }
    }
    echo "<h4>지원 동기</h4> <p>$reason</p>";

    $db = mysqli_connect('localhost', 'axvax56', 'a1s2d3f4!', 'axvax56');

    mysqli_query($db, 'set names utf8');

    $sql ="INSERT INTO applic(r_name, r_phone, field, reason) VALUES('$r_name','$r_phone','$field_str','$reason')";
    $result=mysqli_query($db, $sql);

    if ($result){
        echo"지원서가 접수되었습니다. <br>";
    }else{
        echo"지원서 접수에 실패했습니다. 다시 시도해주세요. <br>";
    }
    mysqli_close($db);
?>