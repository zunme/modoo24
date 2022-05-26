const fs= require('fs');
const key = fs.readFileSync('/opt/apache/conf/24auction/24auction_co_kr_SHA256WITHRSA.key');
const cert = fs.readFileSync('/opt/apache/conf/24auction/24auction_co_kr.crt');
const config = require('./db_config.json');

const admintoken ='080042cad6356ad5dc0a720c18b53b8e53d4c274';
const adminroom = 'djemalsfna_modoo'
const express = require("express");
const request = require("request");
const errorJson ={'code':'error','desc':''}

const axios = require('axios');

//const mysql      = require('mysql');
//var pool = mysql.createPool(config);

var app = express();
var onlineUsers = {};

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
var redis = new Redis({
  host:'116.122.157.239',
  port:'6379',
  password:'mdclean'
});
var redissender = new Redis({
  host:'116.122.157.239',
  port:'6379',
  password:'mdclean'
});
redis.subscribe('laravel_database_admin-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    try{
      var jsonmessage = JSON.parse(message);
      if( typeof jsonmessage.event !='undefined') {
        chat.to(adminroom).emit('cmd', jsonmessage );
      }
      //chat.to('partner').emit('chat message', message.data);
    }catch(e){
      chat.to(adminroom).emit('chat message', message);
    }
});

var ids
var lastclean = ''
redissender.get('last_clean_order', (err, reply)=>{
  if(reply) lastclean=reply
})

// localhost:3000으로 서버에 접속하면 클라이언트로 index.html을 전송한다
app.get('/', function(req, res) {
  res.sendFile(__dirname + '/indexroom.html');
});
app.post('/data', verifyToken, (req, res)=>{
  if( req.token == admintoken){
    var data = req.body;
    if ( data.event && data.room ){
      chat.to(data.room).emit( data.event, data);
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
function getUsersByPage(page) {
    let userstemp = [];
    Object.keys(onlineUsers).forEach((el) => {
        if (onlineUsers[el].page === page) {
            userstemp.push(onlineUsers[el]);
        }
    });
    return userstemp;
}
function getUsersByRoom(room){
  let userstemp = [];
  console.log(room +' search')
  Object.keys(onlineUsers).forEach((el) => {
      if (onlineUsers[el].roomid === room) {
          userstemp.push(onlineUsers[el]);
      }
  });
  return userstemp;
}
// connection event handler
// connection이 수립되면 event handler function의 인자로 socket인 들어온다
var chat = io.of('/chat').on('connection', function(socket) {
  socket.emit("connedted", "connected");
  socket.on('login', function(data) {
    if( typeof socket.handshake.auth =='undefined' || typeof socket.handshake.auth.token =='undefined'){
      socket.disconnect();
      return;
    }
    var token = socket.handshake.auth.token;
    try {
        axios.get('http://116.122.157.150:8088/partner/v2/api/isuser',
          {params: {token: token}},
        ).then( (res)=>{
          if(typeof res.data.data != 'undefined'){
            var resdata = res.data.data
            // socket에 클라이언트 정보를 저장한다
            socket.name = resdata.am_name;
            socket.userid = resdata.am_id;
            socket.roomid = data.room;
            socket.open='connect'
            // 접속된 모든 클라이언트에게 메시지를 전송한다
            // room에 join한다

            socket.join(data.room);
            onlineUsers[String(socket.id)] = {
              socketid : socket.id,
              roomid : data.room,
              name: resdata.am_name,
              userid : resdata.am_id,
              useridx : resdata.am_idx,
              page : data.page,
              pageId : data.pageid,
            }
            chat.to(data.room).emit('openPage', onlineUsers[socket.id] );

          }else{
            socket.disconnect();
            return;
          }
        }).catch( (err)=>{
          console.log (err)
          socket.disconnect();
          return;
        });
      } catch (error) {
        console.error(error)
      }
    if( data.room == adminroom && ( typeof data.token !='string' || data.token != admintoken) ) {
      console.log ("disconnect")

      socket.disconnect();
      return;
    }
  });
  socket.on('chat message', function(data){
    if ( typeof socket.userid =='undefined') {
      socket.disconnect();
      return;
    }
    if( data.msg =='showuser'){
      opendata = onlineUsers[socket.id];
      socket.emit("userInPage", getUsersByPage(opendata.page));
      return;
    }else if( data.msg =='users'){
      opendata = onlineUsers[socket.id];
      socket.emit("users", getUsersByRoom(opendata.roomid));
      return;
    }else{
      chat.to(socket.roomid).emit('chat message', data.msg);
    }

  });
  socket.on('userListPage', function(data){
    if( typeof data =='undefined') data ='';
    socket.emit("userInPage", getUsersByPage(data));
  })

  socket.on('forceDisconnect', function() {
    socket.disconnect();
  })

  socket.on('disconnect', function() {
    opendata = onlineUsers[String(socket.id)];
    if( typeof opendata != 'object') return;
    chat.to(opendata['roomid']).emit('closePage',opendata );
    delete onlineUsers[String(socket.id)];
    chat.to(adminroom).emit('logout', socket.name);
    socket.emit("disconnected", "from Server");
  });
});

ids = setInterval(function () {
  try{
    //test
    const options = {
      uri: "http://116.122.157.150:8088/partner/v2/api/lastcleanorder?id="+lastclean,
        qs:{
          id:lastclean,
        }
      };
      request(options,function(err,response,body){
        var data = JSON.parse(body)
        if( typeof data.data.clean != 'undefined') {
          lastclean=data.data.clean
          redissender.set('last_clean_order', lastclean);
        }
      })
    }catch (e){;}
},15000);

server.listen(3000, function() {
  console.log('Socket IO server listening on port 3000');
});
