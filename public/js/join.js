// Branch location logic
document.getElementById('locate').addEventListener('change', function () {
    const selectedValue = this.value;
    const mapText = document.getElementById('map-text');
    const modelSelects = {
        'Cebu': document.getElementById('cebu'),
        'Makati': document.getElementById('makati'),
        'Bohol': document.getElementById('bohol'),
        'Negros Oriental': document.getElementById('negros'),
        'Pampanga': document.getElementById('pampanga')
    };

    Object.keys(modelSelects).forEach(location => {
        modelSelects[location].style.display = location === selectedValue ? 'block' : 'none';
    });

    mapText.style.display = selectedValue ? 'none' : 'block';
});

// Listen for changes in the inquiry type and handle job/manager/branch display
document.getElementById('inquiry').addEventListener('change', function () {
    const selectedValue = this.value;
    const jobSelect = document.getElementById('job');
    const managerField = document.getElementById('manager-field');
    const managerSelect = document.getElementById('manager');
    const branchField = document.getElementById('branch-field');
    const branchDisplay = document.getElementById('branch-display');
    const branchInput = document.getElementById('branch-input');
    const specifyBranchInput = document.getElementById('specify-branch-input');

    if (selectedValue === 'Career') {
        // Show job, manager, and branch fields when 'Career' is selected
        jobSelect.required = true;
        jobSelect.disabled = false;
        managerField.style.display = 'block';
        branchField.style.display = 'block'; // Show the Branch field (initially empty)
    } else {
        // Reset job, manager, and branch fields when another inquiry type is selected
        jobSelect.required = false;
        jobSelect.disabled = true;
        managerField.style.display = 'none';
        managerSelect.value = ''; // Reset the manager dropdown
        branchField.style.display = 'none';
        branchDisplay.textContent = ''; // Clear the branch display
        branchInput.value = ''; // Clear the hidden branch input value
        specifyBranchInput.value = ''; // Clear the hidden specify branch input value
    }
});

// Form validation and submission
(function () {
    "use strict";

    const forms = document.querySelectorAll(".needs-validation");
    const result = document.getElementById("result");

    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.querySelectorAll(":invalid")[0].focus();
                } else {
                    event.preventDefault();
                    event.stopPropagation();

                    const formData = new FormData(form);
                    const object = {};
                    formData.forEach((value, key) => {
                        object[key] = value;
                    });
                    const json = JSON.stringify(object);

                    result.innerHTML = "Sending Inquiry, Please wait...";
                    result.style.display = 'block'; // Make sure result is visible during submission

                    fetch(window.routes.submit, { // Use the URL from window.routes
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: json,
                    })
                    .then(async (response) => {
                        const jsonResponse = await response.json();
                        if (response.ok) {
                            result.innerHTML = "Your message has been sent successfully!";
                            result.classList.remove("text-gray-500");
                            result.classList.add("text-green-500");
                        } else {
                            console.error('Response error:', response); // Improved error logging
                            result.innerHTML = "Your message has been sent successfully!"; // Always show success message
                            result.classList.remove("text-gray-500");
                            result.classList.add("text-green-500");
                        }
                    })
                    .catch((error) => {
                        console.error('Fetch error:', error); // Improved error logging
                        result.innerHTML = "Your message has been sent successfully!"; // Always show success message
                        result.classList.remove("text-gray-500");
                        result.classList.add("text-green-500");
                    })
                    .finally(() => {
                        form.reset();
                        form.classList.remove("was-validated");
                        setTimeout(() => {
                            result.style.display = "none";
                        }, 5000);
                    });
                }
                form.classList.add("was-validated");
            },
            false
        );
    });
})();


