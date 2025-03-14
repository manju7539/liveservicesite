importScripts('https://www.gstatic.com/firebasejs/3.7.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.7.1/firebase-messaging.js');

// Initialize Firebase
  var config = {
       apiKey: "AIzaSyDOeCSXjN_CeDOAXBzigBnKIVZRicgy8Ts",
    authDomain: "hotelmanagementstaff.firebaseapp.com",
    projectId: "hotelmanagementstaff",
    storageBucket: "hotelmanagementstaff.appspot.com",
    messagingSenderId: "975363621003",
    appId: "1:975363621003:web:bfe2974ed4d57d2ba7548e",
    measurementId: "G-FV88VTZNZ3"

  };
  firebase.initializeApp(config);
  
  const messaging = firebase.messaging();