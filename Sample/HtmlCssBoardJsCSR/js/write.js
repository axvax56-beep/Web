//사용자가 게시글입력을 완료한 후 form 요소의 submit 버튼을 클릭하면..
//원래는 페이지가 서버페이지로 변경됨.. SSR.. 이거 싫어.
//그래서 페이지를 변경하지 않고..ajax로 데이터만 요청..

// form 요소의 submit 버튼이 눌러졌을 때 반응하는 콜백함수 만들기 - [form 요소에 onsubmit 이벤트에 등록]
function submitBoard(){
    // form요소의 제출버튼을 누르면 action속성에 값이 있던 없던.. 무조건 페이지가 변경됨. 없으면 현재페이지가 새로고침됨.
    // 이 동작을 막아야 페이지가 깜빡이는 것을 방지할 수 있음.
    window.event.preventDefault();

    //alert();

    //서버로 보낼 데이터를 input요소들로 부터 받아오기.. [요소찾기 작업을 쉽게.. form, input요소에 name속성을 이용]
    var title= document.boardForm.title.value; //name 속성값을 멤버변수처럼 사용
    var writer= document.boardForm.writer.value;
    var password= document.boardForm.password.value;
    var message= document.boardForm.msg.value;
    //alert(title+"\n"+writer);

    //보낼 데이터를 하나로 묶기.. [key=value 로 하거나..json(권장)으로 하거나..]
    //1] JS객체로 보낼 데이터를 묶기
    var data={
        "title":title,
        "writer":writer,
        "password":password,
        "msg":message
    }
    //2] JS객체를 json 문자열로 변환
    var jsonData= JSON.stringify(data);

    //이 데이터를 post 방식으로 서버에 보내기..
    fetch('../backend/insertBoard.php',{
        method:'POST',
        headers: {'Cotent-Type':'application/json'}, //보내는 데이터가 json 임을 알려주기
        body: jsonData  
    })
    .then(function(response){
        return response.text();
    })
    .then(function(text){
        alert(text);
        //서버응답이 잘 되었으니. 다시 게시판 리스트 페이지로 이동
        location.href= '../index.html';
    })


}