const fs= require('fs');
const key = fs.readFileSync('/opt/apache/conf/24auction/24auction_co_kr_SHA256WITHRSA.key');
const cert = fs.readFileSync('/opt/apache/conf/24auction/24auction_co_kr.crt');
const admintoken ='080042cad6356ad5dc0a720c18b53b8e53d4c274';

const express = require("express");
const errorJson ={'code':'error','desc':''}
var app = express();
app.use(express.json());

var server = require('https').createServer({ key: key, cert:cert },app);
var Redis = require('ioredis');
// http server를 socket.io server로 upgrade한다
var io = require('socket.io')(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});
var redis = new Redis();
var redissender = new Redis();
redis.subscribe('test-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(message.event, message.data);
});
// localhost:3000으로 서버에 접속하면 클라이언트로 index.html을 전송한다
app.get('/', function(req, res) {
  res.sendFile(__dirname + '/index.html');
});
app.post('/data', verifyToken, (req, res)=>{
  if( req.token == admintoken){
    var data = req.body;
    if ( data.event && data.room ){
      console.log ( "event" )
      res.send(req.body);    // JSON 응답
    }else res.send(errorJson);
  }else res.send(errorJson);

});
function verifyToken(req, res, next) {
  const bearerHeader = req.headers['authorization'];

  if (bearerHeader) {
    const bearer = bearerHeader.split(' ');
    const bearerToken = bearer[1];
    req.token = bearerToken;
    next();
  } else {
    // Forbidden
    res.sendStatus(403);
  }
}

// connection event handler
// connection이 수립되면 event handler function의 인자로 socket인 들어온다
io.on('connection', function(socket) {
  socket.emit("connedted","from server")
  // 접속한 클라이언트의 정보가 수신되면
  socket.on('login', function(data) {
    console.log('Client logged-in:\n name:' + data.name + '\n userid: ' + data.userid);

    // socket에 클라이언트 정보를 저장한다
    socket.name = data.name;
    socket.userid = data.userid;

    // 접속된 모든 클라이언트에게 메시지를 전송한다
    io.emit('login', data.name );
    var loginmessage = {'event': 'login', 'data':{name:data.name} }
    redissender.publish('test-channel', JSON.stringify(loginmessage) );
  });

  // 클라이언트로부터의 메시지가 수신되면
  socket.on('chat', function(data) {
    console.log('Message from %s: %s', socket.name, data.msg);

    var msg = {
      from: {
        name: socket.name,
        userid: socket.userid
      },
      msg: data.msg
    };

    // 메시지를 전송한 클라이언트를 제외한 모든 클라이언트에게 메시지를 전송한다
    socket.broadcast.emit('chat', msg);

    // 메시지를 전송한 클라이언트에게만 메시지를 전송한다
    // socket.emit('s2c chat', msg);

    // 접속된 모든 클라이언트에게 메시지를 전송한다
    // io.emit('s2c chat', msg);

    // 특정 클라이언트에게만 메시지를 전송한다
    // io.to(id).emit('s2c chat', data);
  });

  // force client disconnect from server
  socket.on('forceDisconnect', function() {
    io.emit('logout', socket.name );
    socket.disconnect();
  })

  socket.on('disconnect', function() {
    io.emit('logout', socket.name );

    console.log ( io.sockets.clients() )
    console.log('user disconnected: ' + socket.name);
  });
});

server.listen(3000, function() {
  console.log('Socket IO server listening on port 3000');
});
