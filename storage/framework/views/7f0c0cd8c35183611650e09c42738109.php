<?php $__env->startSection('title', 'Members'); ?>

<?php $__env->startSection('content'); ?>

    <h1
        style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
        Branch Managers
    </h1>

    <!-- Branch Manager Modal Trigger -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 500px;">
            <div class="flex items-center justify-between">
                <button id="openBranchManagerModal" class="text-blue-500 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-plus fa-xl"></i>
                </button>
            </div>

            <!-- Display uploaded manager profile pictures -->
            <div class="flex flex-wrap -mx-6" style="max-height: 950px; overflow-y: auto;">
                <?php $__currentLoopData = $managerProfiles->whereNotIn('branch', ['cebu', 'makati', 'bohol', 'negros-oriental', 'pampanga']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 flex items-center justify-center" style="height: 400px;">
                    <div class="bg-white p-4 border-black-1 rounded-lg shadow-md text-center"
                        style="padding: .2rem; background-color: rgb(255, 255, 255); box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 350px; height: 400px; object-fit: cover; margin-top: 1rem;">
                        <h1 class="text-lg font-semibold mt-2"><?php echo e($manager->specify_branch); ?> Branch</h1>
                        <a href="<?php echo e($manager->link); ?>" target="_blank" class="manager-name"
                            style="color: black; text-decoration: underline; transition: color 3s blue;margin-top: 1rem;">
                            <h3 class="text-lg font-semibold underline"><?php echo e($manager->name); ?></h3>
                        </a>
                        <h4 class="text-md font-medium text-gray-600 mt-0.1"><?php echo e($manager->position); ?></h4>
                        <!-- Adjusted margin -->
                        <?php if($manager->profile_picture): ?>
                            <img src="<?php echo e(asset('uploads/' . $manager->profile_picture)); ?>" alt="<?php echo e($manager->name); ?>"
                                class="object-cover rounded-md mb-2 mx-auto" style="width: 250px; height: 250px;">
                        <?php else: ?>
                            <p>No image</p>
                        <?php endif; ?>

                        <div class="flex justify-center mt-2">
                            <button
                                class="editManagerBtn text-green-500 hover:text-green-700 mx-2 transition-colors duration-300 ease-in-out"
                                style="background-color: rgb(33, 150, 243); color: white; border-radius: 5px; padding: 4px 8px; border: none;"
                                data-manager-id="<?php echo e($manager->id); ?>" data-manager-name="<?php echo e($manager->name); ?>"
                                data-manager-position="<?php echo e($manager->position); ?>"                               data-manager-specify-branch="<?php echo e($manager->specify_branch); ?>"
                                data-manager-educbackground="<?php echo e($manager->educbackground); ?>"
                                data-manager-keyskills="<?php echo e($manager->keyskills); ?>"
                                data-manager-link="<?php echo e($manager->link); ?>"
                                data-manager-picture="<?php echo e($manager->profile_picture); ?>">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            &nbsp;
                            <form action="<?php echo e(route('members.deleteManagerProfile', ['id' => $manager->id])); ?>"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this manager?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                    style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 4px 8px; border: none;">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            &nbsp;
                            <!-- "See Employees" Button -->
                            <button onclick="showEmployees(<?php echo e($manager->id); ?>)"
                                class="text-blue-500 hover:text-blue-600 mx-2 transition-colors duration-300 ease-in-out"
                                data-manager-id="<?php echo e($manager->id); ?>" data-target="#employeeModal-<?php echo e($manager->id); ?>"
                                style="background-color: rgb(33, 150, 243); color: white; border-radius: 5px; padding: 4px 8px; border: none;"
                                data-toggle="modal">
                                <i class="fas fa-users"></i> See Employees
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Employee Modal for this Manager -->
                <div id="employeeModal-<?php echo e($manager->id); ?>"
                    class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white p-4 rounded-lg shadow-md" style="width: 80%; max-width: 800px;">
                        <button class="close-modal text-gray-500 hover:text-gray-700 absolute top-2 right-2"
                            data-modal-id="employeeModal-<?php echo e($manager->id); ?>">&times;</button>
                        <h2 class="text-xl font-bold mb-4 text-center">Employees of <?php echo e($manager->name); ?></h2>

                        <div class="flex flex-wrap -mx-6 overflow-y-auto">
                            <?php $__currentLoopData = $employeeProfiles->where('manager_id', $manager->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="w-full sm:w-1/2 md:w-1/3 px-4 mb-6 flex items-center justify-center"
                                    style="height: 260px;">
                                    <div class="bg-white p-4 border-black-1 rounded-lg shadow-md text-center"
                                        style="padding: .2rem; background-color: rgb(255, 255, 255); box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 250px; height: 250px; object-fit: cover;">
                                        <h3 class="text-lg font-semibold mt-2"><?php echo e($employee->name); ?></h3>
                                        <?php if($employee->profile_picture): ?>
                                            <img src="<?php echo e(asset('uploads/' . $employee->profile_picture)); ?>"
                                                alt="<?php echo e($employee->name); ?>"
                                                class="object-cover rounded-md mb-2 mx-auto"
                                                style="width: 150px; height: 150px;">
                                        <?php else: ?>
                                            <p>No image</p>
                                        <?php endif; ?>

                                        <div class="flex justify-center mt-2">
                                            <form
                                                action="<?php echo e(route('members.deleteEmployeeProfile', ['id' => $employee->id])); ?>"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                                    style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 8px 16px; border: none;">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Add New Branch Manager Modal -->
    <div id="branchManagerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg shadow-md" style="width: 450px;">
            <button id="closeBranchManagerModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>
            <h3 class="text-lg font-semibold mb-4" style="text-align:center;">Add New Branch Manager</h3>
            <form id="branchManagerForm" action="<?php echo e(route('members.storeManagerProfile')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="specify-branch" class="block text-sm font-medium text-gray-700">Branch Location</label>
                    <input type="text" id="specify-branch" name="specify_branch"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                </div>

                <div class="mb-4 flex space-x-full">
                    <div class="w-full">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="w-full">
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                </div>

                <!-- Text formatting toolbar for Educational Background -->
                <label for="educbackground" class="block text-sm font-medium text-gray-700">Education
                    Background</label>
                <div class="toolbar mb-2">
                    <button type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>
                    <button type="button" onclick="formatText('justifyLeft')">L</button>
                    <button type="button" onclick="formatText('justifyCenter')">C</button>
                    <button type="button" onclick="formatText('justifyRight')">R</button>
                    <button type="button" onclick="formatText('justifyFull')">J</button>
                </div>
                <div id="educbackground" contenteditable="true" class="editable-area">
                </div>
                <input type="hidden" name="educbackground" id="hidden_educbackground">

                <!-- Text formatting toolbar for Key Skills -->
                <label for="keyskills" class="block text-sm font-medium text-gray-700 mt-4">Key Skills</label>
                <div class="toolbar mb-2">
                    <button type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>
                    <button type="button" onclick="formatText('justifyLeft')">L</button>
                    <button type="button" onclick="formatText('justifyCenter')">C</button>
                    <button type="button" onclick="formatText('justifyRight')">R</button>
                    <button type="button" onclick="formatText('justifyFull')">J</button>
                </div>
                <div id="keyskills" contenteditable="true" class="editable-area">
                </div>
                <input type="hidden" name="keyskills" id="hidden_keyskills">

                <div class="mb-4 mt-4">
                    <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                    <input type="url" id="link" name="link" placeholder="https://example.com"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700">Profile
                        Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                </div>

                <input type="hidden" name="branch" value="other">
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
        <div class="bg-white p-4 rounded-lg shadow-md" style="width: 450px;">
            <button id="closeEditBranchManagerModal" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                &times;
            </button>
            <h3 class="text-lg font-semibold mb" style="text-align:center;">Edit Branch Manager</h3>
            <form id="editManagerForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-4">
                    <label for="edit_manager_branch" class="block text-sm font-medium text-gray-700">Branch
                        Location</label>
                    <input type="text" id="edit_manager_specify_branch" name="specify_branch"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4 flex space-x-4">
                    <div class="mb">
                        <label for="edit_manager_name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="edit_manager_name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="mb">
                        <label for="edit_manager_position"
                            class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="edit_manager_position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                </div>

                <!-- Text formatting toolbar for Educational Background -->
                <label for="edit_manager_educbackground" class="block text-sm font-medium text-gray-700">Education
                    Background</label>
                <div class="toolbar mb-2">
                    <button type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>
                    <button type="button" onclick="formatText('justifyLeft')">L</button>
                    <button type="button" onclick="formatText('justifyCenter')">C</button>
                    <button type="button" onclick="formatText('justifyRight')">R</button>
                    <button type="button" onclick="formatText('justifyFull')">J</button>
                </div>
                <div id="edit_manager_educbackground" contenteditable="true"
                    class="editable-area border border-gray-300 rounded-md shadow-sm p-2 mb-4"
                    style="min-height: 50px;"></div>
                <input type="hidden" name="educbackground" id="hidden_edit_educbackground">

                <!-- Text formatting toolbar for Key Skills -->
                <label for="edit_manager_keyskills" class="block text-sm font-medium text-gray-700">Key Skills</label>
                <div class="toolbar mb-2">
                    <button type="button" onclick="formatText('bold')"><b>B</b></button>
                    <button type="button" onclick="formatText('italic')"><i>I</i></button>
                    <button type="button" onclick="formatText('underline')"><u>U</u></button>
                    <button type="button" onclick="formatText('justifyLeft')">L</button>
                    <button type="button" onclick="formatText('justifyCenter')">C</button>
                    <button type="button" onclick="formatText('justifyRight')">R</button>
                    <button type="button" onclick="formatText('justifyFull')">J</button>
                </div>
                <div id="edit_manager_keyskills" contenteditable="true"
                    class="editable-area border border-gray-300 rounded-md shadow-sm p-2 mb-4"
                    style="min-height: 50px;"></div>
                <input type="hidden" name="keyskills" id="hidden_edit_keyskills">

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
            <?php $__currentLoopData = $managerProfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="margin-right: 10px; margin-left:10px;">
                    <!-- Placeholder for showing employees under this manager -->
                    <div id="employees-<?php echo e($manager->id); ?>" class="m-4 hidden flex flex-wrap gap-6"
                        style="width: 100%;">
                        <!-- The employee data will be loaded here via JavaScript or server-side -->
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <br>
    <h1
        style="text-align: center; font-weight: bolder; margin-bottom: 30px; font-size: 30px; font-family: 'Palatino', serif;">
        New Recruits
    </h1>

    <!-- Employee Modal Trigger -->
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
        style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">

        <?php if($managerProfiles->isEmpty()): ?>
            <p>No manager profiles found.</p>
        <?php else: ?>
        <?php endif; ?>

        <?php if($acceptedRecruits->isEmpty()): ?>
            <p>No accepted recruits found.</p>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table id="contact_us" class="table table-striped table-bordered"
                    style="width:100%;-webkit-scrollbar: 0.8pv; text-align:center;">
                    <thead>
                        <tr>
                            
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
                        <?php $__currentLoopData = $acceptedRecruits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recruit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e($loop->iteration); ?></td>
                                <td><?php echo e($recruit->name); ?></td>
                                <td><?php echo e($recruit->email); ?></td>
                                <td><?php echo e($recruit->phone); ?></td>
                                <td><?php echo e($recruit->job_type); ?></td>
                                <td><?php echo e($recruit->inquiry_type); ?></td>
                                <td>
                                    <form action="<?php echo e(route('members.destroyNewRecruit', ['id' => $recruit->id])); ?>"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this recruit?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 mx-2 transition-colors duration-300 ease-in-out"
                                            style="background-color: rgb(236, 42, 42); color: white; border-radius: 5px; padding: 8px 16px; border: none;">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <!-- Employee Modal -->
    <div id="employeeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-4 rounded-lg shadow-md" style="width: 450px;">
            <button id="closeEmployeeModal"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
            <h3 class="text-lg font-semibold mb-4 text-center">Add New Employee</h3>
            <form id="EmployeeForm" action="<?php echo e(route('members.storeEmployeeProfile')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="manager" class="block text-sm font-medium text-gray-700">Select Manager</label>
                    <select id="manager_profile_id" name="manager_profile_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        <option value="">Select a Manager</option>
                        <?php $__currentLoopData = $managerProfiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($manager->id); ?>"><?php echo e($manager->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-4 flex space-x-4">
                    <div class="w-full">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                    <div class="w-full">
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" id="position" name="position"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                    </div>
                </div>

                <!-- Education Background -->
                <div class="mb-4">
                    <label for="educationback" class="block text-sm font-medium text-gray-700">Education
                        Background</label>
                    <textarea id="educationback" name="educationback"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                      focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="4"></textarea>
                </div>

                <!-- Key Skills -->
                <div class="mb-4">
                    <label for="keyskills" class="block text-sm font-medium text-gray-700">Key Skills</label>
                    <textarea id="keyskills" name="keyskills"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                      focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="4"></textarea>
                </div>

                <!-- Link and Profile Picture -->
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

                <input type="hidden" name="branch" value="other">

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

    <!-- Edit Employee Modal -->
    <div id="editEmployeeModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-md relative" style="width: 450px;">
            <button id="closeEditEmployeeModal"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            <h3 class="text-xl font-semibold mb-4" style="text-align:center;">Edit Employee</h3>
            <form id="editEmployeeForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
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

                <!-- Education Background -->
                <div class="mb-4">
                    <label for="edit_educationback" class="block text-sm font-medium text-gray-700">Education
                        Background</label>
                    <textarea id="edit_educationback" name="educationback"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                      focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="4"></textarea>
                </div>

                <!-- Key Skills -->
                <div class="mb-4">
                    <label for="edit_keyskills" class="block text-sm font-medium text-gray-700">Key Skills</label>
                    <textarea id="edit_keyskills" name="keyskills"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2
                      focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        rows="4"></textarea>
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

        <style>
            .toolbar button {
                background-color: #f0f0f0;
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 5px 10px;
                margin-right: 5px;
                cursor: pointer;
                transition: background-color 0.3s, transform 0.3s;
            }

            .toolbar button:hover {
                background-color: #e0e0e0;
                transform: scale(1.05);
            }

            .toolbar button:active {
                background-color: #d0d0d0;
                transform: scale(0.95);
            }

            .editable-area {
                border: 1px solid #ccc;
                padding: 10px;
                min-height: 80px;
                border-radius: 5px;
                overflow-y: auto;
                max-height: 100px;
            }
        </style>

        <!-- Include Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <!-- JavaScript for Modal Behavior -->

        <script src="<?php echo e(asset('js/branch-js/other-branch.js')); ?>"></script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.members', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\User\Desktop\Sto-Domingo-Associates-app\resources\views/admin/members/other.blade.php ENDPATH**/ ?>