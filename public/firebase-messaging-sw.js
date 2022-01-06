importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyDYRKqViJVIN5lPFTESo94vhWATUX5IN6U",
  authDomain: "modoo24-ed21f.firebaseapp.com",
  projectId: "modoo24-ed21f",
  storageBucket: "modoo24-ed21f.appspot.com",
  messagingSenderId: "267389339203",
  appId: "1:267389339203:web:ced6578e3716dfbd4236f6"
})
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function( payload) {
  console.log('Message handled in the background!', payload);
    //return self.registration.showNotification(title,{body,icon});
    const title = payload.notification.title;
    const options = {
            body: payload.notification.body,
            icon: payload.notification.icon
    };
    return self.registration.showNotification(title,options);
    /*
    console.log('Message handled in the background!', remoteMessage);
      var option ={
        body : remoteMessage.notification.body,
        icon : 'https://modoo24.net/NEW/image/sub/know_logo.png'
      }
      return self.registration.showNotification(remoteMessage.notification.title,option);
      */
});
