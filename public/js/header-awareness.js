// Header scroll behavior
let lastScrollTop = 0;
const header = document.querySelector(".header");

window.addEventListener("scroll", function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        header.style.top = "-100%";
    } else {
        header.style.top = "0";
    }
    lastScrollTop = scrollTop;
});

document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.header');
    const navToggle = document.getElementById('nav-toggle');
    const navList = document.getElementById('nav-list');

    // Scroll event listener
    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            header.style.backgroundColor = '#ffffff';
            header.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
        } else {
            header.style.backgroundColor = '#ffffff'; // Keep the background white
            header.style.boxShadow = 'none';
            header.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
        }
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        const isClickInside = navList.contains(event.target) || navToggle.contains(event.target);
        if (!isClickInside && navToggle.checked) {
            navToggle.checked = false;
        }
    });

    // Close mobile menu when window is resized to desktop view
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navToggle.checked) {
            navToggle.checked = false;
        }
    });
});
