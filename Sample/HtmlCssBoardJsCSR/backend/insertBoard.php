<?php
    header('Content-Type:text/plain; charset=utf-8');

    
    // 사용자로부터 json 으로 문자열을 받았을때.
    $json_data= file_get_contents('php://input');
    $_POST= json_decode($json_data, true); //두번째 파라미터 : 연관배열로 만들지 여부.  [ json string ==> associated array ]

    //write.php로 부터 전달받은 데이터들
    $title= $_POST['title'];
    $writer= $_POST['writer'];
    $password= $_POST['password'];
    $message= $_POST['msg'];

    $now= date('Y.m.d');
    $hits= 0;

    //password 가 DB에 그대로 노출되어 저장되면 안되기에.. 암호화
    password_hash($password, PASSWORD_DEFAULT);

    //나중에 읽어올때는 password_verify() ...

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
        echo "글 저장을 성공했습니다.";

    }else{
        echo "글 저장 중 오류가 발생했습니다.";        
    }


?>