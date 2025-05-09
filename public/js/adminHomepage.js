
var intro = document.getElementById('section1-intro');

var div1a = document.getElementById('add-news');
var div2a = document.getElementById('add-events');
var div3a = document.getElementById('add-achievements');

var div1 = document.getElementById('news');
var div2 = document.getElementById('events');
var div3 = document.getElementById('achievements');

var button1a = document.getElementById('button1a');
var button2a = document.getElementById('button2a');
var button3a = document.getElementById('button3a');

var button1 = document.getElementById('button1');
var button2 = document.getElementById('button2');
var button3 = document.getElementById('button3');

var editNews = document.getElementById('edit-news');
var editMember = document.getElementById('edit-member');

const sec1 = document.getElementById('sec1');
const sec2 = document.getElementById('sec2');
const main = document.getElementById('main-intro');

function toggleDisplay(element, show) {
    element.style.display = show ? 'block' : 'none';
}

editNews.onclick = function() {
    toggleDisplay(main, false);
    toggleDisplay(sec1, true);
    editNews.style.color = 'white';
    editNews.style.backgroundColor = 'rgba(255, 88, 88, 0.968)';
    editNews.style.fontSize = '1.2vw';
    editMember.style.color = 'black';
    editMember.style.backgroundColor = 'rgba(88, 236, 255, 0.968)';
    editMember.style.fontSize = '1.1vw';
};

editMember.onclick = function() {
    toggleDisplay(main, false);
    toggleDisplay(sec1, false);
    toggleDisplay(sec2, true);
    editMember.style.color = 'white';
    editMember.style.backgroundColor = 'rgba(255, 88, 88, 0.968)';
    editMember.style.fontSize = '1.2vw';
    editNews.style.color = 'black';
    editNews.style.backgroundColor = 'rgba(88, 236, 255, 0.968)';
    editNews.style.fontSize = '1.1vw';
};
button1.onclick = function() {
    intro.style.display = 'none';
    div1.style.display = 'flex';
    button1.style.backgroundColor = 'transparent';
    button2.style.backgroundColor = '#42d6ca';
    button3.style.backgroundColor = '#42d6ca';
    button1.style.color = 'white';
    button2.style.color = 'black';
    button3.style.color = 'black';
    button1.style.fontSize = '1.5vw';
    button2.style.fontSize = '1.2vw';
    button3.style.fontSize = '1.2vw';
    div2.style.display = 'none';
    div3.style.display = 'none';
    button1a.style.display = 'block';
    button2a.style.display = 'none';
    button3a.style.display = 'none';
    div1a.style.display = 'none';
    div2a.style.display = 'none';
    div3a.style.display = 'none';
};

button2.onclick = function() {
    intro.style.display = 'none';
    div1.style.display = 'none';
    div2.style.display = 'flex';
    button1.style.backgroundColor = '#42d6ca';
    button2.style.backgroundColor = 'transparent';
    button3.style.backgroundColor = '#42d6ca';
    button1.style.color = 'black';
    button2.style.color = 'white';
    button3.style.color = 'black';
    button1.style.fontSize = '1.2vw';
    button2.style.fontSize = '1.5vw';
    button3.style.fontSize = '1.2vw';
    div3.style.display = 'none';
    button1a.style.display = 'none';
    button2a.style.display = 'block';
    button3a.style.display = 'none';
    div1a.style.display = 'none';
    div2a.style.display = 'none';
    div3a.style.display = 'none';

};

button3.onclick = function() {
    intro.style.display = 'none';
    div1.style.display = 'none';
    div2.style.display = 'none';
    div3.style.display = 'flex';
    button1.style.backgroundColor = '#42d6ca';
    button2.style.backgroundColor = '#42d6ca';
    button3.style.backgroundColor = 'transparent';
    button1.style.color = 'black';
    button2.style.color = 'black';
    button3.style.color = 'white';
    button1.style.fontSize = '1.2vw';
    button2.style.fontSize = '1.2vw';
    button3.style.fontSize = '1.3vw';
    button1a.style.display = 'none';
    button2a.style.display = 'none';
    button3a.style.display = 'block';
    div1a.style.display = 'none';
    div2a.style.display = 'none';
    div3a.style.display = 'none';
};

button1a.onclick = function() {
    div1a.style.display = 'block';
    div2a.style.display = 'none';
    div3a.style.display = 'none';
    div1.style.display = 'none';
};

button2a.onclick = function() {
    div1a.style.display = 'none';
    div2a.style.display = 'block';
    div3a.style.display = 'none';
    div2.style.display = 'none';
};

button3a.onclick = function() {
    div1a.style.display = 'none';
    div2a.style.display = 'none';
    div3a.style.display = 'block';
    div3.style.display = 'none';
};

