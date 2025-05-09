// Header scroll behavior
let lastScrollTop = 0;
const header = document.querySelector(".header");

window.addEventListener("scroll", function () {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        header.style.top = "-100%"; // Hide header when scrolling down
    } else {
        header.style.top = "0"; // Show header when scrolling up
    }
    lastScrollTop = scrollTop;
});

// DOM Content Loaded Event
document.addEventListener('DOMContentLoaded', function () {
    const navToggle = document.getElementById('nav-toggle');
    const navList = document.getElementById('nav-list');

    // Scroll event listener for header background
    window.addEventListener('scroll', function () {
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
    document.addEventListener('click', function (event) {
        const isClickInside = navList.contains(event.target) || navToggle.contains(event.target);
        if (!isClickInside && navToggle.checked) {
            navToggle.checked = false; // Close menu if clicked outside
        }
    });

    // Close mobile menu when window is resized to desktop view
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768 && navToggle.checked) {
            navToggle.checked = false; // Close menu on resize
        }
    });
});

// Selectors
const managerContainer = document.querySelectorAll('.manager');
const section2Intro = document.getElementById('section2-intro');
const membersIntro = document.querySelectorAll('.members-intro');

const locationButtons = {
    cebu: document.getElementById('cebu-btn'),
    makati: document.getElementById('makati-btn'),
    bohol: document.getElementById('bohol-btn'),
    other: document.getElementById('other-btn'),
    pampanga: document.getElementById('pampanga-btn'),
};

const locations = {
    cebu: document.getElementById('container-cebu'),
    makati: document.getElementById('container-makati'),
    bohol: document.getElementById('container-bohol'),
    other: document.getElementById('container-other'), // Ensure this matches your HTML
    pampanga: document.getElementById('container-pampanga'),
};

// Titles
const titles = {
    title1: document.querySelectorAll('.container-tittle1'),
    title2: document.querySelectorAll('.container-tittle2'),
};

// Helper function to update UI elements
function updateUI(locationName, branchTitle) {
    // Reset manager container scroll
    managerContainer.scrollTop = 0;

    // Update button states
    Object.values(locationButtons).forEach((btn) => {
        const isActive = btn === locationButtons[locationName];
        btn.style.backgroundColor = isActive ? '#5af1ff' : 'transparent';
        btn.style.fontSize = isActive ? '20px' : '17px';
        btn.style.color = isActive ? 'black' : 'white';
    });

    // Show the selected location and hide others
    Object.values(locations).forEach((location) => {
        location.style.display = location === locations[locationName] ? 'block' : 'none';
    });

    section2Intro.style.display = 'none';

    titles.title1.forEach((div) => {
        div.textContent = branchTitle + ' Branch Managers';
    });
    titles.title2.forEach((div) => {
        div.textContent = 'Employees';
    });

    membersIntro.forEach((div) => {
        div.style.display = 'block';
    });

    // Hide all employee divs initially
    Object.keys(locations).forEach((key) => {
        const divsInsideMembers = document.querySelectorAll(`.members-${key} div`);
        divsInsideMembers.forEach((div) => {
            div.style.display = 'none';
        });
    });
}

// Location button click handlers
Object.keys(locationButtons).forEach((location) => {
    locationButtons[location].onclick = () => updateUI(location, location.charAt(0).toUpperCase() + location.slice(1));
});

// Employee button interactions
const buttons = document.querySelectorAll('.myButton');
let activeEmployeeDiv = null;

buttons.forEach((button) => {
    const originalText = button.innerText;

    // Hover effects
    button.addEventListener('mouseover', () => {
        button.innerText = "See Employee's";
    });

    button.addEventListener('mouseout', () => {
        button.innerText = originalText;
    });

    // Click event to show specific employee divs
    button.addEventListener('click', (event) => {
        const employeeName = event.target.getAttribute('data-employee-name');
        const employeeDiv = document.querySelectorAll(`.${employeeName.replace(/\s+/g, '')}`);

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

            titles.title2.forEach((div) => {
                div.textContent = `${employeeName} Employees`;
            });

            // Update the active employee div
            activeEmployeeDiv = employeeDiv;
        }
    });
});

// Toggle display for founder information
const toggleSection = (button, infoSection) => {
    let state = 1;
    button.addEventListener('click', () => {
        if (state === 1) {
            infoSection.style.transform = 'translateX(-50%)';
            button.textContent = 'Back';
            state = 0;
        } else {
            infoSection.style.transform = 'translateX(0px)';
            button.textContent = 'Read More';
            state = 1;
        }
    });
};

