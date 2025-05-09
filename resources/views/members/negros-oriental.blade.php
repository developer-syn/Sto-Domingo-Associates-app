@extends('admin.members')

@section('title', 'Members')

@section('content')

    <h1
        style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
        Negros Oriental Branch Managers
    </h1>

    <!-- Branch Manager Modal Trigger -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 460px;">
            <div class="flex items-center justify-between">
                <button id="openBranchManagerModal" class="text-blue-500 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-plus fa-xl"></i>
                </button>
            </div>

            <!-- Display uploaded manager profile pictures -->
            <div class="flex flex-wrap -mx-6" style="max-height: 850px; overflow-y: auto;">
                @foreach ($managerProfiles as $manager)
                    <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 flex items-center justify-center" style="height: 360px;">
                        <div class="bg-white p-4 border-black-1 rounded-lg shadow-md text-center"
                            style="padding: .2rem; background-color: rgb(255, 255, 255); box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 350px; height: 370px; object-fit: cover; margin-top: 1rem;">
                            <a href="{{ $manager->link }}" target="_blank" class="manager-name" style="color: black; text-decoration: underline; transition: color 3s blue;margin-top: 1rem;">
                                <h3 class="text-lg font-semibold mt-2 underline">{{ $manager->name }}</h3>
                            </a>

                            <h4 class="text-md font-medium text-gray-600 mt-0.1">{{ $manager->position }}</h4>
                            <!-- Adjusted margin -->
                            @if ($manager->profile_picture)
                                <img src="{{ asset('storage/' . $manager->profile_picture) }}" alt="{{ $manager->name }}"
                                    class="object-cover rounded-md mb-2 mx-auto" style="width: 250px; height: 250px;">
                            @else
                                <p>No image</p>
                            @endif

                            <div class="flex justify-center mt-2">
                                <button
                                    class="editManagerBtn text-green-500 hover:text-green-700 mx-2 transition-colors duration-300 ease-in-out"
                                    style="background-color: rgb(33, 150, 243); color: white; border-radius: 5px; padding: 4px 8px; border: none;"
                                    data-manager-id="{{ $manager->id }}" data-manager-name="{{ $manager->name }}"
                                    data-manager-position="{{ $manager->position }}"
                                    data-manager-link="{{ $manager->link }}"
                                    data-manager-picture="{{ $manager->profile_picture }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                &nbsp;
                                <form action="{{ route('members.deleteManagerProfile', ['id' => $manager->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this manager?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                        style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 4px 8px; border: none;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                &nbsp;
                                <!-- "See Employees" Button -->
                                <button onclick="showEmployees({{ $manager->id }})"
                                    class="text-blue-500 hover:text-blue-600 mx-2 transition-colors duration-300 ease-in-out"
                                    data-manager-id="{{ $manager->id }}" data-target="#employeeModal-{{ $manager->id }}"
                                    style="background-color: rgb(33, 150, 243); color: white; border-radius: 5px; padding: 4px 8px; border: none;"
                                    data-toggle="modal">
                                    <i class="fas fa-users"></i> See Employees
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- Employee Modal for this Manager -->
                    <div id="employeeModal-{{ $manager->id }}"
                        class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white p-4 rounded-lg shadow-md" style="width: 80%; max-width: 800px;">
                            <button class="close-modal text-gray-500 hover:text-gray-700 absolute top-2 right-2"
                                data-modal-id="employeeModal-{{ $manager->id }}">&times;</button>
                            <h2 class="text-xl font-bold mb-4 text-center">Employees of {{ $manager->name }}</h2>

                            <div class="flex flex-wrap -mx-6 overflow-y-auto">
                                @foreach ($employeeProfiles->where('manager_id', $manager->id) as $employee)
                                    <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 flex items-center justify-center"
                                        style="height: 260px;">
                                        <div class="bg-white p-4 border-black-1 rounded-lg shadow-md text-center"
                                            style="padding: .2rem; background-color: rgb(255, 255, 255); box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 250px; height: 250px; object-fit: cover;">
                                            <h3 class="text-lg font-semibold mt-2">{{ $employee->name }}</h3>
                                            @if ($employee->profile_picture)
                                                <img src="{{ asset('storage/' . $employee->profile_picture) }}"
                                                    alt="{{ $employee->name }}"
                                                    class="object-cover rounded-md mb-2 mx-auto"
                                                    style="width: 150px; height: 150px;">
                                            @else
                                                <p>No image</p>
                                            @endif

                                            <div class="flex justify-center mt-2">
                                                <form
                                                    action="{{ route('members.deleteEmployeeProfile', ['id' => $employee->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                                        style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 8px 16px; border: none;">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Add New Branch Manager Modal -->
        <div id="branchManagerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-md" style="width: 350px;">
                <button id="closeBranchManagerModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <h3 class="text-lg font-semibold mb-4" style="text-align:center;">Add New Branch Manager</h3>
                <form action="{{ route('members.storeManagerProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="url" id="link" name="link" placeholder="https://example.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile
                            Picture</label>
                        <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                    </div>

                    <input type="hidden" name="branch" value="negros-oriental">
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: rgb(233, 25, 35)">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Branch Manager Modal -->
        <div id="editBranchManagerModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-md" style="width: 350px;">
                <button id="closeEditBranchManagerModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <h3 class="text-lg font-semibold mb-4" style="text-align:center;">Edit Branch Manager</h3>
                <form id="editManagerForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_manager_name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="edit_manager_name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_manager_position"
                            class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="edit_manager_position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_manager_link" class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="url" id="edit_manager_link" name="link" placeholder="https://example.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="edit_profile_picture" class="block text-sm font-medium text-gray-700">Profile
                            Picture</label>
                        <input type="file" id="edit_profile_picture" name="profile_picture" class="form-control">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: rgb(233, 25, 35)">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <br>

        <h1
            style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
            Employees
        </h1>

        <!-- Employee Modal Trigger -->
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">
            <div class="flex items-center justify-between mb-4">
                <button id="openEmployeeModal" class="text-blue-500 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-plus fa-xl"></i>
                </button>
            </div>

            <div class="flex flex-wrap -mx-6 overflow-y-auto">
                @foreach ($managerProfiles as $manager)
                    <div  style="margin-right: 10px;">
                        <!-- Placeholder for showing employees under this manager -->
                        <div id="employees-{{ $manager->id }}" class="m-4 hidden flex flex-wrap gap-6"
                            style="width: 100%;">
                            <!-- The employee data will be loaded here via JavaScript or server-side -->
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <br>
        <h1
            style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
            New Recruits
        </h1>

        <!-- Employee Modal Trigger -->
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">

            @if ($managerProfiles->isEmpty())
                <p>No manager profiles found.</p>
            @else
            @endif

            @if ($acceptedRecruits->isEmpty())
                <p>No accepted recruits found.</p>
            @else
                <div style="overflow-x: auto;">
                    <table id="contact_us" class="table table-striped table-bordered"
                        style="width:100%;-webkit-scrollbar: 0.8pv; text-align:center;">
                        <thead>
                            <tr>
                                {{-- <th>Manager Name</th> --}}
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Type of Job</th>
                                <th>Type of Inquiry</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($acceptedRecruits as $recruit)
                                <tr>
                                    {{-- <td>{{ $recruit->manager_name }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $recruit->name }}</td>
                                    <td>{{ $recruit->email }}</td>
                                    <td>{{ $recruit->phone }}</td>
                                    <td>{{ $recruit->job_type }}</td>
                                    <td>{{ $recruit->inquiry_type }}</td>
                                    <td>
                                        <form action="{{ route('members.destroyNewRecruit', ['id' => $recruit->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this recruit?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                                style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 8px 16px; border: none;">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Employee Modal -->
        <div id="employeeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white p-4 rounded-lg shadow-md" style="width: 350px;">
                <button id="closeEmployeeModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <h3 class="text-lg font-semibold mb-4">Add New Employee</h3>
                <form action="{{ route('members.storeEmployeeProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="manager" class="block text-sm font-medium text-gray-700">Select Manager</label>
                        <select id="manager_profile_id" name="manager_profile_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="">Select a Manager</option>
                            @foreach ($managerProfiles as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="url" id="link" name="link" placeholder="https://example.com"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile
                            Picture</label>
                        <input type="file" id="profile_picture_employee" name="profile_picture_employee"
                            class="form-control">
                    </div>

                    <input type="hidden" name="branch" value="negros-oriental">
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: rgb(233, 25, 35)">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Edit Employee Modal -->
        <div id="editEmployeeModal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white p-6 rounded-lg shadow-md relative" style="width: 350px;">
                <button id="closeEditEmployeeModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                <h3 class="text-xl font-semibold mb-4" style="text-align:center;">Edit Employee</h3>
                <form id="editEmployeeForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="edit_name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="edit_position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="edit_link" class="block text-sm font-medium text-gray-700">Link</label>
                        <input type="url" id="edit_link" name="link"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="edit_profile_picture" class="block text-sm font-medium text-gray-700">Profile
                            Picture</label>
                        <input type="file" id="edit_profile_picture" name="profile_picture_employee"
                            class="mt-1 block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            style="background-color: rgb(233, 25, 35)">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>




        <!-- Include Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <!-- JavaScript for Modal Behavior -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
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
                        button.addEventListener('click', function() {
                            const managerId = this.dataset.managerId;
                            const managerName = this.dataset.managerName;
                            const managerPosition = this.dataset.managerPosition;
                            const managerLink = this.dataset.managerLink;

                            // Set the form action and pre-fill the data
                            editManagerForm.action = `/members/updateManagerProfile/${managerId}`;
                            document.getElementById('edit_manager_name').value = managerName || '';
                            document.getElementById('edit_manager_position').value = managerPosition ||
                                '';
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
                    modal.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            modal.classList.add('hidden');
                        }
                    });

                    // Close the modal when clicking the close button
                    closeButton.addEventListener('click', function() {
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
                    document.body.addEventListener('click', function(event) {
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
                                <div class="bg-gray-100 p-4 rounded-lg mb-4 mr-4" style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 300px;">
                                    <div class="text-center mb-2">
                                        <a href="${employee.link}" target="_blank" class="manager-name" style="color: black; text-decoration: underline; transition: color 3s blue;margin-top: 1rem;">
                                            <h3 class="text-lg font-semibold mt-2 underline">${employee.name}</h3>
                                        </a>
                                        <h4 class="font-semibold">${employee.position}</h4>
                                    </div>
                                    ${employee.profile_picture
                                        ? `<img src="/storage/${employee.profile_picture}" alt="${employee.name}" class="rounded-md mb-2 mx-auto" style="width: 250px; height: 250px; object-fit: cover;">`
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

                                        <!-- Delete Button -->
                                        <form action="/employees/${employee.id}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"
                                                style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 6px 12px; border: none;margin-left: 1rem;">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>`;
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
        </script>
    @endsection
