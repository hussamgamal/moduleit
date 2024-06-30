<!-- Your content here -->

<!-- Add Firebase SDKs for products you want to use -->
<script type="module">
    // Import the Firebase core and the specific products you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
    import { getAuth } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";
    import { getFirestore } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore.js";
    import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging.js";

    // Your web app's Firebase configuration
    const firebaseConfig = {
        apiKey: "AIzaSyDtj6BocTVPXwlENoKJCTNTJK628JXvY0c",
        authDomain: "car-wash-ec4aa.firebaseapp.com",
        projectId: "car-wash-ec4aa",
        storageBucket: "car-wash-ec4aa.appspot.com",
        messagingSenderId: "440647203005",
        appId: "1:440647203005:web:94b8ee15766e8fb6501fd4"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);

    // Initialize Firebase products
    const auth = getAuth(app);
    const db = getFirestore(app);
    const messaging = getMessaging(app);

    // Request permission for notifications
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            getToken(messaging, { vapidKey:
                    'BMCU3qfXRluUPu05WqnENb9vL0Yd3dP6_hHXii_QnFjny2VyAiFkikpJPD0qnu8A8_ispoIR8J44-ZOdBIrYsVQ' }).then((currentToken) => {
                if (currentToken) {
                    // Send the token to your server to store it for sending notifications
                    // Example: using fetch to send a POST request
                    var url = "{{ route('admin.saveToken') }}";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            token: currentToken
                        },
                        dataType: 'JSON',
                        success: function (response) {
                            console.log('Token stored.');
                        },
                        error: function (error) {
                            console.log(error);
                        },
                    });
                } else {
                    console.log('No registration token available. Request permission to generate one.');
                }
            }).catch((err) => {
                console.log('An error occurred while retrieving token. ', err);
            });
        } else {
            console.log('Unable to get permission to notify.');
        }
    });


</script>
