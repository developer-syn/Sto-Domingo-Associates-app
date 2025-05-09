const slideContainer = document.querySelector('.container');
const slide = document.querySelector('.slides');
const nextBtn = document.getElementById('next-btn');
const prevBtn = document.getElementById('prev-btn');
const interval = 4000;

let slides = document.querySelectorAll('.slide')
let index = 1;
let slideId;

const firstClone = slides[0].cloneNode(true);
const lastClone = slides[slides.length - 1].cloneNode(true);

firstClone.id = 'first-clone';
lastClone.id = 'last-clone';

slide.append(firstClone);
slide.prepend(lastClone);

const slideWidth = slides[index].clientWidth;
const containerWidth = 55;
console.log(containerWidth);

slide.style.transform = `translateX(${-containerWidth * index}vw)`;

const startSlide = ()=>{
    slideId = setInterval( () => {
        moveToNextSlide();
    }, interval);
}

const getSlides = ()=> document.querySelectorAll('.slide');


slide.addEventListener('transitionend', () =>{
    slides = getSlides();
    if (slides[index].id === firstClone.id) {
        slide.style.transition = 'none';
        index = 1;
        slide.style.transform = `translateX(${-containerWidth * index}vw)`;
    }

    if (slides[index].id === lastClone.id) {
        slide.style.transition = 'none';
        index = slides.length - 2;
        slide.style.transform = `translateX(${-containerWidth * index}vw)`;
    }

});

const moveToNextSlide = ()=>{
    slides = getSlides();
    if (index >= slides.length - 1) return;
    index++;
    slide.style.transform = `translateX(${-containerWidth * index}vw)`;
    slide.style.transition = '0.7s';
};

const moveToPreviousSlide = ()=>{
    if (index <= 0) return;
    index--;
    slide.style.transform = `translateX(${-containerWidth * index}vw)`;
    slide.style.transition = '0.7s';
};

slideContainer.addEventListener('mouseenter', () =>{
    clearInterval(slideId);
});

slideContainer.addEventListener('mouseleave', startSlide);

nextBtn.addEventListener('click', moveToNextSlide)
prevBtn.addEventListener('click', moveToPreviousSlide)

startSlide();
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
