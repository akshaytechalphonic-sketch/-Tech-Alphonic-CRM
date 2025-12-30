<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Push Notification</title>
</head>
<body>

<button id="subscribeButton">Subscribe for Notifications</button>
<button id="sendBulkNotificationButton">Send Bulk Notification</button>

<script>
// Check for service worker support
if ('serviceWorker' in navigator && 'PushManager' in window) {
    navigator.serviceWorker.register('service-worker.js')
        .then(function(registration) {
            console.log("Service Worker Registered");
        })
        .catch(function(error) {
            console.error("Service Worker Registration Failed", error);
        });

    // Button to subscribe user
    document.getElementById('subscribeButton').addEventListener('click', function () {
        subscribeUser();
    });

    // Button to trigger bulk notification
    document.getElementById('sendBulkNotificationButton').addEventListener('click', function () {
        sendBulkNotification();
    });

    // Check if user is already subscribed
    function subscribeUser() {
        navigator.serviceWorker.ready.then(function(registration) {
            registration.pushManager.getSubscription()
                .then(function(subscription) {
                    if (subscription) {
                        console.log('Already subscribed');
                    } else {
                        askUserPermission(registration);
                    }
                });
        });
    }

    // Ask user for permission to send notifications
    function askUserPermission(registration) {
        Notification.requestPermission().then(function(permission) {
            if (permission === 'granted') {
                registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: 'BOzQaq3J-Z8cdMmAZQNU3CoOSoSmRDNdihmu918YnOOWfGZ3AdRhN-draa7iGHmO5CkpksBQ7GKYbgnaFMuoFQ8' // Use your VAPID key here
                }).then(function(subscription) {
                    console.log('User is subscribed:', subscription);
                    saveSubscriptionToServer(subscription);
                }).catch(function(err) {
                    console.error('Failed to subscribe user:', err);
                });
            }
        });
    }

    // Save subscription to the server
    function saveSubscriptionToServer(subscription) {
        fetch('save-subscription.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(subscription)
        }).then(response => response.json())
          .then(data => console.log('Subscription saved:', data))
          .catch(error => console.error('Error saving subscription:', error));
    }

    // Trigger bulk notification
    function sendBulkNotification() {
        fetch('send-bulk-notifications.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: 'Hello from the server!' })
        }).then(response => response.json())
          .then(data => console.log('Bulk notification sent:', data))
          .catch(error => console.error('Error sending bulk notification:', error));
    }
}
</script>

</body>
</html>
