<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Sto. Domingo Associates Agency</title>
    <link rel="icon" href="<?php echo e(asset('css/images/SDALOGO.png')); ?>" type="image/png" />
    <link rel="stylesheet" href="<?php echo e(asset('css/join.css')); ?>">
    <link href='https://fonts.googleapis.com/css?family=ADLaM Display' rel='stylesheet'>
</head>

<style>
    .umpad {
        color: rgb(88, 0, 0);
        text-decoration: underline rgb(0, 0, 0)
    }

    .umpad:hover {
        color: #00ce1b;
        text-decoration: underline;
    }

    .csucc-student-web-dev {
        color: #047e14;
        text-decoration: underline rgb(0, 0, 0)
    }

    .csucc-student-web-dev:hover {
        color: #00ce1b;
        text-decoration: underline;
    }
</style>

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
        <section class="section1">
            <div class="container1">
                <div class="part1">
                    <h1>Contact Us</h1>
                    <p>Fill up the form below to send us a message.</p>

                    <form action="<?php echo e(route('submit')); ?>" method="POST" id="form" class="needs-validation">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="access_key" value="b0539e9d-c6b1-4cf8-846b-2636724345ed" />
                        <input type="hidden" name="subject" value="New Submission from SDA Website" />
                        <input type="checkbox" name="botcheck" id="" style="display: none;" />

                        <div class="c1">
                            <!-- Type of Inquiry -->
                            <div class="c1-p1">
                                <label for="inquiry">Type of Inquiry</label>
                                <select name="inquiry_type" class="inquiry" id="inquiry" required>
                                    <option value="">Please Select</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Product Inquiry">Product Inquiry</option>
                                    <option value="Claim Inquiry">Claim Inquiry</option>
                                    <option value="Customer Feedback">Customer Feedback</option>
                                    <option value="Career">Career</option>
                                </select>
                                <div class="invalid-feedback">Please Choose the Type of Inquiry</div>
                            </div>

                            <!-- Type of Job -->
                            <div class="c1-p1">
                                <label for="job">Type of Job</label>
                                <select name="job_type" class="job" id="job" disabled>
                                    <option value="">Please Select</option>
                                    <option value="Financial Advisor">Financial Advisor</option>
                                    <option value="Customer service">Customer service</option>
                                    <option value="Risk managers">Risk managers</option>
                                    <option value="Marketing specialists">Marketing specialists</option>
                                    <option value="Loss control specialists">Loss control specialists</option>
                                    <option value="Technical support">Technical support</option>
                                </select>
                                <div class="invalid-feedback">Please Choose the Type of Job</div>
                            </div>
                        </div>

                        <!-- Manager and Branch Fields in One Row -->
                        <div class="c1">
                            <div class="c1-p1" id="manager-field" style="display: none; flex: 1;">
                                <label for="manager">Please Select a Manager</label>
                                <select name="manager_type" class="manager" id="manager">
                                    <option value="">Select a Manager</option>
                                    <?php $__currentLoopData = $managerProfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($manager->name); ?>" data-branch="<?php echo e($manager->branch); ?>"
                                            data-specify-branch="<?php echo e($manager->specify_branch); ?>">
                                            <?php echo e($manager->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <option value="Others">Others</option>
                                </select>
                                <div class="invalid-feedback">Please Select a Manager</div>
                            </div>

                            <!-- Branch Field (Hidden initially) -->
                            <div class="c1-p1" id="branch-field" style="display: none; flex: 1;">
                                <label for="branch-input" class="branch-label">Branch:</label>
                                <input type="hidden" name="branch" id="branch-input">
                                <span id="branch-display" class="branch-span"></span>
                            </div>

                            <input type="hidden" name="specify_branch" id="specify-branch-input">
                        </div>

                        <!-- Specify Manager Field (Initially Hidden) -->
                        <div class="c1">
                            <!-- Specify Manager and Specify Branch Fields side by side -->
                            <div class="c1-p1 specify-manager" style="display: none; flex: 1;">
                                <label for="specify-manager">Please Specify the Recruiter</label>
                                <input type="text" name="specify_manager"
                                    id="specify-manager"class="specify-manager"
                                    placeholder="Enter Recruiter's Name" />
                                <div class="invalid-feedback">Please specify the recruiter.</div>
                            </div>

                            <!-- Specify Branch Field right next to Specify Manager -->
                            <div class="c1-p1 specify-branch" style="display: none; flex: 1;">
                                <label for="specify-branch">Please Specify the Branch</label>
                                <select name="specify_branch" id="specify-branch" class="branch">
                                    <option value="">Select Branch</option>
                                    
                                    <?php $__currentLoopData = $managerProfiles->unique('branch'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($branch->branch); ?>" data-branch="<?php echo e($branch->branch); ?>">
                                            <?php echo e($branch->branch); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <div class="invalid-feedback">Please specify the branch.</div>
                            </div>
                        </div>


                        <!-- Other Fields (Name, Email, Phone, etc.) -->
                        <div class="c1">
                            <div class="c1-p1">
                                <label for="hear">Where did you Hear from Us?</label>
                                <select name="hear_from_us" class="hear" required>
                                    <option value="">Please Select</option>
                                    <option value="Search Engine">Search Engine</option>
                                    <option value="Google Ads">Google Ads</option>
                                    <option value="Facebook Ads">Facebook Ads</option>
                                    <option value="Youtube Ads">Youtube Ads</option>
                                    <option value="TV">TV</option>
                                    <option value="Word of Mouth">Word of Mouth</option>
                                </select>
                                <div class="empty-feedback invalid-feedback" id="error">
                                    Please Choose an Option
                                </div>
                            </div>
                            <div class="c1-p1">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="name" placeholder="Ex. Juan Dela Cruz"
                                    required>
                                <div class="empty-feedback invalid-feedback" id="error">
                                    Please Provide Your Full Name.
                                </div>
                            </div>
                        </div>

                        <div class="c1">
                            <div class="c1-p1">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" class="email" placeholder="your@email.com"
                                    required />
                                <div class="empty-feedback" id="error">
                                    Please provide your email address.
                                </div>
                                <div class="invalid-feedback" id="error">
                                    Please provide a valid email address.
                                </div>
                            </div>
                            <div class="c1-p1">
                                <label for="phone">Phone Number</label>
                                <input type="number" name="phone" class="phone" placeholder="09123456789"
                                    min="1" max="99999999999" oninput="this.value = this.value.slice(0, 11)"
                                    required />
                                <div class="empty-feedback invalid-feedback" id="error">
                                    Please provide your phone number.
                                </div>
                            </div>
                        </div>

                        <div class="c1">
                            <div class="c1-p2">
                                <label for="message">Your Message</label>
                                <textarea rows="5" name="message" class="message" placeholder="Please Leave us a Message" required></textarea>
                                <div class="empty-feedback invalid-feedback" id="error">
                                    Please enter your message.
                                </div>
                            </div>
                        </div>

                        <div class="c1">
                            <div class="c1-p3">
                                <label class="container"> I’ve read, understood, and consented to SDA collecting,
                                    using, and disclosing my personal data as outlined in the Privacy Declaration.
                                    <input type="checkbox" name="consent" required>
                                    <span class="checkmark"></span>
                                    <div class="empty-feedback invalid-feedback" id="error1">
                                        Please Check the Checkbox.
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <button type="submit" class="submit-button">Send</button>
                        </div>

                        <div id="result" class="alert" style="display: none; font-size: 20px; margin-top: 10px;">
                        </div> <!-- Feedback message -->

                    </form>
                </div>
            </div>

            <div class="container2">
                <section class="container2-section1">
                    <h1>SDA Branch Locations</h1>
                    <select id="locate">
                        <option value="">Branch</option>
                        <option value="Cebu">Cebu</option>
                        <option value="Makati">Makati</option>
                        <option value="Bohol">Bohol</option>
                        
                        <option value="Pampanga">Pampanga</option>
                        
                    </select>
                    <p>Please Choose a Branch you want to Locate</p>
                </section>
                <section class="container2-section2">
                    <div class="map">
                        <div id="map-text">Branch Images</div>
                        <div id="cebu" class="branch-location">
                            <div>Cardinal Rosales Ave, Cebu City, 6000 Cebu</div>
                        </div>
                        <div id="makati" class="branch-location">
                            <div>Philam Salcedo Bldg, Leviste Street, 1227 Metro Manila</div>
                        </div>
                        <div id="bohol" class="branch-location">
                            <div>North Road, Tagbilaran City, Bohol</div>
                        </div>
                        <div id="negros" class="branch-location">
                            <div>Silliman Ave, Dumaguete, Negros Oriental</div>
                        </div>
                        <div id="pampanga" class="branch-location">
                            <div>Jose Abad Santos Ave, San Fernando, 2000 Pampanga</div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>
    <br><br><br>
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
                <p>Copyright © 2023, Sto. Domingo Associates Group Limited and it's subsidiries. All rights reserved.
                </p>
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
    <style>

    </style>
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
        window.routes = {
            submit: "<?php echo e(route('submit')); ?>",
            getManagers: "<?php echo e(route('managers')); ?>"
        };
    </script>

    <script src="<?php echo e(asset('js/header-awareness.js')); ?>"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?php echo e(asset('js/join.js')); ?>"></script>

</body>

</html>
<?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/join.blade.php ENDPATH**/ ?>