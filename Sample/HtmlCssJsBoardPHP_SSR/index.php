<?php
    header('Content-Type:text/html; charset=utf-8');

    // MySQL DB와 연결하여 데이터 가져오기
    $db= mysqli_connect('localhost','mrhi2024','a1s2d3f4!', 'mrhi2024');
    mysqli_query($db, 'set names utf8');

    // 'web_board' 테이블에 저장된 모든 게시글 데이터들 가져오는 쿼리문 작성
    $sql= "SELECT * FROM web_board ORDER BY no DESC";
    $result= mysqli_query($db, $sql);

    // 결과표($result)로 부터 게시글들 한줄씩 가져와 boards 배열에 저장하기

    $boards= array(); //빈 배열 준비
    $row_num= mysqli_num_rows($result); //총 레코드 수
    for($i=0; $i<$row_num; $i++){
        $row= mysqli_fetch_array($result, MYSQLI_ASSOC); //연관배열로 한줄 데이터 가져오기
        $boards[$i]= $row; // boards배열에 추가
    } 

    // MySQL과 연결 종료
    mysqli_close($db);

    // 게시글 배열 개수
    $boards_size= count($boards);
?>




<!-- 화면 HTML/CSS UI 작업은 기존 문서 그대로 사용. 게시글 목록 데이터들만 php로 구현 -->

<!-- include 를 사용하면 별도의 html로 분리하여 제작 가능. 해당 html에서는 별도의 추가작업없이 그냥 php의 변수를 사용하면됨. 마치 원래 이 php에 작성한 것 처럼. ==> include 에 의해 여기에 포함된 것과 같음. -->
<!-- <?php /*include "index.html"*/ ?>  -->
<!-- 수업시간에 파일을 너무 많이 나누면 혼동스러울 수 있어서. 이 php에 직접 작성하는 방식으로 실습. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <!-- 외부 스타일시트 연결 -->
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

    <!-- 콘테츠가 표시되는 영역 -->
    <div class="board_wrap">

        <!--1. 게시판 제목 영역 -->
        <div class="board_title">
            <h2>자유 게시판</h2>
            <p>자유롭게 게시글을 작성하며 이야기를 나누세요. [ <?php echo "총 게시글 수 : $row_num"; ?> ] </p>
        </div>

        <!-- 2. 게시판 테이블이 그려질 영역 (테이블, 페이지네이션) -->
        <div class="board_list_wrap">
            
            <!-- 2.1 테이블 영역 -->
            <table class="board_list">
                <!--1) 컬룸 제목줄 -->
                <tr class="column_title">
                    <!-- 컬룸(칸)별 스타일 적용을 편하게 하기 위해 -->
                    <th class="col_no">번호</th>
                    <th class="col_title">제목</th>
                    <th class="col_writer">글쓴이</th>
                    <th class="col_date">작성일</th>
                    <th class="col_count">조회</th>
                </tr>

                <!--2) 게시글 데이터들(배열) ~ PHP로 그려내기  -->
        <?php

            for($i=0; $i<$boards_size; $i++){

                $board= $boards[$i];
                $no= $board['no'];
                $name= $board['name'];
                $title= $board['title'];
                $message= $board['msg'];
                $date= $board['date'];
                $hits= $board['hits'];

                echo ("

                    <tr>
                        <td class='col_no'> $no  </td>
                        <td class='col_title'><a href='./board/view.php?no=$no'> $title </a></td> 
                        <td class='col_writer'> $name </td>
                        <td class='col_date'> $date </td>
                        <td class='col_count'> $hits </td>
                    </tr>

                ");
            }

        ?>
            </table>

            <!-- 2.2 페이지네이션 영역-->
            <div class="board_pagination">
                <a href="#" class="btn first">&lt;&lt;</a>  <!--  << 모양 [스타일링 - 클래스 여러개 지정 : btn  &  first]-->
                <a href="#" class="btn prev">&lt;</a>  <!--  < 모양 [클래스 여러개 지정 : btn  &  prev]-->
                <a href="#" class="btn selected">1</a>  <!-- [클래스 여러개 지정 : btn  &  selcted]-->
                <a href="#" class="btn">2</a> <!-- btn 스타일만 적용 -->
                <a href="#" class="btn">3</a> <!-- btn 스타일만 적용 -->
                <a href="#" class="btn">4</a> <!-- btn 스타일만 적용 -->
                <a href="#" class="btn">5</a> <!-- btn 스타일만 적용 -->
                <a href="#" class="btn next">&gt;</a>  <!--  > 모양 [스타일링 - 클래스 여러개 지정 : btn  &  next]-->
                <a href="#" class="btn last">&gt;&gt;</a>  <!--  > 모양 [클래스 여러개 지정 : btn  &  last]-->
            </div>

            <!-- 2.3 게시글 등록/수정 버튼 영역-->
            <div class="btn_wrap">
                <a href="./board/write.php">등록</a>
            </div>

        </div>

    </div>
    
</body>
</html>