

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

messaging.requestPermission()
.then(function() {
  console.log('Notification permission granted.');
  return messaging.getToken();
})
.then(function(token) {
  console.log(token); // Display user token
})
.catch(function(err) { // Happen if user deney permission
  console.log('Unable to get permission to notify.', err);
});

messaging.onMessage(function(payload){
	console.log('onMessage',payload);
})



