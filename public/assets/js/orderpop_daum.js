var daumelement_layer = document.getElementById('daumlayer');

function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    daumelement_layer.style.display = 'none';
}

function getAddress( callbackFunction ){
  new daum.Postcode({
        oncomplete: function(data) {
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            if(data.userSelectedType === 'R'){
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
            } else {
                extraAddr = '';
            }
            daumelement_layer.style.display = 'none';
            console.log ( addr, extraAddr, data)
            if( typeof callbackFunction != 'undefined') callbackFunction( addr, extraAddr, data)
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(daumelement_layer);

    // iframe을 넣은 element를 보이게 한다.
    daumelement_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}
function initLayerPosition(){
  var width = 300; //우편번호서비스가 들어갈 element의 width
  var height = 400; //우편번호서비스가 들어갈 element의 height
  var borderWidth = 5; //샘플에서 사용하는 border의 두께

  // 위에서 선언한 값들을 실제 element에 넣는다.
  daumelement_layer.style.width = width + 'px';
  daumelement_layer.style.height = height + 'px';
  daumelement_layer.style.border = borderWidth + 'px solid';
  // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
  daumelement_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
  daumelement_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
}
