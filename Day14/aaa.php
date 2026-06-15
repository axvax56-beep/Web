<?php
    header('Content-Type:text/html; charset = utf-8');

    // 사용자가 get방식으로 전달한 값을 변수에 저장
    $nickname = $_GET['nickname'];
    $email = $_GET['email'];

    // 실제로는 Database에 저장하는 작업 수행하고 결과를 응답(response - echo)
    // DB작업까지 하면 시간이 오래걸리니 지금은 그냥 받은 데이터를 그대로 응답해주기
    echo "$nickname - $email 값으로 회원가입을 했습니다. ";
?>