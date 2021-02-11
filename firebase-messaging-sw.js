if ('serviceWorker' in navigator) {
navigator.serviceWorker.register('../firebase-messaging-sw.js')
  .then(function(registration) {
    console.log('Registration successful, scope is:', registration.scope);
  }).catch(function(err) {
    console.log('Service worker registration failed, error:', err);
  });
}


// *
//  * Here is is the code snippet to initialize Firebase Messaging in the Service
//  * Worker when your app is not hosted on Firebase Hosting.
 // [START initialize_firebase_in_sw]
 // Give the service worker access to Firebase Messaging.
 // Note that you can only use Firebase Messaging here, other Firebase libraries
 // are not available in the service worker.
 importScripts('https://www.gstatic.com/firebasejs/8.1.1/firebase-app.js');
 importScripts('https://www.gstatic.com/firebasejs/8.1.1/firebase-messaging.js');
 // Initialize the Firebase app in the service worker by passing in
 // your app's Firebase config object.
 // https://firebase.google.com/docs/web/setup#config-object
 
 firebase.initializeApp({
    apiKey: "AIzaSyB3YnQ2WaEQWGspxexCKSBc-1dF4kX7lQE",
    authDomain: "smart-surveillance-1eaf6.firebaseapp.com",
    databaseURL: "https://smart-surveillance-1eaf6.firebaseio.com",
    projectId: "smart-surveillance-1eaf6",
    storageBucket: "smart-surveillance-1eaf6.appspot.com",
    messagingSenderId: "301561777685",
    appId: "1:301561777685:web:ea02d8076f1a6a5de7081c",
    measurementId: "G-47LRFVSMHN",
 });

 // Retrieve an instance of Firebase Messaging so that it can handle background
 // messages.
 const messaging = firebase.messaging();
 // [END initialize_firebase_in_sw]
 


// If you would like to customize notifications that are received in the
// background (Web app is closed or not in browser focus) then you should
// implement this optional method.
// [START background_handler]
messaging.setBackgroundMessageHandler(function(payload) {
  	console.log('[firebase-messaging-sw.js] Received background message ', payload);
  	// Customize notification here
  	notificationTitle = payload.data.title;
  	notificationOptions = {
	    body: payload.data.body,
	    icon: payload.data.icon,
	    image:  payload.data.image
  	};

  	return self.registration.showNotification(
  		notificationTitle,
  		notificationOptions
  	);
});
// [END background_handler]