<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SDA-Admin</title>
    <link rel="icon" href="images\SDALOGO.png" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap">
    <style>
        .error-message {
            color: #d80e30;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="scroll-down">SCROLL DOWN
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path d="M16 3C8.832031 3 3 8.832031 3 16s5.832031 13 13 13 13-5.832031 13-13S23.167969 3 16 3zm0 2c6.085938 0 11 4.914063 11 11 0 6.085938-4.914062 11-11 11-6.085937 0-11-4.914062-11-11C5 9.914063 9.914063 5 16 5zm-1 4v10.28125l-4-4-1.40625 1.4375L16 23.125l6.40625-6.40625L21 15.28125l-4 4V9z" />
        </svg>
    </div>
    <div class="container" id="login">
        <div class="modal" id="loginModal">
            <div class="modal-container">
                <div class="modal-left">
                    <h1 class="modal-title">Welcome!</h1>
                    
                        <form method="POST" action="<?php echo e(route('login')); ?>" id="loginForm">
                            <?php echo csrf_field(); ?>
                        <div class="input-block">
                            <label for="email" class="input-label">Email</label>
                            <input type="text" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="input-block">
                            <label for="password" class="input-label">Password</label>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                        </div>
                        <?php if (isset($_GET['error'])): ?>
                            <div class="error-message" id="error-message">INVALID USERNAME OR PASSWORD</div>
                        <?php endif; ?>

                        <div class="modal-buttons">
                            <button type="submit" class="input-button" name="log">Login</button>
                            <br>
                            <a href="/" class="homepage-link">Go to Homepage</a>
                        </div>
                    </form>
                </div>
                <div class="modal-right">
                    <div class="slideshow">
                        <img src="<?php echo e(asset('css/images/sec4-image1.jpg')); ?>" alt="Additional Image" class="slide">
                        <img src="<?php echo e(asset('css/images/SDA.png')); ?>" alt="SDA Logo" class="slide">
                        <!-- Add more images here if needed -->
                    </div>
                </div>
                <button class="icon-button close-button" id="closeModal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <path d="M 25 3 C 12.86158 3 3 12.86158 3 25 C 3 37.13842 12.86158 47 25 47 C 37.13842 47 47 37.13842 47 25 C 47 12.86158 37.13842 3 25 3 z M 25 5 C 36.05754 5 45 13.94246 45 25 C 45 36.05754 36.05754 45 25 45 C 13.94246 45 5 36.05754 5 25 C 5 13.94246 13.94246 5 25 5 z M 16.990234 15.990234 A 1.0001 1.0001 0 0 0 16.292969 17.707031 L 23.585938 25 L 16.292969 32.292969 A 1.0001 1.0001 0 1 0 17.707031 33.707031 L 25 26.414062 L 32.292969 33.707031 A 1.0001 1.0001 0 1 0 33.707031 32.292969 L 26.414062 25 L 33.707031 17.707031 A 1.0001 1.0001 0 0 0 32.980469 15.990234 A 1.0001 1.0001 0 0 0 32.292969 16.292969 L 25 23.585938 L 17.707031 16.292969 A 1.0001 1.0001 0 0 0 16.990234 15.990234 z"></path>
                    </svg>
                </button>
            </div>
            <button class="modal-button" id="openModal">Click here to login</button>
        </div>
    </div>
    <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
    <script>
        // Automatically open modal if there's an error
        document.addEventListener('DOMContentLoaded', (event) => {
            const error = new URLSearchParams(window.location.search).get('error');
            if (error) {
                openModal(); // Function to open the modal
            }
        });
    </script>
</body>

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/auth/login.blade.php ENDPATH**/ ?>