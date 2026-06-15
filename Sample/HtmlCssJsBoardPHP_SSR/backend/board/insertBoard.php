<?php
    header('Content-Type:text/html; charset=utf-8');


    //write.php로 부터 전달받은 데이터들
    $title= $_POST['title'];
    $writer= $_POST['writer'];
    $password= $_POST['password'];
    $message= $_POST['msg'];

    $now= date('Y.m.d');
    $hits= 0;


    // MySQL DB와 연결하여 데이터 저장하기
    $db= mysqli_connect('localhost','mrhi2024','a1s2d3f4!', 'mrhi2024');
    mysqli_query($db, 'set names utf8');

    // 'web_board' 테이블에 값을 저장하는 쿼리문
    $sql= "INSERT INTO web_board(name,title,msg,date,hits,password) VALUES('$writer','$title','$message','$now','$hits','$password')";
    $result= mysqli_query($db, $sql);     

    // MySQL과 연결 종료
    mysqli_close($db);

    // echo 응답을 결과에 따라 다름..
    if($result){
        //자바 스크립트의 location객체를 통해 index.php 로 페이지를 강제 이동
        echo "<script>location.href='../../index.php'</script>";

    }else{
        echo "<h3>게시글 저장에 오류가 발생했습니다. 다시 시도해주시기 바랍니다.</h3>";        
    }

?>

<?php

// 참고로 (에러는 아니지만 중요한 점)
// 보안 측면에서 보면 아래 부분은 SQL Injection 위험이 있어:

// $sql="INSERT INTO web_board(name, title, msg, date, hits, password)
//       VALUES('$name','$title','$message','$now','$hits','$password')";

// 실무에서는 Prepared Statement를 사용하는 게 좋다.

// 아래는 Prepared Statement(보안 처리) 적용 + 기존 에러 수정까지 모두 반영한 완성 코드야.

// SQL Injection 방지 + 문법 오류 수정 버전
// header('Content-Type:text/html; charset=utf-8');

// // POST 방식 데이터 받기
// $title     = $_POST['title'];
// $name      = $_POST['writer'];
// $password  = $_POST['pw'];
// $message   = $_POST['msg'];

// // 날짜 & 조회수
// $now  = date('Y.m.d');
// $hits = 0;

// // DB 연결
// $db = mysqli_connect('localhost', 'mbca2025aix', 'a1s2d3f4!', 'mbca2025aix');
// mysqli_set_charset($db, 'utf8');

// // 연결 실패 체크
// if (!$db) {
//     die('DB 연결 실패: ' . mysqli_connect_error());
// }

// // Prepared Statement
// $sql = "INSERT INTO web_board (name, title, msg, date, hits, password)
//         VALUES (?, ?, ?, ?, ?, ?)";

// $stmt = mysqli_prepare($db, $sql);

// // 바인딩 (s=string, i=integer)
// mysqli_stmt_bind_param(
//     $stmt,
//     "ssssis",
//     $name,
//     $title,
//     $message,
//     $now,
//     $hits,
//     $password
// );

// // 실행
// $result = mysqli_stmt_execute($stmt);

// // 결과 처리
// if ($result) {
//     echo "<script>location.href='../index.php';</script>";
// } else {
//     echo "<h3>게시글 저장에 오류가 발생했습니다.</h3>";
// }

// // 종료
// mysqli_stmt_close($stmt);
// mysqli_close($db);
 

// #보안적으로 더 좋은 개선 (선택)
// 비밀번호 해시 처리 (강력 추천)
// $password = password_hash($_POST['pw'], PASSWORD_DEFAULT);

// 나중에 확인할 때:
// password_verify($input_pw, $db_pw);

// #핵심 요약
// 1. Prepared Statement → SQL Injection 완벽 차단
// 2. password_hash() → 비밀번호 안전 저장

?>