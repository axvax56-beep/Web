// 지도를 보여줄 div 요소 찾기
var container = document.getElementById('map');

// 지도의 위치나 줌레벨 정도를 옵션으로 미리 지정
var options = {
    center: new kakao.maps.LatLng(37.48659493110084, 126.92926104080061),
    level: 3, // 줌레벨 1~25
}

// 지도 객체를 만들고 보여주기
var map = new kakao.maps.Map(container, options);

// 마커가 표시될 위치입니다 
var markerPosition  = new kakao.maps.LatLng(37.48659493110084, 126.92926104080061); 

// 사용자 정의 마커 이미지
var imageSrc = './image/ms15.png';
var imageSize = new kakao.maps.Size(64, 64);
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);


// 마커를 생성합니다
var marker= new kakao.maps.Marker({
    position: markerPosition,
    image: markerImage
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

// 아래 코드는 지도 위의 마커를 제거하는 코드입니다
// marker.setMap(null);    