toggleSection(document.getElementById('founder-button'), document.getElementById('founder-info'));
toggleSection(document.getElementById('manager-button'), document.getElementById('manager-info'));
toggleSection(document.getElementById('wife-button'), document.getElementById('wife-info'));

document.addEventListener('DOMContentLoaded', () => {
    const branchButtons = document.querySelectorAll('.branch-btn');
    const section2Intro = document.getElementById('section2-intro');
    const managersList = document.getElementById('managers-list');
    const employeeContainer = document.getElementById('employee-container');

    managersList.style.overflowX = 'auto'; // Enable horizontal scrolling
    managersList.style.whiteSpace = 'nowrap'; // Prevent line breaks in manager cards

    // Event listener for branch buttons
    branchButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const branch = button.getAttribute('data-branch');

            // Fetch branch data from the server
            fetch(`/org/${branch}`)
                .then(response => response.json())
                .then(data => {
                    // Clear existing data
                    managersList.innerHTML = '';

                    // Populate branch managers
                    data.managers.forEach(manager => {
                        const managerDiv = document.createElement('div');
                        managerDiv.className = 'manager-card';

                        // Conditionally display specify_branch for "Other Branches"
                        let specifyBranchHTML = '';
                        if (!['cebu', 'makati', 'bohol', 'pampanga'].includes(manager.branch.toLowerCase()) && manager.specify_branch) {
                            specifyBranchHTML = `<h6>${manager.specify_branch}</h6>`;
                        }

                        managerDiv.innerHTML = `
                        <img src="/storage/${manager.profile_picture}" alt="${manager.name}" class="manager-photo" />
                        ${specifyBranchHTML}
                        <p class="mt-2">
                            <a href="${manager.link}" target="_blank" class="manager-name" style="color: black; text-decoration: underline; transition: color 0.3s;margin-top: 2rem;">
                                ${manager.name}
                            </a>
                        </p>
                        <p style="font-size: 16px; font-weight: bold; margin: 0;">${manager.position}</p>
                        <button class="see-employees-btn" data-manager-id="${manager.id}">See Employees</button>
                    `;

                        // Store education and skills data in the managerDiv for later use
                        managerDiv.setAttribute('data-education', manager.educbackground || '<span style="font-weight: bold;">NO BACKGROUND DATA</span>');
                        managerDiv.setAttribute('data-skills', manager.keyskills || '<span style="font-weight: bold;">NO BACKGROUND DATA</span>');

                        // Add hover effect to the manager photo
                        const managerPhoto = managerDiv.querySelector('.manager-photo');
                        managerPhoto.addEventListener('mouseover', () => {
                            managerPhoto.style.transform = 'scale(1.05)'; // Scale up on hover
                            managerPhoto.style.transition = 'transform 0.3s ease'; // Add transition
                            managerPhoto.style.cursor = 'pointer'; // Change cursor to pointer
                        });

                        managerPhoto.addEventListener('mouseout', () => {
                            managerPhoto.style.transform = 'scale(1)'; // Reset scale
                        });

                        managersList.appendChild(managerDiv);
                    });

                    // Update section intro
                    section2Intro.textContent = `${branch.charAt(0).toUpperCase() + branch.slice(1)} Branch`;
                    employeeContainer.innerHTML = ''; // Clear previous employees
                })
                .catch(error => {
                    console.error('Error fetching branch data:', error);
                });
        });
    });

    // Event listener for manager photos
    document.addEventListener('click', (e) => {
        if (e.target && e.target.classList.contains('manager-photo')) {
            e.preventDefault();

            const modal = document.getElementById("managerModal");
            const modalEducation = document.getElementById("modalManagerEducation");
            const modalSkills = document.getElementById("modalManagerSkills");
            const modalManagerName = document.getElementById("modalManagerName"); // Manager name in modal
            const fadeElements = modal.querySelectorAll('.fade-in');

            // Get the closest manager card to access the data attributes
            const managerCard = e.target.closest('.manager-card');
            const education = managerCard.getAttribute('data-education');
            const skills = managerCard.getAttribute('data-skills');
            const managerName = managerCard.querySelector('.manager-name').textContent;

            // Display data in the modal
            modalManagerName.textContent = managerName;
            modalEducation.innerHTML = education; // Use innerHTML to preserve formatting
            modalSkills.innerHTML = skills; // Use innerHTML to preserve formatting

            // Show the modal
            modal.style.display = "block";
            setTimeout(() => {
                fadeElements.forEach(el => el.classList.add('show'));
            }, 100);

            // Setup modal close behavior
            setupModal(modal);
        }
    });

    // Event listener for "See Employees" buttons
    document.addEventListener('click', (e) => {
        if (e.target && e.target.classList.contains('see-employees-btn')) {
            e.preventDefault();
            const managerId = e.target.getAttribute('data-manager-id');

            // Find the manager name
            const managerName = e.target.closest('.manager-card').querySelector('.manager-name').textContent;

            // Display manager's name in the Employees heading
            document.getElementById('employeeTitleManagerName').textContent = `${managerName}'s Employees`;

            // Clear previous employees from the container
            employeeContainer.innerHTML = '';
            // employeeTitleManagerName.innerHTML = '';

            // Fetch employees for the specific manager
            fetch(`/managers/${managerId}/employees`)
                .then(response => response.json())
                .then(data => {
                    // Populate employees
                    if (data.length === 0) {
                        employeeContainer.innerHTML = '<p>No employees found for this manager.</p>';
                    } else {
                        data.forEach(employee => {
                            const employeeDiv = document.createElement('div');
                            employeeDiv.classList.add('employee-card');
                            employeeDiv.innerHTML = `
                            <img src="/storage/${employee.profile_picture}" alt="${employee.name}" class="photo"
                                data-education="${employee.educationback || 'NO BACKGROUND DATA'}"
                                data-skills="${employee.keyskills || 'NO BACKGROUND DATA'}" />
                            <p>
                                <a href="${employee.link}" target="_blank" class="manager-name" style="font-size: 18px; color: black; text-decoration: underline; transition: color 0.3s;">
                                    ${employee.name}
                                </a>
                            </p>
                            <h4 class="font-semibold position" style="font-size: 16px; font-weight: bold;">${employee.position}</h4>
                        `;
                            employeeContainer.appendChild(employeeDiv);
                        });

                        // Add hover effect for photos
                        const photos = document.querySelectorAll('.photo');
                        photos.forEach(photo => {
                            // Add hover effect using JavaScript
                            photo.addEventListener('mouseover', () => {
                                photo.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
                                photo.style.transform = 'scale(1.05)';
                                photo.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
                                photo.style.cursor = 'pointer'; // Set cursor to pointer
                            });
                            photo.addEventListener('mouseout', () => {
                                photo.style.transform = 'scale(1)';
                                photo.style.boxShadow = 'none';
                            });

                            // Add click event for modal
                            photo.addEventListener('click', function () {
                                const modal = document.getElementById("EmployeeModal");
                                const modalEducation = document.getElementById("modalEmployeeEducation");
                                const modalSkills = document.getElementById("modalEmployeeSkills");
                                const modalEmployeeName = document.getElementById("modalEmployeeName");
                                const fadeElements = modal.querySelectorAll('.fade-in');

                                // Get education and skills data
                                const education = this.getAttribute('data-education');
                                const skills = this.getAttribute('data-skills');
                                const employeeName = this.closest('.employee-card').querySelector('.manager-name').textContent;

                                // Set modal content
                                modalEmployeeName.textContent = employeeName;

                                // Display education and skills in modal
                                modalEducation.innerHTML = education; // Preserve formatting
                                modalSkills.innerHTML = skills; // Preserve formatting

                                // Show the modal
                                modal.style.display = "block";
                                setTimeout(() => {
                                    fadeElements.forEach(el => el.classList.add('show'));
                                }, 100);

                                // Setup modal close behavior for the specific modal
                                setupModal(modal);
                            });
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching employees data:', error);
                });
        }
    });

    // Function to set up modal close behavior
    function setupModal(modal) {
        const closeBtn = modal.getElementsByClassName("close")[0];
        const fadeElements = modal.querySelectorAll('.fade-in');

        if (closeBtn) {
            closeBtn.onclick = function () {
                modal.style.display = "none";
                fadeElements.forEach(el => el.classList.remove('show'));
            };
        }

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
                fadeElements.forEach(el => el.classList.remove('show'));
            }
        };
    }

    // Array of all the buttons
    const branchButtonsArray = Object.values(locationButtons);

    // Function to reset all buttons to default styles
    function resetButtons() {
        branchButtonsArray.forEach(button => {
            button.style.backgroundColor = 'white'; // Set inactive background to plain white
            button.style.color = 'black'; // Set text color to black
        });
    }

    // Add event listeners to each button
    branchButtonsArray.forEach(button => {
        button.addEventListener('click', function () {
            resetButtons(); // Reset all buttons to default before applying new styles
            this.style.backgroundColor = 'red'; // Change background color to red for the clicked button
            this.style.color = 'white'; // Change text color to white for better contrast
        });
    });
});
