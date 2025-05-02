const heroBg1 = document.getElementById('hero-bg-1');
const heroBg2 = document.getElementById('hero-bg-2');
const menu = document.getElementById('menu');
const burger = document.getElementById('burger');
const close = document.getElementById('close');

const carouselBtn1 = document.getElementById('carousel-buttons-1');
const carouselBtn2 = document.getElementById('carousel-buttons-2');
let slide = true;

burger.addEventListener('click', () => {
    menu.style.display = "block";
});

close.addEventListener('click', () => {
    menu.style.display = "none";
});

function slideCarousel1 ()
{
    heroBg2.style.transform = 'translateX(100%)';
    heroBg1.style.transform = 'translateX(100%)';
    carouselBtn1.classList.add('carousel-button-active');
    carouselBtn2.classList.remove('carousel-button-active');
    slide = false;
}

function slideCarousel2 ()
{
    heroBg2.style.transform = 'translateX(0%)';
    heroBg1.style.transform = 'translateX(-100%)';
    carouselBtn2.classList.add('carousel-button-active');
    carouselBtn1.classList.remove('carousel-button-active');
    slide = true;
}

carouselBtn1.addEventListener('click', () => {
    slideCarousel1();
});

carouselBtn2.addEventListener('click', () => {
    slideCarousel2();
});

function automaticSlide () {
    slide ? slideCarousel1():slideCarousel2();
}

setInterval(
    automaticSlide,
    5000
);
