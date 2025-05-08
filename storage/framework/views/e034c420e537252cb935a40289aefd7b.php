<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sto. Domingo Associates | Organization</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="<?php echo e(asset('css/images/SDALOGO.png')); ?>" type="image/png" />
    <link rel="stylesheet" href="<?php echo e(asset('css/org.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

</head>

<body>
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
    <main class="main">
        <section class="section1-part1">
            <div class="founder-image">
                <div id="founder-name">
                    <h1>Josefino Sto. Domingo</h1>
                    <p>Founder</p>
                </div>
            </div>
            <div id="agency-founder-info">
                <div id="founder-info">
                    <div>
                        <h1>Josefino Sto. Domingo</h1>
                        <p>Under Josefino’s leadership, SDA achieved significant milestones, including being named
                            Philam Life’s top district for early MDRT qualifiers in the first half of FY 2017. They were
                            also the national champion in the district category during Philam Life’s 70th Anniversary
                            Cup Challenge that same year. In 2018, SDA received recognition as the top district for
                            Million Dollar Round Table (MDRT) qualifiers and Annualized New Premium (ANP). Josefino’s
                            commitment to cultivating proficient financial advisors and delivering tailored financial
                            solutions has solidified SDA’s reputation for excellence in the industry.</p>
                    </div>
                    <div>
                        <p>Josefino Sto. Domingo, a BA graduate in Political Science from the University of the
                            Philippines (1968-1972), boasts over 30 years of experience in the financial services
                            industry. Notably, he served as Executive Vice President for Sales and Marketing at Philam
                            Life (2002-2004). In 2005, Josefino founded SDA, dedicated to addressing the diverse
                            financial needs of the Filipino market through Philam Life’s comprehensive product
                            offerings. Since 2015, he has led the SDA Philam Life team as District Manager,
                            demonstrating exceptional expertise and commitment.</p>
                    </div>
                </div>
                <div id="f-button"><button id="founder-button">Read More</button></div>
            </div>
        </section>

        <section class="section1-part2">
            <div class="agency-manager-image">
                <div id="agency-manager-name">
                    <h1>Edna Liza Damaso</h1>
                    <p>Agency Manager</p>
                </div>
            </div>
            <div id="agency-manager-info">
                <div id="manager-info">
                    <div>
                        <h1>Edna Liza Damaso</h1>
                        <p>
                            Edna Liza M. Damaso brings a wealth of experience to her role as Unit Manager at AIA
                            Philippines, where
                            she has been serving since July 2016. Based in Makati, she oversees operations with a focus
                            on excellence
                            and client satisfaction. Her prior experience includes a pivotal role as Head of Unit at
                            Security Bank
                            Corporation from February 2014 to July 2016, also in Makati, where she honed her leadership
                            skills and
                            strategic planning abilities.

                        </p>
                    </div>
                    <div>
                        <p>
                            Before joining Security Bank, Edna was a Sales Manager at CTBC Bank Philippines from October
                            2008 to
                            February 2014 in Taguig, where she demonstrated remarkable sales acumen and team leadership.
                            Her career
                            began at Citi as a Collections Officer in Quezon City, where she worked from April 2001 to
                            April 2008.
                            Throughout her career, Edna has consistently showcased her dedication, strategic thinking,
                            and ability to
                            drive teams toward achieving organizational goals.
                        </p>
                    </div>
                </div>
                <div id="m-button"><button id="manager-button">Read More</button></div>
            </div>
        </section>

        <section class="section1-part3">
            <div class="founder-wife-image">
                <div id="founder-wife-name">
                    <h1>Portia Sto. Domingo</h1>
                    <p>Operation Manager</p>
                </div>
            </div>
            <div id="founder-wife-info">
                <div id="wife-info">
                    <div>
                        <h1>Portia Sto. Domingo</h1>
                        <p>
                            Portia Sto. Domingo, a distinguished professional in the financial services sector, holds a
                            BS in
                            Statistics (1971-1975) and a Master of Arts in Economics (1975-1977) from the University of
                            the
                            Philippines, along with an MBA in Business Administration and Management from Ateneo de
                            Manila University
                            (1988-1990). Her robust academic background laid the groundwork for a career marked by
                            strategic insight
                            and leadership.


                        </p>
                    </div>

                    <div>
                        <p>
                            From January 2010 to December 2014, Portia served as the First Vice President for Strategic
                            Planning &
                            Business Development at Philam Life, now known as AIA Philippines. In this role, she played
                            a crucial part
                            in shaping the company's strategic direction. Since January 2015, she has been the
                            Operations & Business
                            Development Manager at Sto. Domingo Associates (SDA) Philam Life, a company founded by her
                            husband,
                            Josefino Sto. Domingo. Portia's extensive experience and dedication have been instrumental
                            in driving
                            SDA's growth and success, solidifying its reputation for excellence in the financial
                            services industry.
                        </p>
                    </div>

                </div>
                <div id="w-button"><button id="wife-button">Read More</button></div>
            </div>
        </section>

        <div id="section2-intro1">Sto. Domingo Associates: Branch Teams</div>
        <section class="section2">
            <div id="section2-nav">
                <nav1>
                    <div class="flex justify-center space-x-4">
                        <div>
                            <a href="#" data-branch="makati" class="branch-btn">
                                <button id="makati-btn" class="branch-btn">MAKATI<i
                                        class="ri-map-pin-user-fill"></i></button>
                            </a>
                        </div>
                        <div>
                            <a href="#" data-branch="pampanga" class="branch-btn">
                                <button id="pampanga-btn" class="branch-btn">PAMPANGA<i
                                        class="ri-map-pin-user-fill"></i></button>
                            </a>
                        </div>
                        <div>
                            <a href="#" data-branch="cebu" class="branch-btn">
                                <button id="cebu-btn" class="branch-btn">CEBU <i
                                        class="ri-map-pin-user-fill"></i></button>
                            </a>
                        </div>
                        <div>
                            <a href="#" data-branch="bohol" class="branch-btn">
                                <button id="bohol-btn" class="branch-btn">BOHOL<i
                                        class="ri-map-pin-user-fill"></i></button>
                            </a>
                        </div>
                        <div>
                            <a href="#" data-branch="other" class="branch-btn">
                                <button id="other-btn" class="branch-btn">OTHER BRANCHES<i
                                        class="ri-map-pin-user-fill"></i></button>
                            </a>
                        </div>
                    </div>
                </nav1>
            </div>

            <div id="section2-intro" class="text-center text-lg font-semibold mb-4">Please Select a Branch</div>

            <div id="branch-managers" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
                style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 440px; padding: 10px;">
                <div id="managers-list" class="employee-list flex overflow-x-auto">
                </div>
            </div>
            <br>
            
            <h1 style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
                <!-- when click the specify manager in a branch it should display his or her name -->
                <span id="employeeTitleManagerName">Employee</span>
            </h1>
            <div id="employee-container" class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
                style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 410px; padding: 10px;">
                <div class="employee-list flex overflow-x-auto" id="employees-list">
                </div>
            </div>
        </section>
    </main>

    <div id="managerModal" class="modal" role="dialog" aria-labelledby="modalManagerName">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fade-in">BACKGROUND</h3>
                <span class="close">&times;</span>
            </div>
            <h2 id="modalManagerName" class="fade-in"></h2>
            <p id="modalManagerEducation" class="fade-in"></p>
            <p id="modalManagerSkills" class="fade-in"></p>
        </div>
    </div>

    <div id="EmployeeModal" class="modal" role="dialog" aria-labelledby="modalEmployeeName">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="fade-in">BACKGROUND</h3>
                <span class="close">&times;</span>
            </div>
            <h2 id="modalEmployeeName" class="fade-in"></h2>
            <p id="modalEmployeeEducation" class="fade-in"></p>
            <p id="modalEmployeeSkills" class="fade-in"></p>
        </div>
    </div>


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
                        <p>GF, Philam Salcedo Bldg, 126 L.P. Leviste Street, Salcedo Village, Makati, 1227 Metro Manila
                        </p>
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
    <style>z
        .photo {
            width: 200px;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .photo:hover {
            transform: scale(1.05);
        }

        .modal-header {
            display: flex;
            /* Use flexbox to align items */
            justify-content: center;
            /* Center items */
            align-items: center;
            /* Center items vertically */
            position: relative;
            /* Position for absolute child */
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Semi-transparent background */
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            /* Center the modal */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Full width */
            max-width: 800px;
            /* Limit the max width */
            height: 600px;
            /* Fixed height for the modal content */
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            /* Prevent horizontal overflow */
            display: flex;
            /* Use flexbox layout */
            flex-direction: column;
            /* Stack items vertically */
            overflow-y: auto;
            font-size: 14px;
            text-align: justify;
        }

        .modal-body {
            flex: 1;
            /* Allow the body to take the remaining space */
            overflow-y: auto;
            /* Enable vertical scrolling */
            padding-right: 10px;
            /* Add some padding to prevent content from being flush with the scrollbar */
        }

        .close {
            position: absolute;
            /* Positioning it absolutely */
            right: 20px;
            /* Aligns to the right */
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in-out;
            font-size: 1.2em;
            /* Adjusted for responsiveness */
            white-space: normal;
            /* Allow text to wrap normally */
        }

        .fade-in.show {
            opacity: 1;
        }

        h2,
        h3,
        p {
            margin: 10px 0;
            /* Add some margin to elements for spacing */
            line-height: 1.5;
            /* Improve readability */
            word-wrap: break-word;
            /* Allow long words to break and wrap */
        }
    </style>

    </style>
    <script src="<?php echo e(asset('js/org.js')); ?>"></script>
    <script src="<?php echo e(asset('js/header-awareness.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/organization.blade.php ENDPATH**/ ?>