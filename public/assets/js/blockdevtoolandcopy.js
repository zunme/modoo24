var keydownCtrl = 0;
var keydownShift = 0;
document.onkeydown=keycheck;
document.onkeyup=uncheckCtrlShift;
function keycheck() {
  switch(event.keyCode){
    case 123:event.keyCode='';return false; break; //F12
    case 17:event.keyCode='';keydownCtrl=1;return false; break; //컨트롤키
  }
  if(keydownCtrl) return false;
}
function uncheckCtrlShift() {
  if(event.keyCode==17) keydownCtrl=0;
  if(event.keyCode==16) keydownShift=0;
}
function click() {
  if ((event.button==2) || (event.button==2)) {}
}
document.onmousedown=click;

window.addEventListener("copy", (e) => {
  e.preventDefault();
  e.clipboardData.clearData("보안 정책에 의해 복사를 허용하지 않습니다."); // 클립보드에 저장된 컨텐츠 삭제
});
const devtools = {
  isOpen: false,
  orientation: undefined,
};

const threshold = 160;

const emitEvent = (isOpen, orientation) => {
  globalThis.dispatchEvent(new globalThis.CustomEvent('devtoolschange', {
    detail: {
      isOpen,
      orientation,
    },
  }));
};

const main = ({emitEvents = true} = {}) => {
  const widthThreshold = globalThis.outerWidth - globalThis.innerWidth > threshold;
  const heightThreshold = globalThis.outerHeight - globalThis.innerHeight > threshold;
  const orientation = widthThreshold ? 'vertical' : 'horizontal';

  if (
    !(heightThreshold && widthThreshold)
    && ((globalThis.Firebug && globalThis.Firebug.chrome && globalThis.Firebug.chrome.isInitialized) || widthThreshold || heightThreshold)
  ) {
    if ((!devtools.isOpen || devtools.orientation !== orientation) && emitEvents) {
      emitEvent(true, orientation);
    }

    devtools.isOpen = true;
    devtools.orientation = orientation;
    document.body.innerHTML = "보안 정책에 의해 디버그 모드에서는 작동하지 않습니다";
    console.log ( "debuged")
  } else {
    if (devtools.isOpen && emitEvents) {
      emitEvent(false, undefined);
    }

    devtools.isOpen = false;
    devtools.orientation = undefined;
  }
};

main({emitEvents: false});
setInterval(main, 500);
