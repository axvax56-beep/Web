// JS를 이용하여 서버에서 게시글 목록 데이터를 불러와서 HTML로 그려내는 작업 수행
// JS를 이용하여 웹문서의 DOM 요소를 생성하여 그려내는 방식을 CSR 이라고 부름

// JS는 헤더에 추가되어 있고. 게시글을 추가해야 하는 요소는 body에 있기에
// body가 완료된 후 DOM작업을 수행해야 함.

// body 요소에 로딩완료 이벤트 onload 에 대응하는 콜백함수를 이용 [ body요소에 onload 속성을 추가 ]
function loaded(){

    // backend 서버에서 게시글 데이터들을 받아오기 [ json 형식으로 받기 ] 
    // 먼저. 테스트용으로 boardList.json 파일을 만들고 가짜 데이터로 DOM UI를 동적으로 구성해보기.
    // JS에서 페이지의 변경없이 서버에서 데이터만 요청하는 기법을 AJAX(비동기식) 이라고 부름
    // 원래는 XMLHttpRequest 를 이용해야 함. 하지만 조금더 쉽게 하기 위해 fetch() 라이브러리를 사용
    // 최상위 객체인 window에 fetch()라이브러리가 내장되었음.

    // 경로 주의!! [ 현재 JS의 경로가 아니라...JS가 적용되는 HTML의 경로! ]
    //1] 연습용으로 json 을 분석하지 않고.. 그냥 글씨로 확인해보기.
    // fetch('./backend/boardList.json')
    // .then(function(response){
    //     return response.text(); //응답 데이터를 그냥 글씨로 만들어줘.
    // })
    // .then(function(text){
    //     alert(text);
    // })

    // ajax 기술을 서버와의 통신이기에... 반드시 웹서버에서 구동해야 함. 

    //2] 서버에서 읽어온 json 데이터를 분석하여 JS객체로 받아서 HTML 의 게시글 리스트를 그려내기(JS로 웹화면을 만들기 - CSR)
    fetch('./backend/boardList.json') //이 경로만 .php로 바꾸면 됨.
    .then(function(response){
        return response.json();  //응답데이터를 json 형식으로 만들어.. JS객체까지 만들어줘.
    })
    .then( function(json){ // json을 분석한 JS객체가 파라미터로 전달됨.
        //분석된 객체 확인
        //alert( json.status +"\n" + json.total +"\n" + json.data);

        //JS로 화면 그려내기.. 
        //1) 게시글 리스트의 총 개수를 제목영역에 표시. [표시될 요소 찾기 - css 선택자를 이용하여 찾기]
        var p= document.querySelectorAll('.board_title p')[0];
        p.innerHTML= "자유롭게 게시글을 작성하며 이야기를 나누세요. [ 총 게시글 수 : " + json.total +" ]";

        //2) 읽어온 게시글 데이터들을 table 요소에 추가하기.
        // [연습] table 요소에 게시글 한줄 추가하기
        // var row= "";
        // row += '<tr>';
        // row += '<td class="col_no">2</td>';
        // row += '<td class="col_title"><a href="./board/view.html?no=1">글 제목 #4</a></td>';
        // row += '<td class="col_writer">asdfasdf</td>';
        // row += '<td class="col_date">2025.07.28</td>';
        // row += '<td class="col_hits">15</td>';
        // row += '</tr>';  

        // 반목문으로 게시글 리스트 개수만큼 table의 자식요소를 추가하기
        for( board of json.data ){
            var row= "";
            row += '<tr>';
            row += `<td class="col_no">${board.no}</td>`;
            row += `<td class="col_title"><a href="./board/view.html?no=${board.no}">${board.title}</a></td>`;
            row += `<td class="col_writer">${board.writer}</td>`;
            row += `<td class="col_date">${board.date}</td>`;
            row += `<td class="col_hits">${board.hits}</td>`;
            row += '</tr>';
            
            // JS로 만든 요소 문자열을 table 요소의 자식으로 추가
            document.getElementsByClassName('board_list')[0].innerHTML += row;
        }//for   
                        
        

    })



}

