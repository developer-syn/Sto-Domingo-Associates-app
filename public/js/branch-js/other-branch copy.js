document.addEventListener('DOMContentLoaded', function () {
    // Function to handle showing modals
    function showModal(modal) {
        modal.classList.remove('hidden');
    }

    // Function to handle hiding modals
    function hideModal(modal) {
        modal.classList.add('hidden');
    }

    // Function to handle modal click events for closing
    function setupModalClickOutside(modal, closeBtn) {
        closeBtn.addEventListener('click', () => hideModal(modal));
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                hideModal(modal);
            }
        });
    }

    // --------------------------
    // Branch Manager Modal Logic
    // --------------------------
    const openBranchManagerModalBtn = document.getElementById('openBranchManagerModal');
    const closeBranchManagerModalBtn = document.getElementById('closeBranchManagerModal');
    const branchManagerModal = document.getElementById('branchManagerModal');

    if (openBranchManagerModalBtn && closeBranchManagerModalBtn && branchManagerModal) {
        openBranchManagerModalBtn.addEventListener('click', () => showModal(branchManagerModal));
        setupModalClickOutside(branchManagerModal, closeBranchManagerModalBtn);
    }

    // --------------------------
    // Employee Modal Logic
    // --------------------------
    const openEmployeeModalBtn = document.getElementById('openEmployeeModal');
    const closeEmployeeModalBtn = document.getElementById('closeEmployeeModal');
    const employeeModal = document.getElementById('employeeModal');

    if (openEmployeeModalBtn && closeEmployeeModalBtn && employeeModal) {
        openEmployeeModalBtn.addEventListener('click', () => showModal(employeeModal));
        setupModalClickOutside(employeeModal, closeEmployeeModalBtn);
    }

    // --------------------------
    // Branch Manager Edit Modal Logic
    // --------------------------
    const editBranchManagerModal = document.getElementById('editBranchManagerModal');
    const closeEditBranchManagerModalBtn = document.getElementById('closeEditBranchManagerModal');
    const editManagerForm = document.getElementById('editManagerForm');

    if (editBranchManagerModal && closeEditBranchManagerModalBtn && editManagerForm) {
        document.querySelectorAll('.editManagerBtn').forEach(button => {
            button.addEventListener('click', function () {
                const managerId = this.dataset.managerId;
                const managerBranch = this.dataset.managerBranch;
                const managerSpecifyBranch = this.dataset.managerSpecifyBranch;
                const managerName = this.dataset.managerName;
                const managerPosition = this.dataset.managerPosition;
                const managerLink = this.dataset.managerLink;

                console.log('Specify Branch:', managerSpecifyBranch); // Log for debugging

                // Set the form action and pre-fill the data
                editManagerForm.action = `/members/updateManagerProfile/${managerId}`;

                document.getElementById('edit_manager_branch').value = managerBranch || '';
                document.getElementById('edit_manager_specify_branch').value = managerSpecifyBranch || '';
                document.getElementById('edit_manager_name').value = managerName || '';
                document.getElementById('edit_manager_position').value = managerPosition || '';
                document.getElementById('edit_manager_link').value = managerLink || '';

                showModal(editBranchManagerModal);
            });
        });

        setupModalClickOutside(editBranchManagerModal, closeEditBranchManagerModalBtn);
    }

    function showModal(modal) {
        modal.classList.remove('hidden');
    }

    function setupModalClickOutside(modal, closeButton) {
        // Close the modal when clicking outside of it
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Close the modal when clicking the close button
        closeButton.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
    }
    // --------------------------
    // Employee Edit Modal Logic
    // --------------------------
    const editEmployeeModal = document.getElementById('editEmployeeModal');
    const closeEditEmployeeModalBtn = document.getElementById('closeEditEmployeeModal');
    const editEmployeeForm = document.getElementById('editEmployeeForm');

    if (editEmployeeModal && closeEditEmployeeModalBtn && editEmployeeForm) {
        document.body.addEventListener('click', function (event) {
            const editButton = event.target.closest('.editEmployeeBtn');
            if (editButton) {
                const employeeId = editButton.getAttribute('data-employee-id');
                const employeeName = editButton.getAttribute('data-employee-name');
                const employeePosition = editButton.getAttribute('data-employee-position');
                const employeeLink = editButton.getAttribute('data-employee-link');

                // Set the form action and pre-fill the data
                editEmployeeForm.action = `/members/updateEmployeeProfile/${employeeId}`;
                document.getElementById('edit_name').value = employeeName;
                document.getElementById('edit_position').value = employeePosition;
                document.getElementById('edit_link').value = employeeLink;

                showModal(editEmployeeModal);
            }
        });

        setupModalClickOutside(editEmployeeModal, closeEditEmployeeModalBtn);
    }
});

// --------------------------
// Function to Show Employees
// --------------------------
function showEmployees(managerId) {
    // Hide all employee sections first
    const allEmployeeContainers = document.querySelectorAll('[id^="employees-"]');
    allEmployeeContainers.forEach(container => {
        container.classList.add('hidden');
    });

    // Fetch the employees for the selected manager
    fetch(`/managers/${managerId}/employees`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const employeeContainer = document.getElementById(`employees-${managerId}`);
            let employeeHTML = '';

            if (data.length === 0) {
                employeeHTML = '<p>No employees found for this manager.</p>';
            } else {
                data.forEach(employee => {
                    employeeHTML += `
                        <div class="bg-white-100 p-4 rounded-lg mb-4 mr-4" style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 300px;">
                            <div class="text-center mb-2">
                                <h4 class="font-semibold underline">${employee.name}</h4>
                                <h4 class="font-semibold">${employee.position}</h4>
                            </div>
                            ${employee.profile_picture
                                            ? `<img src="/storage/${employee.profile_picture}" alt="${employee.name}" class="rounded-md mb-2 mx-auto" style="width: 250px; height: 240px; object-fit: cover;">`
                                            : '<p class="text-center">No image</p>'
                                        }
                            <div class="flex justify-center mt-2 space-x-2">
                                <!-- Edit Button -->
                                <button type="button"
                                    class="btn btn-primary editEmployeeBtn"
                                    data-employee-id="${employee.id}"
                                    data-employee-name="${employee.name}"
                                    data-employee-position="${employee.position}"
                                    data-employee-link="${employee.link}"
                                    style="background-color: rgb(33, 150, 243); color: white; border-radius: 5px; padding: 6px 12px; border: none;">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                &nbsp; &nbsp;
                                <!-- Delete Button -->
                                <form action="/employees/${employee.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn-delete"
                                        style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 6px 12px; border: none;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    `;
                });
            }

            // Set the new content and display the employees
            employeeContainer.innerHTML = employeeHTML;
            employeeContainer.classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error fetching employees:', error);
            alert('There was an error fetching the employees. Please try again later.');
        });
}


document.getElementById('manager_profile_id').addEventListener('change', function () {
    // Get the selected option
    var selectedOption = this.options[this.selectedIndex];

    // Get the branch data from the data-branch attribute
    var branch = selectedOption.getAttribute('data-branch');

    // Set the value of the branch field
    document.getElementById('manager_profile_branch').value = branch;
});
