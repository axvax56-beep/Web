<?php
    header('Content-Type:text/html; charset=utf-8');

    // GET으로 전달받은 게시글 번호 no
    $no= $_GET['no'];

    // MySQL DB와 연결하여 데이터 가져오기
    $db= mysqli_connect('localhost','mrhi2024','a1s2d3f4!', 'mrhi2024');
    mysqli_query($db, 'set names utf8');

    // 'web_board' 테이블에 저장된 no번째 게시글 데이터들 가져오는 쿼리문 작성
    $sql= "SELECT * FROM web_board WHERE no=$no";
    $result= mysqli_query($db, $sql);

    // 결과표($result)로 부터 게시글 한줄 가져오기   
    $board= mysqli_fetch_array($result, MYSQLI_ASSOC); //연관배열로 한줄 데이터 가져오기
    
    // 게시글 한줄에서 각 칸들의 값 추출
    $no= $board['no'];
    $name= $board['name'];
    $title= $board['title'];
    $message= $board['msg'];
    $date= $board['date'];
    $hits= $board['hits'];

    $message= nl2br($message);


    // [추가] 최종 마지막에 추가소개 -----------------------------------------------------------------------
    // 조회수 update
    //if( $회원이름 == $name){ ... } <== 현 예제는 회원가입 기능이 없기에..

    $sql= "UPDATE web_baord SET hits= hits+1 WHERE no=$no";
    mysqli_query($db, $sql);

    // -------------------------------------------------------------------------------------------------


    // MySQL과 연결 종료
    mysqli_close($db);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <!-- 외부 스타일시트 연결 [경로 주의 ../ ]-->
    <link rel="stylesheet" href="../css/view.css">
</head>
<body>
    <!-- 콘테츠가 표시되는 영역 -->
    <div class="board_wrap">

        <!--1. 게시판 제목 영역 -->
        <div class="board_title">
            <h2>자유 게시판 - 상세글 보기</h2>
            <p>자유롭게 게시글을 작성하며 이야기를 나누세요.</p>
        </div>

        <!-- 2. 상세게시글이 그려질 영역 () -->
        <div class="board_view_wrap">
            <!-- 2.1 게시글 영역 -->
            <div class="board_view">

                <!-- 2.1.1 게시글 헤더영역 -->
                <div class="title">
                    <!-- [JS or PHP를 통한 데이터 표시] -->
                    <?= $title ?>
                </div>

                <!-- 2.1.2 게시글 정보영역(번호, 작성자, 작성일, 조회수) -->
                <div class="info">
                    <!-- definition list로 만들어 보기 [JS or PHP를 통한 데이터 표시]-->
                    <dl>
                        <dt>번호</dt>
                        <dd><?= $no ?></dd>
                    </dl>
                    <dl>
                        <dt>글쓴이</dt>
                        <dd><?= $writer ?></dd>
                    </dl>
                    <dl>
                        <dt>작성일</dt>
                        <dd><?= $date ?></dd>
                    </dl>
                    <dl>
                        <dt>조회</dt>
                        <dd><?= $hits ?></dd>
                    </dl>
                </div>

                <!-- 2.1.3 글 내용영역 -->
                <div class="content">
                    <!-- [JS or PHP를 통한 데이터 표시] -->
                    <?= $message ?>                                        
                </div>                
            </div>

            <!-- 2.2 버튼 영역 -->
            <div class="btn_wrap">
                <a href="../index.php">목록</a>
                <a href="./edit.php?no=<?=$no?>">수정</a>
            </div>
        </div>


    </div>
</body>
</html>