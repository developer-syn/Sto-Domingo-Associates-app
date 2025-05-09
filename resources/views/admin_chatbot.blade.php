<!-- resources/views/admin_chatbot.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chatbot</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #333;
        }
        .chat-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #DC143C;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(220, 20, 60, 0.3);
            transition: all 0.3s ease;
            font-size: 24px;
        }
        .chat-button:hover {
            transform: scale(1.1) rotate(15deg);
            background-color: #b01030;
        }
        .chat-container {
            position: fixed;
            bottom: 100px;
            right: 20px;
            width: 320px;
            height: 480px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: none;
            flex-direction: column;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .chat-header {
            background-color: #DC143C;
            color: white;
            padding: 2px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
        }
        .close-chat {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .close-chat:hover {
            transform: rotate(90deg);
        }
        .chat-messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background-color: #DC143C;
            border-radius: 3px;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 80%;
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .user-message {
            background-color: #DC143C;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0;
        }
        .bot-message {
            background-color: #f0f0f0;
            color: #333;
            align-self: flex-start;
            border-bottom-left-radius: 0;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            background-color: #f0f0f0;
        }
        .chat-input input {
            flex-grow: 1;
            border: 1px solid #dcdcdc;
            background-color: white;
            color: #333;
            border-radius: 20px;
            padding: 10px 15px;
            margin-right: 10px;
            font-size: 14px;
        }
        .chat-input input:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(220, 20, 60, 0.3);
        }
        .chat-input button {
            background-color: #DC143C;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .chat-input button:hover {
            background-color: #b01030;
            transform: scale(1.05);
        }
        @media (max-width: 480px) {
            .chat-container {
                width: 90%;
                height: 70%;
                bottom: 80px;
                right: 5%;
                left: 5%;
            }
        }
        .option-button {
            background-color: white; /* Background color */
            color: #DC143C; /* Text color */
            border: 2px solid #DC143C; /* Border color */
            border-radius: 20px; /* Rounded corners */
            padding: 10px 20px; /* Padding for the buttons */
            cursor: pointer; /* Cursor style */
            font-size: 14px; /* Font size */
            margin-right: 10px; /* Space between buttons */
            transition: background-color 0.3s, color 0.3s; /* Transition effects */
        }
        .option-button:hover {
            background-color: #DC143C; /* Change background on hover */
            color: white; /* Change text color on hover */
        }
        .chat-button.has-notification {
            background-color: #FFD700; /* Change color to indicate a notification */
        }
        .chat-button[data-notification]:after {
            content: attr(data-notification);
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="chat-button" onclick="toggleChat()" data-notification="0">
        💬
    </div>
    <div class="chat-container" id="chatContainer">
        <div class="chat-header">
            <h3>Chat with AI</h3>
            <button class="close-chat" onclick="toggleChat()">×</button>
        </div>
        <div class="chat-messages" id="chatMessages"></div>
        <div class="chat-input">
            <input type="text" id="userInput" placeholder="Type your message..." onkeypress="handleKeyPress(event)">
            <button onclick="sendAdminMessage()">Send</button>
        </div>
    </div>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('js/laravel-echo.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script> <!-- Link to your JS -->
    <script>
        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendAdminMessage();
            }
        }

        let hasGreeted = false; // Flag to check if the greeting has been sent

        function toggleChat() {
            const chatContainer = document.getElementById('chatContainer');
            const currentDisplay = window.getComputedStyle(chatContainer).display;

            // Show or hide chat container based on current display state
            if (currentDisplay === 'none') {
                chatContainer.style.display = 'flex'; // Open chat
                chatContainer.style.opacity = '0';
                chatContainer.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    chatContainer.style.opacity = '1';
                    chatContainer.style.transform = 'translateY(0)';

                    if (!hasGreeted) {
                        sendInitialMessage(); // Send the initial greeting if it hasn't been sent yet
                        hasGreeted = true; // Set the flag to true after sending the greeting
                    }
                }, 50);
            } else {
                // Close chat
                chatContainer.style.opacity = '0';
                chatContainer.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    chatContainer.style.display = 'none';
                }, 300); // Match this delay with the CSS transition duration
            }
        }

        // Function to send a message from admin
        function sendAdminMessage() {
            const userInput = document.getElementById('userInput');
            const message = userInput.value.trim();

            if (message) {
                addMessage('admin', message);
                userInput.value = '';

                // Send the admin message to the server
                fetch('/admin/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    addMessage('bot', data.response); // Assuming the server responds with a bot message
                })
                .catch(error => {
                    console.error('Error:', error);
                    addMessage('bot', "I'm having trouble responding right now. Please try again later.");
                });
            }
        }

        // Listen for real-time notifications
        Echo.channel('admin-chat')
            .listen('UserRequestAccepted', (e) => {
                console.log("Received notification for user request:", e); // Log the event
                addNotification();
                addMessage('bot', `${e.userName} would like to ask queries. Would you like to accept?`);
                addAcceptRejectButtons(e.userName);
            })
            .error((error) => {
                console.error('Error subscribing to the channel:', error); // Log any subscription errors
            });

        function addNotification() {
            const chatButton = document.querySelector('.chat-button');
            const notificationCount = parseInt(chatButton.getAttribute('data-notification')) || 0;
            chatButton.setAttribute('data-notification', notificationCount + 1);
            chatButton.classList.add('has-notification'); // Add a notification style
        }

        function addAcceptRejectButtons(userName) {
            const chatMessages = document.getElementById('chatMessages');
            const buttonContainer = document.createElement('div');

            // Create Yes button
            const yesButton = document.createElement('button');
            yesButton.textContent = 'Yes';
            yesButton.className = 'option-button';
            yesButton.onclick = () => acceptUserQuery(userName); // Pass userName to accept function

            // Create No button
            const noButton = document.createElement('button');
            noButton.textContent = 'No';
            noButton.className = 'option-button';
            noButton.onclick = () => {
                addMessage('admin', "No problem! I'm here if you have any other questions.");
            };

            // Add buttons to the button container
            buttonContainer.appendChild(yesButton);
            buttonContainer.appendChild(noButton);
            chatMessages.appendChild(buttonContainer);
            chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
        }

        // Function to accept user queries
        function acceptUserQuery(userName) {
            const chatButton = document.querySelector('.chat-button');
            chatButton.setAttribute('data-notification', 0);
            chatButton.classList.remove('has-notification');

            // Message to the user confirming that the admin has accepted their query
            addMessage('admin', "I've accepted your request. How can I help you?");

            // Send notification to the admin about the user query acceptance
            fetch('/admin/chat/user-request', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ userName: userName }) // Pass the actual user name
            })
            .then(response => response.json())
            .then(data => {
                console.log("User request accepted and notified to admin.");
            })
            .catch(error => {
                console.error('Error notifying admin:', error);
            });
        }
    </script>




</body>
</html>
