self.addEventListener('push', function (event) {
    let data = event.data.json();
    let title = data.title || 'New Notification';
    let options = {
        body: data.body,
        icon: data.icon || '/images/icon.png',
        badge: '/images/badge.png'
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
