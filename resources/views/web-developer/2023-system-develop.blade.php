<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Responsive Portfolio Website HTML CSS| CodingNepal</title>
    <link rel="stylesheet" href="{{asset('css/style1.css')}}" />
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
                {{-- <li><a href="#skills">Skills</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li> --}}
                <li><a href="/">return</a></li>
                <div class="cancel-btn">
                    <i class="fas fa-times"></i>
                </div>
            </ul>
            <div class="media-icons">
                <a href="https://www.facebook.com/JMU.0319/about"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
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
                <div class="text-three">I am</div>
                <div class="text-two">Mark Umpad</div>
                <div class="text-four">From Cebu City</div>
            </div>
            {{-- <div class="button">
                <button>Hire Me</button>
            </div> --}}
        </div>
    </section>

    <!-- About Section Start -->
    <section class="about" id="about">
        <div class="content">
            <div class="title"><span>About Me</span></div>
            <div class="about-details">
                <div class="left">
                    <img src="{{ asset('css/images/umpad.jpg')}}" alt="" />
                </div>
                <div class="right">
                    <div class="topic">Developed System with Native PHP: Sto. Domingo Associates</div>
                    <p><a href="https://www.facebook.com/JMU.0319/about"><strong>Mark Umpad</strong></a></p>
                    {{-- <p>
                        We are a dedicated team of students from Caraga State University - Cabadbaran Campus, driven by our passion for innovation and technology. Our recent project involves transitioning a system from Native PHP to the Laravel framework, ensuring enhanced performance, scalability, and modern design standards. The development was a collaborative effort with each member bringing their expertise to the table.

                        The system development was led by <strong><a href="https://www.facebook.com/synkyle.cael/" class="names">Syn Kyle C. Cael</a></strong>, who served as the primary programmer, spearheading the technical transformation. The user interface and user experience (UI/UX) design was crafted by <strong><a href="https://www.facebook.com/profile.php?id=100005219175652&mibextid=LQQJ4d" class="names">John Ashley D. Villanueva</a></strong>, ensuring an intuitive and visually appealing experience. The back-end logic and functionality were handled by <strong><a href="https://www.facebook.com/nathaniel.paloga">Nathaniel Mear V. Paloga</a></strong>, guaranteeing robust performance and security on the server side.

                        We are proud students of the Bachelor of Science in Information Technology, majoring in Programming, at Caraga State University - Cabadbaran Campus, located on T. Curato Street, Cabadbaran City, Agusan Del Norte. Through this project, we aim to demonstrate our skills in modern software development and our commitment to delivering high-quality solutions.
                    </p> --}}

                    {{-- <div class="button">
                        <button>Download CV</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- My Skill Section Start -->
    <!-- Section Tag and Other Div will same where we need to put same CSS -->
    {{-- <section class="skills" id="skills">
        <div class="content">
            <div class="title"><span>My Skills</span></div>
            <div class="skills-details">
                <div class="text">
                    <div class="topic">Skills Reflects Our Knowledge</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus natus tenetur tempora? Quasi, rem
                        quas
                        omnis. Porro rem aspernatur reiciendis ut praesentium minima ad, quos, officia! Illo libero, et,
                        distinctio
                        repellat sed nesciunt est modi quaerat placeat. Quod molestiae, alias?</p>
                    <div class="experience">
                        <div class="num">10</div>
                        <div class="exp">
                            Years Of <br />
                            Experience
                        </div>
                    </div>
                </div>
                <div class="boxes">
                    <div class="box">
                        <div class="topic">HTML</div>
                        <div class="per">90%</div>
                    </div>
                    <div class="box">
                        <div class="topic">CSS</div>
                        <div class="per">80%</div>
                    </div>
                    <div class="box">
                        <div class="topic">JavScript</div>
                        <div class="per">70%</div>
                    </div>
                    <div class="box">
                        <div class="topic">PHP</div>
                        <div class="per">60%</div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- My Services Section Start -->
    {{-- <section class="services" id="services">
        <div class="content">
            <div class="title"><span>My Services</span></div>
            <div class="boxes">
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div class="topic">Web Devlopment</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="topic">Graphic Design</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="topic">Digital Marketing</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fab fa-android"></i>
                    </div>
                    <div class="topic">Icon Design</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-camera-retro"></i>
                    </div>
                    <div class="topic">Photography</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
                <div class="box">
                    <div class="icon">
                        <i class="fas fa-tablet-alt"></i>
                    </div>
                    <div class="topic">Apps Devlopment</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia autem quam odio, qui
                        voluptatem
                        eligendi?</p>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Contact Me section Start -->
    {{-- <section class="contact" id="contact">
        <div class="content">
            <div class="title"><span>Contact Me</span></div>
            <div class="text">
                <div class="topic">Have Any Project?</div>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam neque ipsum corrupti dolores, facere
                    numquam
                    voluptate aspernatur sit perferendis qui nisi modi! Recusandae deserunt consequatur voluptatibus
                    alias
                    repellendus nobis eligendi.</p>
                <div class="button">
                    <button>Let's Chat</button>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Footer Section Start -->
    <footer>
        <div class="text">
            <span>Copyright © 2023, This Website is made by <a href="{{route('2023')}}" class="umpad">John Mark Umpad</a>,
                Updated by <br><a href="{{route('2024')}}" class="csucc-student-web-dev">Caraga State University - Cabadbaran Campus - Students</a>.</span>
        </div>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
