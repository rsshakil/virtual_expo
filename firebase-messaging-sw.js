importScripts("https://www.gstatic.com/firebasejs/7.21.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.21.1/firebase-messaging.js");

var config = {
  apiKey: "AIzaSyCj8JPFaU8AV8l90XMIgYWvSLSSRdfZwZ0",
  authDomain: "health-portal-8bba8.firebaseapp.com",
  databaseURL: "https://health-portal-8bba8.firebaseio.com",
  projectId: "health-portal-8bba8",
  storageBucket: "health-portal-8bba8.appspot.com",
  messagingSenderId: "1025676030546",
  appId: "1:1025676030546:web:828e6bad92555f5e6e258b",
  measurementId: "G-DG37FPC2R1"
};
  // Initialize Firebase
  firebase.initializeApp(config);

  const messaging = firebase.messaging();
  messaging.setBackgroundMessageHandler(function(payload){
    const title = "hello shereali";
    const options = {
        body:payload.data.status
    };
    return self.regisstration.showNotification(title, options);
  });

