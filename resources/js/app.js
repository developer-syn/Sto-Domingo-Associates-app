import './bootstrap';
import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Alpine = Alpine;

// Initialize Laravel Echo with Pusher
window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'pusher',
    key: '46a5a909518c2908ea48', // Your Pusher Key
    cluster: 'us2', // Your Pusher Cluster
    encrypted: true,
});

// Start Alpine.js
Alpine.start();

// Here you can add any global event listeners or other JavaScript code related to your application

// Example: Listening for a user request event on the admin side
if (document.body.dataset.role === 'admin') { // Assuming you're marking admin views with a data attribute
    echo.channel('admin-chat')
        .listen('user.request.accepted', (e) => {
            console.log("Received notification for user request:", e); // Log the event
            // Handle the incoming event, e.g., show notification or update the chat
        });
}