const newsDivContainer = document.querySelector('#news');
const newsCount = document.getElementById('news-num');

const eventDivContainer = document.querySelector('#events');
const eventCount = document.getElementById('events-num');

const achievementsDivContainer = document.querySelector('#achievements');
const achievementsCount = document.getElementById('achievements-num');

window.onload = function() {
    const newsposts = newsDivContainer.querySelectorAll('iframe');
    newsCount.textContent = `${newsposts.length}`;

    const eventsposts = eventDivContainer.querySelectorAll('iframe');
    eventCount.textContent = `${eventsposts.length}`;

    const achievementsposts = achievementsDivContainer.querySelectorAll('iframe');
    achievementsCount.textContent = `${achievementsposts.length}`;

};

/*edit member */
const managerContainer = document.querySelectorAll('.manager');
 
var manager1 = document.querySelectorAll('.manager1');
var manager2 = document.querySelectorAll('.manager2');
var manager3 = document.querySelectorAll('.manager3');
var manager4 = document.querySelectorAll('.manager4');
var manager5 = document.querySelectorAll('.manager5');
var manager6 = document.querySelectorAll('.manager6');

var cebuBtn = document.getElementById('cebu-btn');
var makatiBtn = document.getElementById('makati-btn');
var boholBtn = document.getElementById('bohol-btn');
var negrosBtn = document.getElementById('negros-btn');
var pampangaBtn = document.getElementById('pampanga-btn');
const locButtons = [cebuBtn, makatiBtn, boholBtn, negrosBtn, pampangaBtn];

var cebu = document.getElementById('container-cebu');
var makati = document.getElementById('container-makati');
var bohol = document.getElementById('container-bohol');
var negros = document.getElementById('container-negros');
var pampanga = document.getElementById('container-pampanga');
const locations = [cebu, makati, bohol, negros, pampanga];

const tittle1 = document.querySelectorAll('.container-tittle1');
const tittle2 = document.querySelectorAll('.container-tittle2');

/* 1st buttons */
function handleLocationClick(button, locationName, branchTitle) {
    managerContainer.scrollTop = 0;
    locButtons.forEach((btn) => {
        const isActive = btn === button;
        btn.style.backgroundColor = isActive ? '#5af1ff' : 'transparent';
        btn.style.fontSize = isActive ? '20px' : '17px';
        btn.style.color = isActive ? 'black' : 'white';
    });

    locations.forEach((location) => {
        location.style.display = location === locationName ? 'block' : 'none';
    });

    tittle1.forEach((div) => {
        div.textContent = branchTitle + ' Branch Managers';
    });
    tittle2.forEach((div) => {
        div.textContent = 'Employees';
    });

    const divsInsideMembersCebu = document.querySelectorAll('.members-cebu div');
    const divsInsideMembersMakati = document.querySelectorAll('.members-makati div');
    const divsInsideMembersBohol = document.querySelectorAll('.members-bohol div');
    const divsInsideMembersNegros = document.querySelectorAll('.members-negros div');
    const divsInsideMembersPampanga = document.querySelectorAll('.members-pampanga div');

    const allDivs = [
        ...divsInsideMembersCebu,
        ...divsInsideMembersMakati,
        ...divsInsideMembersBohol,
        ...divsInsideMembersNegros,
        ...divsInsideMembersPampanga,
    ];

    // Change the style display of each div to "block"
    allDivs.forEach((div) => {
        div.style.display = 'none';
    });
    
}

cebuBtn.onclick = () => handleLocationClick(cebuBtn, cebu, 'Cebu');
makatiBtn.onclick = () => handleLocationClick(makatiBtn, makati, 'Makati');
boholBtn.onclick = () => handleLocationClick(boholBtn, bohol, 'Bohol');
negrosBtn.onclick = () => handleLocationClick(negrosBtn, negros, 'Negros Oriental');
pampangaBtn.onclick = () => handleLocationClick(pampangaBtn, pampanga, 'Pampanga');

/* 2nd buttons */

const buttons = document.querySelectorAll('.myButton');
let activeEmployeeDiv = null; // Track the currently active employee div

