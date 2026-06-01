<?php

    header("Content-Type:text/html; charset=utf-8");

    $r_name= $_POST['r_name'];
    $r_phone= $_POST['r_phone'];
    $r_email= $_POST['r_email'];
    $now= date('Y-m-d H:i:s');

    echo "<p> 이 름: $r_name </p>";
    echo "<p> 전 화: $r_phone </p>";
    echo "<p> 이메일: $r_email </p>";
    echo "<p> 예약 날짜: $now </p>";

    $db= mysqli_connect('localhost', 'axvax56', 'a1s2d3f4!', 'axvax56');

    mysqli_query($db, 'set names utf8');

    $sql ="INSERT INTO reservation(r_name, r_phone, r_email, date) VALUES('$r_name','$r_phone','$r_email', '$now')";
    $result=mysqli_query($db, $sql);
    if ($result){
        echo"예약되었습니다. <br>";
    }else{
        echo"예약에 실패했습니다. 다시 시도해주세요. <br>";
    }

    mysqli_close($db);
?>