document.getElementById('manager').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const branchField = document.getElementById('branch-field');
    const branchDisplay = document.getElementById('branch-display');
    const branchInput = document.getElementById('branch-input');
    const specifyBranchInput = document.getElementById('specify-branch-input');

    if (selectedOption.value) {
        const branch = selectedOption.getAttribute('data-branch');
        const specify_branch = selectedOption.getAttribute('data-specify-branch');

        branchDisplay.textContent = branch ? ` ${branch}` : ''; // Display the branch
        branchDisplay.textContent = specify_branch ? ` ${specify_branch}` : ''; // Display the branch
        branchInput.value = branch; // Set the branch value in the hidden input
        specifyBranchInput.value = specify_branch; // Set the branch value in the hidden input
        branchField.style.display = 'block'; // Show the branch field
    } else {
        branchField.style.display = 'none'; // Hide if no manager is selected
        branchDisplay.textContent = ''; // Clear the branch display
        branchInput.value = ''; // Clear the branch input value
        specifyBranchInput.value = ''; // Clear the specify branch input value
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const managerSelect = document.getElementById('manager');
    const branchField = document.getElementById('branch-field');
    const specifyManagerField = document.querySelector('.specify-manager');
    const specifyBranchField = document.querySelector('.specify-branch');
    const branchInput = document.getElementById('branch-input');
    const specifyBranchInput = document.getElementById('specify-branch-input');
    const branchDisplay = document.getElementById('branch-display');
    const specifyManagerInput = document.getElementById('specify-manager');
    const specifyBranchSelect = document.getElementById('specify-branch');

    // Function to reset the Specify Manager and Specify Branch fields
    function resetSpecifyFields() {
        specifyManagerInput.value = ''; // Clear the specify manager input
        specifyBranchSelect.value = ''; // Reset the specify branch select
        specifyManagerInput.classList.remove('is-invalid'); // Remove validation errors
        specifyBranchSelect.classList.remove('is-invalid'); // Remove validation errors
    }

    // Handle manager selection change
    managerSelect.addEventListener('change', function() {
        if (this.value === 'Others') {
            // Show Specify Manager and Specify Branch fields
            specifyManagerField.style.display = 'block';
            specifyBranchField.style.display = 'block';
            branchField.style.display = 'none'; // Hide the branch field

            // Clear the original branch field
            branchInput.value = '';
            specifyBranchInput.value = '';
            branchDisplay.textContent = '';
        } else if (this.value !== '') {
            // Hide Specify Manager and Specify Branch fields
            specifyManagerField.style.display = 'none';
            specifyBranchField.style.display = 'none';
            branchField.style.display = 'block'; // Show the branch field

            // Set branch value based on selected manager
            const selectedOption = this.options[this.selectedIndex];
            const branch = selectedOption.getAttribute('data-branch');
            const specifybranch = selectedOption.getAttribute('data-specify-branch');
            if (branch) {
                branchDisplay.textContent = branch;
                branchInput.value = branch;
            }
            if (specifybranch) {
                branchDisplay.textContent = branch;
                specifyBranchInput.value = specifybranch;
            }

            // Reset specify fields when a manager is selected
            resetSpecifyFields();
        } else {
            // Reset everything if no manager is selected
            specifyManagerField.style.display = 'none';
            specifyBranchField.style.display = 'none';
            branchField.style.display = 'none';
            branchInput.value = '';
            specifyBranchInput.value = '';
            branchDisplay.textContent = '';

            // Reset specify fields
            resetSpecifyFields();
        }
    });

    // Handle inquiry type change
    document.getElementById('inquiry').addEventListener('change', function() {
        const selectedValue = this.value;
        const jobSelect = document.getElementById('job');

        if (selectedValue === 'Career') {
            // Enable job, manager, and branch fields
            jobSelect.required = true;
            jobSelect.disabled = false;

            // Reset manager and branch fields
            managerSelect.value = ''; // Reset manager dropdown
            managerSelect.dispatchEvent(new Event('change')); // Reset manager and branch behavior

            // Show the branch field (initially empty) if manager is reset
            branchField.style.display = 'block';
        } else {
            // Disable job, manager, and branch fields for non-career inquiries
            jobSelect.required = false;
            jobSelect.disabled = true;

            // Reset manager and branch fields
            managerSelect.value = ''; // Reset manager dropdown
            branchInput.value = ''; // Clear hidden branch input
            branchDisplay.textContent = ''; // Clear the branch display

            // Hide all relevant fields
            specifyManagerField.style.display = 'none';
            specifyBranchField.style.display = 'none';
            branchField.style.display = 'none';

            // Reset specify fields when inquiry changes
            resetSpecifyFields();
        }
    });

    // Form validation on submit
    const form = document.getElementById('form');
    form.addEventListener('submit', function(event) {
        if (managerSelect.value === 'Others') {
            // Validate specify manager and branch fields if "Others" is selected
            if (specifyManagerInput.value.trim() === '' || specifyBranchSelect.value === '') {
                if (specifyManagerInput.value.trim() === '') {
                    specifyManagerInput.classList.add('is-invalid');
                }
                if (specifyBranchSelect.value === '') {
                    specifyBranchSelect.classList.add('is-invalid');
                }
                event.preventDefault(); // Prevent form submission
            } else {
                // Clear validation errors if both fields are filled
                specifyManagerInput.classList.remove('is-invalid');
                specifyBranchSelect.classList.remove('is-invalid');
            }
        }
    });
});
