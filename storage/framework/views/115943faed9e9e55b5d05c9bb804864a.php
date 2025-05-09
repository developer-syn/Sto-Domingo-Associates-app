<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sto. Domingo Associates | Home</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="<?php echo e(asset('css/images/SDALOGO.png')); ?>" type="image/png" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">

</head>



<main class="main">
    <section class="section1">
        <div class="welcome">
            <div class="intro">
                <h1>Welcome <br> To Our Online Community ! </h1>
            </div>
        </div>
        <div class="container">
            <div class="slides">
                <div class="slide">
                    <img src="<?php echo e(asset('css/images/slide1.jpg')); ?>" alt="">
                    <div>
                        <h1 class="slide1-content">Join Now To Collaborate With Passionate Individuals <br> In The
                            Philippines!
                        </h1>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo e(asset('css/images/slide2.png')); ?>" alt="">
                    <div>
                        <h1 class="slide2-content">One Of The Largest And Top-Performing Agency <br> Of <span
                                id="aia">AIA
                                Philippines</span></h1>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo e(asset('css/images/slide3.jpg')); ?>" alt="">
                    <div>
                        <h1 class="slide3-content">Empower Fresh Graduates And Professionals To Advance Their Careers!
                        </h1>
                    </div>
                </div>
                <div class="slide">
                    <img src="<?php echo e(asset('css/images/slide4.jpg')); ?>" alt="">
                    <div>
                        <h1 class="slide4-content">With an extensive network of branches across the Philippines!</h1>
                    </div>
                </div>
            </div>
            <div class="slide-controls">
                <button id="prev-btn"><img src="<?php echo e(asset('css/images/prev-button.png')); ?>"></button>
                <button id="next-btn"><img src="<?php echo e(asset('css/images/next-button.png')); ?>"></button>
            </div>
        </div>
    </section>

    <section class="section2">
        <div class="sec2-container">
            <div class="sec2-intro">
                <h2 style="color: white; text-shadow: 0.1vw 0 #000000, -0.1vw 0 #000000, 0 0.1vw #000000, 0 -0.1vw #000000, 0.1vw 0.1vw #000000, -0.1vw -0.1vw #000000, 0.1vw -0.1vw #000000, -0.1vw 0.1vw #000000; font-family: 'Palatino', serif; font-size: 50px; min-width: 20vh; max-width: 100vw">
                    More Than 19 Years of Service Excellence
                </h2>
            </div>
            <div class="sec2-image-container" id="imageContainer">
                <div class="sec2-image">
                    <img src="<?php echo e(asset('css/images/sec2-image1.jpg')); ?>" alt="Service image 1" loading="lazy">
                    <div class="image-overlay">
                    </div>
                </div>
                <div class="sec2-image">
                    <img src="<?php echo e(asset('css/images/sec2-image2.jpg')); ?>"alt="Service image 2" loading="lazy">
                    <div class="image-overlay">
                    </div>
                </div>
                <div class="sec2-image">
                    <img src="<?php echo e(asset('css/images/sec2-image3.jpg')); ?>" alt="Service image 3" loading="lazy">
                    <div class="image-overlay">
                    </div>
                </div>
            </div>
            <div class="scroll-indicator">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </section>

    

    <section class="section3">
        <div class="sec3-content1">
            <div class="image1"
                style="  background-image: url('<?php echo e(asset('css/images/sec3-image1.jpg')); ?>'); background-size: cover;">
                <div class="overlay"></div>
                <p class="sec3-intro">
                    Are You A Recent Graduate Or A Seasoned Professional Seeking Career Growth?
                </p>
                <h1 class="join">
                    
                    <a href="<?php echo e(route('join')); ?>">JOIN US NOW!!!</a>
                    <br>
                    <span class="join1">
                        Become A Professional Financial Adviser And Claim These Guaranteed Benefits
                    </span>
                </h1>
                <div class="sec3-container">
                    <div class="row">

                        <div class="column1">
                            <h2>ADVANCEMENTS</h2>
                            <p>EXPLORE LIMITLESS CAREER GROWTH <br> <br> GROW YOUR SKILLS WITH US!</p>
                        </div>
                        <div class="column2">
                            <h2>FLEXIBILITY</h2>
                            <p>CONTROL YOUR OWN TIME <br> <br> ENJOY A FLEXIBLE SCHEDULE!</p>
                        </div>
                        <div class="column3">
                            <h2>TRAVEL REWARDS</h2>
                            <p>GET REWARDED WITH LOCAL & INTERNATIONAL TRAVELS!</p>
                        </div>
                        <div class="column4">
                            <h2>FULFILLMENT</h2>
                            <p>BE PERSONALLY FULFILLED <br> <br> SERVE A GREATER PURPOSE!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section4">
        <div class="sec4-contents">
            <div class="sec4-intro">
                <h1>OUR PARTNER</h1>
            </div>
            <div class="sec4-images">
                <div class="sec4-image1"><a href="https://www.aia.com.ph/en/" target="_blank"><img
                            src="<?php echo e(asset('css/images/sec4-image1.jpg')); ?>"></a></div>
            </div>
        </div>
    </section>
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
<header class="header">
    <div id="header-content">
        <div class="logo">
            <a href="/">
                <div id="logo-img"></div>
            </a>
            <div class="company-name">Sto Domingo Associates</div>
        </div>

        <nav class="navigation">
            <input type="checkbox" id="nav-toggle" class="nav-toggle">
            <label for="nav-toggle" class="nav-toggle-label">
                <span class="hamburger-icon"></span>
            </label>
            <ul id="nav-list" class="nav-list">
                <li class="nav-item">
                    <a href="/"
                        class="nav-link <?php echo e(Route::currentRouteName() == 'home' ? 'active' : ''); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('display-news')); ?>"
                        class="nav-link <?php echo e(Route::currentRouteName() == 'display-news' ? 'active' : ''); ?>">News &
                        Media</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('organization')); ?>"
                        class="nav-link <?php echo e(Route::currentRouteName() == 'organization' ? 'active' : ''); ?>">Organization</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('about')); ?>"
                        class="nav-link <?php echo e(Route::currentRouteName() == 'about' ? 'active' : ''); ?>">About</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('join')); ?>"
                        class="nav-link <?php echo e(Route::currentRouteName() == 'join' ? 'active' : ''); ?>">Join Now</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <div class="footer-logo">
            </div>
        </div>
        <div class="footer-section">
            <h3 class="footer-title">Location</h3>
            <div class="footer-content">
                <a href="https://maps.app.goo.gl/fPQdGm9nRuXq1Y1B9" class="address" target="_blank">
                    <p>GF, Philam Salcedo Bldg, 126 L.P. Leviste Street, Salcedo Village, Makati, 1227 Metro Manila</p>
                </a>
                <a href="https://maps.app.goo.gl/u1LUdvj3ff1S2mTx8" class="address" target="_blank">
                    <p>MV34+25H, North Road, Tagbilaran City, Bohol</p>
                </a>
                <a href="https://maps.app.goo.gl/1nj4YVSikmqrpH6z5" class="address" target="_blank">
                    <p>8W84+JFQ, Cardinal Rosales Ave, Cebu City, 6000 Cebu</p>
                </a>
                <a href="https://maps.app.goo.gl/PMezx8YhhEfXuAoB7" class="address" target="_blank">
                    <p>8854+X43, Silliman Ave, Dumaguete, Negros Oriental</p>
                </a>
                <a href="https://maps.app.goo.gl/BeXzPfQPxBtoxket9" class="address" target="_blank">
                    <p>2/F Kingsborough Building, Jose Abad Santos Ave, San Fernando, 2000 Pampanga</p>
                </a>
            </div>
        </div>
        <div class="footer-section">
            <h3 class="footer-title">Contact Information</h3>
            <div class="footer-content">
                <p>Email: stodomingoassociates@gmail.com</p>
                <p>Landline: (+63) 17 800 9303</p>
                <p>Smart: (+63) 17 800 9303</p>
                <p>Globe: (+63) 17 800 9303</p>
            </div>
        </div>
        <div class="footer-section">
            <h3 class="footer-title">Quick Links</h3>
            <div class="footer-content">
                <a href="<?php echo e(route('terms&condition')); ?>" class="terms">Terms and Conditions</a>
                <a href="<?php echo e(route('2023')); ?>" class="umpad">John Mark Umpad</a>
                <a href="<?php echo e(route('2024')); ?>" class="csucc-student-web-dev">Caraga State University - Cabadbaran
                    Campus - Students</a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="copyright">
            <p>Copyright © 2023, Sto. Domingo Associates Group Limited and it's subsidiries. All rights reserved.</p>
        </div>
        <div class="social-icons">
            <a href="<?php echo e(route('admin_login')); ?>" class="icon admin">
                <img src="<?php echo e(asset('css/images/admin_icon_2.jpg')); ?>" alt="Admin" class="admin-icon">
                <span class="tooltip">Admin</span>
            </a>
            <a href="https://www.facebook.com/SDAFinancialAdvisors" target="_blank" class="icon facebook">
                <img src="<?php echo e(asset('css/images/fb1.png')); ?>" alt="Facebook" class="facebook-icon">
                <span class="tooltip">Facebook</span>
            </a>
            <a href="https://www.linkedin.com/company/stodomingoassociates/about/?fbclid=IwAR0_03-7ES3Ls_e30WHtbHiF0WxDl6OZiF2ccjDp8aGviNTh3jNPxkgIxCY"
                target="_blank" class="icon linkedin">
                <img src="<?php echo e(asset('css/images/linked1.png')); ?>" alt="LinkedIn" class="linkedin-icon">
                <span class="tooltip">LinkedIn</span>
            </a>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const footerTitles = document.querySelectorAll('.footer-title');

        footerTitles.forEach(title => {
            title.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    title.classList.toggle('active');
                    const content = title.nextElementSibling;
                    content.classList.toggle('active');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.sec2-image');
        const imageContainer = document.getElementById('imageContainer');
        const scrollIndicators = document.querySelectorAll('.scroll-indicator span');

        function fadeInImages() {
            images.forEach((image, index) => {
                setTimeout(() => {
                    image.style.opacity = '1';
                }, index * 200);
            });
        }

        // Intersection Observer for fade-in effect
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    fadeInImages();
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        observer.observe(imageContainer);

        // Add hover effect
        images.forEach(image => {
            image.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.05)';
            });

            image.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Update scroll indicators
        function updateScrollIndicators() {
            const scrollPosition = imageContainer.scrollLeft;
            const maxScroll = imageContainer.scrollWidth - imageContainer.clientWidth;
            const scrollPercentage = scrollPosition / maxScroll;

            scrollIndicators.forEach((indicator, index) => {
                if (scrollPercentage >= index / 2 && scrollPercentage <= (index + 1) / 2) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        imageContainer.addEventListener('scroll', updateScrollIndicators);
        updateScrollIndicators(); // Initial call

        // Add keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') {
                imageContainer.scrollBy({
                    left: imageContainer.clientWidth,
                    behavior: 'smooth'
                });
            } else if (e.key === 'ArrowLeft') {
                imageContainer.scrollBy({
                    left: -imageContainer.clientWidth,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>

<style>
    .section2 {
        padding: 2rem;
        background-color: rgba(188, 188, 188, 0.504);
    }

    .sec2-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .sec2-intro {
        text-align: center;
        margin-bottom: 2rem;
    }

    .sec2-intro h2 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .highlight {
        color: #ff0000;
        transition: color 0.3s ease;
    }

    /* Center the image container */
    .sec2-image-container {
        display: flex;
        justify-content: center;
        /* Centers the images horizontally */
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        gap: 1rem;
        padding-bottom: 1rem;
        height: 500px;
        min-height: 20vw;
        /* Minimum height constraint */
        max-height: 45vw;
        /* Maximum height constraint */
    }

    /* Adjusted .sec2-image for fixed size and centering */
    .sec2-image {
        width: 30vw;
        /* Base width is 30% of the viewport */
        min-width: 30vw;
        /* Minimum width constraint */
        max-width: 60vw;
        /* Maximum width constraint */

        height: 20vw;
        /* Base height is 20% of the viewport */
        min-height: 20vw;
        /* Minimum height constraint */
        max-height: 40vw;
        /* Maximum height constraint */

        flex: 0 0 auto;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(255, 0, 0, 0.3);
        transition: transform 0.3s ease;
        margin: 0 auto;
        margin-top: 60px;
        /* Centers each image in the container */
        scroll-snap-align: center;
    }

    /* Ensures the image fills the container properly */
    .sec2-image img {
        width: 100%;
        /* Image fills the container's width */
        height: 100%;
        /* Image fills the container's height */
        object-fit: cover;
        /* Ensures the image maintains its aspect ratio */
        display: block;
    }




    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sec2-image:hover .image-overlay {
        opacity: 1;
    }

    .scroll-indicator {
        display: flex;
        justify-content: center;
        margin-top: 1rem;
    }

    .scroll-indicator span {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #ccc;
        margin: 0 5px;
        transition: background-color 0.3s ease;
    }

    .scroll-indicator span.active {
        background-color: #007bff;
    }

    @media (min-width: 768px) {
        .sec2-intro h2 {
            font-size: 2rem;
        }

        .sec2-image-container {
            overflow-x: visible;
            flex-wrap: nowrap;
        }

        .sec2-image {
            flex: 0 0 calc(33.333% - 1rem);
        }
    }

    @media (min-width: 1024px) {
        .sec2-intro h2 {
            font-size: 2.5rem;
        }
    }
</style>



</style>
<script src="<?php echo e(asset('js/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/header-awareness.js')); ?>"></script>
<script>
    const chatButton = document.getElementById('chatButton');
    const chatContainer = document.getElementById('chatContainer');
    const messageInput = document.getElementById('messageInput');
    const sendMessageButton = document.getElementById('sendMessageButton');

    let isAtBottom = true; // Flag to check if user is at the bottom of the chat

    // Check if the user is at the bottom of the chat container
    chatContainer.addEventListener('scroll', () => {
        isAtBottom = chatContainer.scrollHeight - chatContainer.scrollTop <= chatContainer.clientHeight + 1;
    });

    function fetchMessages() {
        fetch('/fetch/messages')
            .then(response => response.json())
            .then(data => {
                chatContainer.innerHTML = '';
                data.forEach(message => {
                    const messageClass = message.sender === 'user' ? 'user-message' : 'bot-message';
                    const messageElement = document.createElement('div');
                    messageElement.className = `message ${messageClass}`;
                                            // Create avatar for admin (bot)
                                            if (message.sender !== 'user') {
                        const avatarElement = document.createElement('div');
                        avatarElement.className = 'message-avatar';
                        avatarElement.textContent = 'A'; // Initial for Admin
                        messageElement.prepend(avatarElement);
                    }


                    const messageContent = document.createElement('div');
                    messageContent.className = 'message-content';
                    messageContent.textContent = message.message;

                    messageElement.appendChild(messageContent);
                    chatContainer.appendChild(messageElement);
                });

                // Only scroll to the bottom if the user is at the bottom
                if (isAtBottom) {
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            })
            .catch(error => console.error('Fetch error:', error));
    }

    function sendMessage() {
        const message = messageInput.value.trim();
        if (message) {
            const userMessageElement = document.createElement('div');
            userMessageElement.className = 'message user-message';

            const userMessageContent = document.createElement('div');
            userMessageContent.className = 'message-content';
            userMessageContent.textContent = message;

            userMessageElement.appendChild(userMessageContent);
            chatContainer.appendChild(userMessageElement);
            messageInput.value = '';

            fetch('/chatbot/message', {
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
            chatbox.style.display = 'none';  // Hide chatbox if it's already open
        } else {
            chatbox.style.display = 'flex';   // Show chatbox if it's hidden
            fetchMessages();                   // Fetch messages when opening the chat
            messageInput.focus();              // Focus on the input field
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

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/welcome.blade.php ENDPATH**/ ?>