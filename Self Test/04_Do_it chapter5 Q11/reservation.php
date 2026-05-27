<?php

    header("Content-Type:text/html; charset=utf-8");

    $r_name= $_GET['r_name'];
    $r_phone= $_GET['r_phone'];
    $r_email= $_GET['r_email']; 

    echo "<p> 이 름: $r_name </p>";
    echo "<p> 전 화: $r_phone </p>";
    echo "<p> 이메일: $r_email </p>";

?>