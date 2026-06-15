// 상세글 보기 화면에 전달된 게시글 번호(no)를 확인해보기
// window 객체의 멤버중에 url 경로를 담당하는 객체 location 에게 주소정보 확인
//alert( location.href );
//alert( location.search ); //? 뒤에 전달된 파라미터 값들..가진 변수

//번호만 필요하기에 '=' 글자를 기준으로 분리하기
var no= location.search.split('=')[1];
//alert(no);

// no에 해당하는 게시글의 hits 조회수를 업데이트 하는 요청도 해야 함.

//서버에 no 를 보내서 해당 번호의 게시글 데이터를 가져오기.[fetch() AJAX]
//가짜 데이터로 "board번호.json" 파일을 만들어... 번호별로 받을 게시글 데이터 백엔드를 대체.
var url= '../backend/board' + no +".json";    //[.getBoard.php?no=no]
fetch(url)
.then(function(response){
    return response.json();
})
.then(function(json){
    // class 명을 이용하여 요소를 찾아서 서버로 부터 받은 게시글 데이터 표시하기
    //1] 글 제목
    document.querySelectorAll('.board_view .title')[0].innerHTML= json.data.title;
    //2] 글 번호
    document.querySelectorAll('.board_view .info .col1')[0].innerHTML= json.data.no;
    //3] 글쓴이
    document.querySelectorAll('.board_view .info .col2')[0].innerHTML= json.data.writer;
    //4] 작성일
    document.querySelectorAll('.board_view .info .col3')[0].innerHTML= json.data.date;
    //5] 조회수
    document.querySelectorAll('.board_view .info .col4')[0].innerHTML= json.data.hits;
    //6] 글 내용
    document.querySelectorAll('.board_view .content')[0].innerHTML= json.data.msg;

})