buttons.forEach((button) => {
    const originalText = button.innerText;

    button.addEventListener('mouseover', () => {
        button.innerText = "See Employee's";
    });

    button.addEventListener('mouseout', () => {
        button.innerText = originalText;
    });

    button.addEventListener('click', (event) => {
        const employeeName = event.target.getAttribute('data-employee-name');
        const employeeDiv = document.querySelectorAll(`.${employeeName.replace(/\s+/g, '')}`);
        const addMemberCebu = document.querySelector('#add-member-cebu'); 
        const addMemberMakati = document.querySelector('#add-member-makati'); 
        const addMemberBohol = document.querySelector('#add-member-bohol'); 
        const addMemberNegros = document.querySelector('#add-member-negros'); 
        const addMemberPampanga = document.querySelector('#add-member-pampanga'); 

        // Hide the previously active employee div
        if (activeEmployeeDiv) {
            activeEmployeeDiv.forEach((div) => {
                div.style.display = 'none';
            });
        }

        // Show the current employee div
        if (employeeDiv) {
            employeeDiv.forEach((div) => {
                div.style.display = 'block';
            });

            addMemberCebu.style.display = 'block';
            addMemberMakati.style.display = 'block';
            addMemberBohol.style.display = 'block';
            addMemberNegros.style.display = 'block';
            addMemberPampanga.style.display = 'block';

            tittle2.forEach((div) => {
                div.textContent = `${employeeName} Employees`;
            });

            // Update the active employee div
            activeEmployeeDiv = employeeDiv;
        }
    });
});


const containerCebu = document.getElementById('cebu-managers');
const containerMakati = document.getElementById('makati-managers');
const containerBohol = document.getElementById('bohol-managers');
const containerNegros = document.getElementById('negros-managers');
const containerPampanga = document.getElementById('pampanga-managers');

const divsInsideContainerCebu = containerCebu.querySelectorAll('div');
const divsInsideContainerMakati = containerMakati.querySelectorAll('div');
const divsInsideContainerBohol = containerBohol.querySelectorAll('div');
const divsInsideContainerNegros = containerNegros.querySelectorAll('div');
const divsInsideContainerPampanga = containerPampanga.querySelectorAll('div');

const formManagerCebu = document.querySelector('.form-manager-cebu'); 
const formManagerMakati = document.querySelector('.form-manager-makati'); 
const formManagerBohol = document.querySelector('.form-manager-bohol'); 
const formManagerNegros = document.querySelector('.form-manager-negros'); 
const formManagerPampanga = document.querySelector('.form-manager-pampanga'); 

const addManagerCebu = document.querySelector('#add-manager-cebu'); 
const addManagerMakati = document.querySelector('#add-manager-makati'); 
const addManagerBohol = document.querySelector('#add-manager-bohol'); 
const addManagerNegros = document.querySelector('#add-manager-negros'); 
const addManagerPampanga = document.querySelector('#add-manager-pampanga'); 

addManagerCebu.onclick = function() {
    divsInsideContainerCebu.forEach((div) => {
        div.style.display = 'none';
    });
    formManagerCebu.style.display = 'block';
    addManagerCebu.style.display = 'none';
};

addManagerMakati.onclick = function() {
    divsInsideContainerMakati.forEach((div) => {
        div.style.display = 'none';
    });
    formManagerMakati.style.display = 'block';
    addManagerMakati.style.display = 'none';
};

addManagerBohol.onclick = function() {
    divsInsideContainerBohol.forEach((div) => {
        div.style.display = 'none';
    });
    formManagerBohol.style.display = 'block';
    addManagerBohol.style.display = 'none';
};

addManagerNegros.onclick = function() {
    divsInsideContainerNegros.forEach((div) => {
        div.style.display = 'none';
    });
    formManagerNegros.style.display = 'block';
    addManagerNegros.style.display = 'none';
};

addManagerPampanga.onclick = function() {
    divsInsideContainerPampanga.forEach((div) => {
        div.style.display = 'none';
    });
    formManagerPampanga.style.display = 'block';
    addManagerPampanga.style.display = 'none';
};

const formMemberCebu = document.querySelector('.form-member-cebu'); 
const formMemberMakati = document.querySelector('.form-member-makati'); 
const formMemberBohol = document.querySelector('.form-member-bohol'); 
const formMemberNegros = document.querySelector('.form-member-negros'); 
const formMemberPampanga = document.querySelector('.form-member-pampanga'); 

const addMemberCebu = document.querySelector('#add-member-cebu'); 
const addMemberMakati = document.querySelector('#add-member-makati'); 
const addMemberBohol = document.querySelector('#add-member-bohol'); 
const addMemberNegros = document.querySelector('#add-member-negros'); 
const addMemberPampanga = document.querySelector('#add-member-pampanga'); 

addMemberCebu.onclick = function() {

    formMemberCebu.style.display = 'block';
    addMemberCebu.style.display = 'none';
};

addMemberMakati.onclick = function() {

    formMemberMakati.style.display = 'block';
    addMemberMakati.style.display = 'none';
};

addMemberBohol.onclick = function() {

    formMemberBohol.style.display = 'block';
    addMemberBohol.style.display = 'none';
};

addMemberNegros.onclick = function() {

    formMemberNegros.style.display = 'block';
    addMemberNegros.style.display = 'none';
};

addMemberPampanga.onclick = function() {

    formMemberPampanga.style.display = 'block';
    addMemberPampanga.style.display = 'none';
};
