<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Responsive Portfolio Website HTML CSS| CodingNepal</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <!-- Move to up button -->
    <div class="scroll-button">
        <a href="#home"><i class="fas fa-arrow-up"></i></a>
    </div>
    <!-- navgaition menu -->
    <nav>
        <div class="navbar">
            <div class="logo"><a href="#">The Developers</a></div>
            <ul class="menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                
                <li><a href="/">return</a></li>
                <div class="cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
            </ul>
            
        </div>
        <div class="menu-btn">
            <i class="fas fa-bars"></i>
        </div>
    </nav>

    <!-- Home Section Start -->
    <section class="home" id="home">
        <div class="home-content">
            <div class="text">
                <div class="text-one">Hello,</div>
                <div class="text-three">We are From</div>
                <div class="text-two">CSU - Cabadbaran Campus</div>
                <div class="text-four">Students</div>
            </div>
            
        </div>
    </section>

    <!-- About Section Start -->
    <section class="about" id="about">
        <div class="content">
            <div class="title"><span>About Us</span></div>
            <div class="about-details">
                <div class="left">
                    <img src="<?php echo e(asset('css/images/csucc-students.jpg')); ?>" alt="" />
                </div>
                <div class="right">
                    <div class="topic">Transforming Systems with Laravel Framework</div>

                    <p>
                        We are a dedicated team of students from Caraga State University - Cabadbaran Campus, driven by our passion for innovation and technology. Our recent project involves transitioning a system from Native PHP to the Laravel framework, ensuring enhanced performance, scalability, and modern design standards. The development was a collaborative effort with each member bringing their expertise to the table.

                        The system development was led by <strong><a href="https://www.facebook.com/synkyle.cael/" class="names">Syn Kyle C. Cael</a></strong> (orange polo-shirt), who served as the primary programmer, spearheading the technical transformation. The user interface and user experience (UI/UX) design was crafted by <strong><a href="https://www.facebook.com/profile.php?id=100005219175652&mibextid=LQQJ4d" class="names">John Ashley D. Villanueva</a></strong> (left side) and <strong><a href="https://web.facebook.com/people/Kyle-Casleb/100068962814751/" class="names">Kyle N. Casleb</a></strong> (center), ensuring an intuitive and visually appealing experience. The back-end logic and functionality were handled by <strong><a href="https://www.facebook.com/nathaniel.paloga" class="names">Nathaniel Mear V. Paloga</a></strong> (right side), guaranteeing robust performance and security on the server side.

                        We are proud students of the Bachelor of Science in Information Technology, majoring in Programming, at Caraga State University - Cabadbaran Campus, located on T. Curato Street, Cabadbaran City, Agusan Del Norte. Through this project, we aim to demonstrate our skills in modern software development and our commitment to delivering high-quality solutions.
                    </p>

                    
                </div>
            </div>
        </div>
    </section>

    <!-- My Skill Section Start -->
    <!-- Section Tag and Other Div will same where we need to put same CSS -->
    

    <!-- My Services Section Start -->
    

    <!-- Contact Me section Start -->
    

    <!-- Footer Section Start -->
    <footer>
        <div class="text">
            <span>Copyright © 2023, This Website is made by <a href="<?php echo e(route('2023')); ?>" class="umpad">John Mark Umpad</a>,
                Updated by <br><a href="<?php echo e(route('2024')); ?>" class="csucc-student-web-dev">Caraga State University - Cabadbaran Campus - Students</a>.</span>
        </div>
    </footer>

    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
</body>

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/web-developer/2024-system-update.blade.php ENDPATH**/ ?>