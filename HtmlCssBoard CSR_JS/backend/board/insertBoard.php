<?php
    header('Content-Type:text/plain; charset=utf-8');
    // 사용자가 json으로 데이터를 보내면 php언어는 특정 위치(php://input)에 이 값을 파일로 보관함
    // 그래서 그 파일을 읽어와야 함
    $json_data = file_get_contents('php://input');
    // json 형식의 문자열에서 값들의 추출을 쉽게 하기 위해 연관 배열로 해독해내기
    $datas = json_decode($json_data, true); // true:연관배열로 만들지 여부

    // 데이터들에서 각 값들을 추출(제목, 글쓴이, 비밀번호, 메세지)
    $title = 
?>