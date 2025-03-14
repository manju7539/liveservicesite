<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>Hello</h2>



  <script src="https://www.gstatic.com/firebasejs/3.7.2/firebase.js"></script>
  
<script>
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

</script>

</body>
</html>