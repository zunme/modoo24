Pusher.logToConsole = true;

var pusher = new Pusher('13fc7ff1bb9caecd8347', {
  cluster: 'ap3'
});
var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  let message = data.message;
  if( message.type == 'post') toast('새로운 글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'comment') toast('댓글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'recomment') toast('커뮤니티 댓글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'review') toast('후기글이 등록되었습니다.','bottomRight')
  else if ( message.type == 'reviewcomment') toast('후기에 댓글// 등록되었습니다.','bottomRight')
});
