<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sto. Domingo Associates | News</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
    <link rel="icon" href="{{ asset('css/images/SDALOGO.png') }}" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
</head>

<style>
    .news-list {
        display: grid;
        justify-items: center;
        /* Center items horizontally */
        align-items: center;
        /* Center items vertically */
        gap: 20px;
        width: 100%;
    }

    .news-list.two-items {
        grid-template-columns: repeat(2, 1fr);
        /* Two columns layout */
        gap: 40px;
        /* Increase gap between columns for better spacing */
    }

    .news-list.one-item {
        grid-template-columns: 1fr;
        /* Single column layout */
    }

    .embed-code {
        width: 100%;
        /* Full width of the grid cell */
        box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media (max-width: 768px) {
        .news-list {
            grid-template-columns: 1fr;
            /* One column layout on small screens */
        }

        .embed-code {
            width: 100%;
            /* Take up the full width on smaller screens */
        }
    }

    .umpad {
        color: rgb(88, 0, 0);
        text-decoration: underline rgb(0, 0, 0)
    }

    .umpad:hover {
        color: #ff4949;
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
                            class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('display-news') }}"
                            class="nav-link {{ Route::currentRouteName() == 'display-news' ? 'active' : '' }}">News &
                            Media</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('organization') }}"
                            class="nav-link {{ Route::currentRouteName() == 'organization' ? 'active' : '' }}">Organization</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}"
                            class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('join') }}"
                            class="nav-link {{ Route::currentRouteName() == 'join' ? 'active' : '' }}">Join Now</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>


    <main class="main">
        <section class="ssection1">
            <nav>
                <div class="nav-title" style="font-size: 30px; font-weight: bold; color: rgb(0, 0, 0);">News & Media
                </div>
                <ul>
                    <li>
                        <a href="{{ route('display-news') }}?category=news"
                            class="{{ $category == 'news' ? 'active' : '' }}" id="button1">
                            News
                            <i class="ri-newspaper-line"></i>
                            <span class="label" id="news-num">{{ count($news) }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('display-news') }}?category=events"
                            class="{{ $category == 'events' ? 'active' : '' }}" id="button2">
                            Events
                            <i class="ri-calendar-event-line"></i>
                            <span class="label" id="events-num">{{ count($events) }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('display-news') }}?category=triumphs"
                            class="{{ $category == 'triumphs' ? 'active' : '' }}" id="button3">
                            Triumphs
                            <i class="ri-medal-line"></i>
                            <span class="label" id="achievements-num">{{ count($triumphs) }}</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div id="content" class="news-list">
                @if ($category == 'news')
                    @foreach ($news as $item)
                        <div class="embed-code">
                            {!! $item->embed_code !!}
                        </div>
                    @endforeach
                @elseif ($category == 'events')
                    @foreach ($events as $item)
                        <div class="embed-code">
                            {!! $item->embed_code !!}
                        </div>
                    @endforeach
                @elseif ($category == 'triumphs')
                    @foreach ($triumphs as $item)
                        <div class="embed-code">
                            {!! $item->embed_code !!}
                        </div>
                    @endforeach
                @else
                    <p class="no-items">Please select a category to view content.</p>
                @endif
            </div>

        </section>

        <section class="section2">
            <nav>
                <span id="nav-title">STO.DOMINGO'S APPRECIATION VIDEO</span>
            </nav>

            <div class="video-container">
                <video width="100%" height="100%" controls autoplay loop muted>
                    <source src="{{ asset('css/video/SdaVideo.mp4') }}" type="video/mp4">
                </video>
            </div>
        </section>
    </main>

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
                    <a href="{{ route('terms&condition') }}" class="terms">Terms and Conditions</a>
                    <a href="{{ route('2023') }}" class="umpad">John Mark Umpad</a>
                    <a href="{{ route('2024') }}" class="csucc-student-web-dev">Caraga State University - Cabadbaran
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
                    <img src="{{ asset('css/images/fb1.png') }}" alt="Facebook" class="facebook-icon">
                    <span class="tooltip">Facebook</span>
                </a>
                <a href="https://www.linkedin.com/company/stodomingoassociates/about/?fbclid=IwAR0_03-7ES3Ls_e30WHtbHiF0WxDl6OZiF2ccjDp8aGviNTh3jNPxkgIxCY"
                    target="_blank" class="icon linkedin">
                    <img src="{{ asset('css/images/linked1.png') }}" alt="LinkedIn" class="linkedin-icon">
                    <span class="tooltip">LinkedIn</span>
                </a>
            </div>
        </div>
    </footer>
    <style>
        .footer {
            background-color: #333;
            color: #fff;
            padding: 2rem 0;
            font-family: Arial, sans-serif;
        }

        .nav-link.active {
            color: var(--primary-color);
        }

        .nav-item.active::after {
            width: 100%;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .footer-section {
            flex: 1;
            min-width: 200px;
            margin-bottom: 1rem;
            margin-left: 1rem;
        }

        .footer-logo img {
            max-width: 150px;
            height: auto;
        }

        .footer-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            position: relative;
            cursor: pointer;
        }

        .footer-title::after {
            content: '+';
            position: absolute;
            right: 0;
            top: 0;
            display: none;
        }

        .footer-content {
            display: block;
            transition: max-height 0.3s ease-out;
            overflow: hidden;
            max-height: 1000px;
        }

        .footer-content a,
        .footer-content p {
            display: block;
            margin-bottom: 0.5rem;
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-content a:hover {
            color: #fff;
        }

        .footer-bottom {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #555;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .copyright {
            font-size: 0.9rem;
            color: #ccc;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-right: 1rem;
        }

        .icon {
            position: relative;
            display: inline-block;
        }

        .icon img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s ease;
        }

        .icon:hover img {
            transform: scale(1.1);
        }

        .tooltip {
            visibility: hidden;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .icon:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .footer-section {
                flex-basis: 100%;
                font-size: 2vw;
            }

            .address {
                font-size: 2vw;
            }

            .footer-title::after {
                display: block;
            }

            .footer-title.active::after {
                content: '-';
            }

            .footer-content {
                max-height: 0;
            }

            .footer-content.active {
                max-height: 1000px;
            }

            .footer-bottom {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .copyright {
                margin-bottom: 1rem;
            }
        }
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
    <script src="{{ asset('js/header-awareness.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const newsList = document.querySelector('.news-list');
            const embeds = document.querySelectorAll('.news-list .embed-code');

            if (embeds.length === 1) {
                newsList.classList.add('one-item');
                newsList.classList.remove('two-items');
            } else if (embeds.length === 2) {
                newsList.classList.add('two-items');
                newsList.classList.remove('one-item');
            } else {
                // Remove any specific layout class if there are neither 1 nor 2 items
                newsList.classList.remove('one-item', 'two-items');
            }
        });
    </script>
</body>

</html>
