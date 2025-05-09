

function toggleImageAndFontSize(image, button) {
    if (image.style.visibility !== 'visible' && button.style.fontSize !== '1.7vw') {
        image.style.visibility = 'visible';
        button.style.fontSize = '1.7vw';
    } else {
        image.style.visibility = 'hidden';
        button.style.fontSize = '1.5vw';
    }
}
//upper part timeline

var uBtn1 = document.getElementById('u-btn1');
var uBtn2 = document.getElementById('u-btn2');
var uBtn3 = document.getElementById('u-btn3');
var uBtn4 = document.getElementById('u-btn4');

var Uimage1 = document.getElementById('u-image1');
var Uimage2 = document.getElementById('u-image2');
var Uimage3 = document.getElementById('u-image3');
var Uimage4 = document.getElementById('u-image4');

var Utxt1 = document.getElementById('u-txt1');
var Utxt2 = document.getElementById('u-txt2');
var Utxt3 = document.getElementById('u-txt3');

uBtn1.onclick = function() {
    toggleImageAndFontSize(Uimage1, uBtn1);
};

uBtn2.onclick = function() {
    toggleImageAndFontSize(Uimage2, uBtn2);
};

uBtn3.onclick = function() {
    toggleImageAndFontSize(Uimage3, uBtn3);
};

uBtn4.onclick = function() {
    toggleImageAndFontSize(Uimage4, uBtn4);
};
//lower part timeline

var lBtn1 = document.getElementById('l-btn1');
var lBtn2 = document.getElementById('l-btn2');
var lBtn3 = document.getElementById('l-btn3');

var Limage1 = document.getElementById('l-image1');
var Limage2 = document.getElementById('l-image2');
var Limage3 = document.getElementById('l-image3');

var Ltxt1 = document.getElementById('l-txt1');
var Ltxt2 = document.getElementById('l-txt2');
var Ltxt3 = document.getElementById('l-txt3');

lBtn1.onclick = function() {
    toggleImageAndFontSize(Limage1, lBtn1);
};

lBtn2.onclick = function() {
    toggleImageAndFontSize(Limage2, lBtn2);
};

lBtn3.onclick = function() {
    toggleImageAndFontSize(Limage3, lBtn3);
};


