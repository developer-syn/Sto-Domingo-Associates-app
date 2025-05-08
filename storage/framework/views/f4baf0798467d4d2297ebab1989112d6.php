<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>SDA | AIA PHILIPPINES</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="<?php echo e(asset('css/images/SDALOGO.png')); ?>" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/vitecss.css')); ?>">
        <script src="<?php echo e(asset('js/vitejs.js')); ?>"></script>


        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
        <!-- CSS -->
    </head>

    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-100">
            <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <?php echo e($header); ?>

                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main>
                <?php echo e($slot); ?>

            </main>
            <button id="chatButton" aria-label="Open chat">💬</button>
            <div id="chatbox">
                <div id="chatHeader">
                    <span>Chat Assistant</span>
                </div>
                <div id="chatContainer"></div>
                <div id="inputArea">
                    <input type="text" id="messageInput" placeholder="Type a message..." aria-label="Type a message" />
                    <button id="sendMessageButton" aria-label="Send message">📤</button>
                </div>
            </div>
        </div>
        <style>
        #chatButton {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: rgb(210, 46, 46);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0, 132, 255, 0.3);
        transition: all 0.3s ease;
        font-size: 24px;
        border: none;
        outline: none;
    }

    #chatbox {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        height: 500px;
        border-radius: 15px;
        overflow: hidden;
        display: none;
        flex-direction: column;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        background-color: rgb(255, 255, 255);
        z-index: 999;
    }

    #chatHeader {
        background-color: rgb(210, 46, 46);
        color: white;
        padding: 15px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    #chatContainer {
        flex-grow: 1;
        overflow-y: auto;
        padding: 20px;
        background-color: white;
        display: flex;
        flex-direction: column;
    }

    .message {
        margin: 10px 0;
        max-width: 70%;
        word-wrap: break-word;
        position: relative;
        display: flex;
        align-items: flex-end;
    }

    .message-content {
        padding: 10px 15px;
        border-radius: 18px;
    }

    .user-message {
        align-self: flex-start; /* User messages on the left */
        justify-content: flex-start;
    }

    .user-message .message-content {
        background-color: rgb(244, 243, 243);
        color: rgb(0, 0, 0);
        border-bottom-right-radius: 18px; /* Rounded right side */
        border-bottom-left-radius: 4px; /* Rounded left side */
    }

    .admin-message {
        align-self: flex-end; /* Admin messages on the right */
        justify-content: flex-end;
    }

    .admin-message .message-content {
        background-color: #ff4a4a;
        color: rgb(255, 255, 255);
        border-bottom-left-radius: 18px; /* Rounded left side */
        border-bottom-right-radius: 4px; /* Rounded right side */
    }

    #inputArea {
        display: flex;
        padding: 15px;
        background-color: rgb(238, 238, 238);
        border-top: 1px solid #ddd;
    }

    #messageInput {
        flex-grow: 1;
        padding: 10px;
        border: none;
        border-radius: 20px;
        font-size: 14px;
        outline: none;
        background-color: white;
    }

    #sendMessageButton {
        margin-left: 10px;
        padding: 10px;
        background-color: transparent;
        color: var(--primary-color);
        border: none;
        cursor: pointer;
        font-size: 20px;
    }

    .message-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 10px;
        background-color: green; /* Online status color */
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
    }
</style>
    <script>
        const chatButton = document.getElementById('chatButton');
        const chatContainer = document.getElementById('chatContainer');
        const messageInput = document.getElementById('messageInput');
        const sendMessageButton = document.getElementById('sendMessageButton');

        let isAtBottom = true;

        chatContainer.addEventListener('scroll', () => {
            isAtBottom = chatContainer.scrollHeight - chatContainer.scrollTop <= chatContainer.clientHeight + 1;
        });

        function fetchMessages() {
            fetch('/fetch/messages')
                .then(response => response.json())
                .then(data => {
                    chatContainer.innerHTML = '';
                    data.forEach(message => {
                        const messageClass = message.sender === 'user' ? 'user-message' : 'admin-message';
                        const messageElement = document.createElement('div');
                        messageElement.className = `message ${messageClass}`;



                        const messageContent = document.createElement('div');
                        messageContent.className = 'message-content';
                        messageContent.textContent = message.message;

                        messageElement.appendChild(messageContent);
                        chatContainer.appendChild(messageElement);
                    });

                    if (isAtBottom) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                })
                .catch(error => console.error('Fetch error:', error));
        }

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                const adminMessageElement = document.createElement('div');
                adminMessageElement.className = 'message admin-message';

                const adminMessageContent = document.createElement('div');
                adminMessageContent.className = 'message-content';
                adminMessageContent.textContent = message;

                adminMessageElement.appendChild(adminMessageContent);
                chatContainer.appendChild(adminMessageElement);
                messageInput.value = '';

                // Call the admin send message endpoint
                fetch('/admin/chatbot/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ message: message })
                }).then(response => response.json())
                  .then(data => {
                      fetchMessages();
                  });
            }
        }

        chatButton.addEventListener('click', () => {
            const chatbox = chatContainer.parentElement;
            if (chatbox.style.display === 'flex') {
                chatbox.style.display = 'none';
            } else {
                chatbox.style.display = 'flex';
                fetchMessages();
                messageInput.focus();
            }
        });

        sendMessageButton.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                sendMessage();
            }
        });

        setInterval(fetchMessages, 5000);
    </script>
    </body>

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>