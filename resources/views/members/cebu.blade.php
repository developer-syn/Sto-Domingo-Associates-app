@extends('admin.members')

@section('title', 'Members')

@section('content')

    <h1
        style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
        Cebu Branch Managers
    </h1>

    <!-- Branch Manager Modal Trigger -->
            <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">
            <div class="flex items-center justify-between">
                <button id="openBranchManagerModal" class="text-blue-500 hover:text-blue-600 focus:outline-none">
                    <i class="fas fa-plus fa-xl"></i>
                </button>
            </div>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 460px; overflow: auto;">
            <div
                class="flex flex-nowrap gap-6 py-4"
                style="min-width: 100%; scrollbar-width: thin; scrollbar-color: #ec2a2a #f5f5f5;"
            >
                @foreach ($managerProfiles as $manager)
                    <div class="flex-shrink-0" style="width: 350px;">
                        <div class="bg-white p-4 border-black-1 rounded-lg shadow-md flex flex-col justify-between text-center"
                            style="background-color: #fff; box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; margin-top: 1rem;">
                            <div>
                                <a href="{{ $manager->link }}" target="_blank" class="manager-name"
                                    style="color: black; text-decoration: underline;">
                                    <h3 class="text-lg font-semibold mt-2 underline">{{ $manager->name }}</h3>
                                </a>
                                <h4 class="text-md font-medium text-gray-600 mt-0.1">{{ $manager->position }}</h4>
                                @if ($manager->profile_picture)
                                    <img src="{{ asset('storage/' . $manager->profile_picture) }}" alt="{{ $manager->name }}"
                                        class="object-cover rounded-md mb-2 mx-auto" style="width: 250px; height: 250px;">
                                @else
                                    <div class="flex items-center justify-center mb-2 mx-auto"
                                         style="width: 250px; height: 250px; background-color: #f5f5f5; border-radius: 0.375rem;">
                                        <i class="fas fa-user-circle" style="font-size: 100px; color: #cecece;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex justify-center mt-2 gap-2">
<button
    class="editManagerBtn text-white px-3 py-1 w-32"
    style="background-color: #2196f3; border-radius: 5px; border: none; display: flex; align-items: center; justify-content: center; gap: 4px;"
    data-manager-id="{{ $manager->id }}"
    data-manager-name="{{ $manager->name }}"
    data-manager-position="{{ $manager->position }}"
    data-manager-educbackground="{{ $manager->educbackground }}"
    data-manager-keyskills="{{ $manager->keyskills }}"
    data-manager-link="{{ $manager->link }}">
    <i class="fas fa-edit"></i> Edit
</button>
                                <form action="{{ route('members.deleteManagerProfile', ['id' => $manager->id]) }}"
                                    method="POST"
                                    style="display: inline-block;"
                                    onsubmit="return confirm('Are you sure you want to delete this manager?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-white px-3 py-1 w-32"
                                        style="background-color: #ec2a2a; border-radius: 5px; border: none; display: flex; align-items: center; justify-content: center; gap: 4px;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                <button onclick="showEmployees({{ $manager->id }})"
                                    class="text-white px-3 py-1 w-32"
                                    style="background-color: #2196f3; border-radius: 5px; border: none; display: flex; align-items: center; justify-content: center; gap: 4px;"
                                    data-manager-id="{{ $manager->id }}">
                                    <i class="fas fa-users"></i> Display
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
        </div>
        </div>

        <!-- Add New Branch Manager Modal -->
<div class="modal fade" id="branchManagerModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="branchManagerModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header" style="background-color: rgb(212, 6, 16); color: #fff;">
                <h5 class="modal-title w-100 text-center" id="branchManagerModalLabel">Add New Branch Manager</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" id="closeBranchManagerModal"></button>
            </div>
            <form id="branchManagerForm" action="{{ route('members.storeManagerProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" id="position" name="position" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="educbackground" class="form-label">Education Background</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="educbackground" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="educbackground" id="hidden_educbackground">
                    </div>
                    <div class="mt-3">
                        <label for="keyskills" class="form-label">Key Skills</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="keyskills" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="keyskills" id="hidden_keyskills">
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" id="link" name="link" placeholder="https://example.com" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="branch" value="cebu">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger px-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Edit Branch Manager Modal -->
        <div class="modal fade" id="editBranchManagerModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editBranchManagerModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header" style="background-color: #ec2a2a; color: #fff;">
                <h5 class="modal-title w-100 text-center" id="editBranchManagerModalLabel">Edit Branch Manager</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editManagerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="edit_manager_name" class="form-label">Name</label>
                            <input type="text" id="edit_manager_name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_manager_position" class="form-label">Position</label>
                            <input type="text" id="edit_manager_position" name="position" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="edit_manager_educbackground" class="form-label">Education Background</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="edit_manager_educbackground" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="educbackground" id="hidden_edit_educbackground">
                    </div>
                    <div class="mt-3">
                        <label for="edit_manager_keyskills" class="form-label">Key Skills</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="edit_manager_keyskills" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="keyskills" id="hidden_edit_keyskills">
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="edit_manager_link" class="form-label">Link</label>
                            <input type="url" id="edit_manager_link" name="link" placeholder="https://example.com" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="edit_profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" id="edit_profile_picture" name="profile_picture" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <br>

        <h1
            style="text-align: center; font-weight: bolder; margin-bottom: 20px; font-size: 30px; font-family: 'Palatino', serif;">
            Employees
        </h1>

<!-- Employee Display Section -->
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
    style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">
    <div class="flex items-center justify-between mb-4">
        <button type="button"
            class="text-blue-500 hover:text-blue-600 focus:outline-none"
            data-bs-toggle="modal"
            data-bs-target="#employeeModal">
            <i class="fas fa-plus fa-xl"></i>
        </button>
    </div>
    <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md"
        style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 450px; overflow: auto;">

        @foreach ($managerProfiles as $manager)
            <div id="employees-{{ $manager->id }}" class="flex flex-nowrap gap-6 hidden py-2"
                style="min-width: 100%; scrollbar-width: thin; scrollbar-color: #ec2a2a #f5f5f5;">
                <!-- Employee cards will be loaded here via JavaScript -->
            </div>
        @endforeach
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
        <div class="modal fade" id="employeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="employeeModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg">
            <div class="modal-header" style="background-color: #ec2a2a; color: #fff;">
                <h5 class="modal-title w-100 text-center" id="employeeModalLabel">Add New Employee</h5>
                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <form id="EmployeeForm" action="{{ route('members.storeEmployeeProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="manager" class="form-label">Select Manager</label>
                        <select id="manager_profile_id" name="manager_profile_id"
                            class="form-select" required>
                            <option value="">Select a Manager</option>
                            @foreach ($managerProfiles as $manager)
                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" id="position" name="position" class="form-control" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="educationback" class="form-label">Education Background</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="educationback" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="educationback" id="hidden_educationback">
                    </div>
                    <div class="mt-3">
                        <label for="keyskills" class="form-label">Key Skills</label>
                        <div class="btn-toolbar mb-2" role="toolbar" aria-label="Formatting toolbar">
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Bold" onclick="formatText('bold')"><i class="fas fa-bold"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Italic" onclick="formatText('italic')"><i class="fas fa-italic"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Underline" onclick="formatText('underline')"><i class="fas fa-underline"></i></button>
                            </div>
                            <div class="btn-group me-2" role="group">
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Left" onclick="formatText('justifyLeft')"><i class="fas fa-align-left"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Center" onclick="formatText('justifyCenter')"><i class="fas fa-align-center"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Align Right" onclick="formatText('justifyRight')"><i class="fas fa-align-right"></i></button>
                                <button type="button" class="btn btn-outline-secondary btn-sm" title="Justify" onclick="formatText('justifyFull')"><i class="fas fa-align-justify"></i></button>
                            </div>
                        </div>
                        <div id="employee_keyskills" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                        <input type="hidden" name="keyskills" id="hidden_employee_keyskills">
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="link" class="form-label">Link</label>
                            <input type="url" id="link" name="link" placeholder="https://example.com" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="profile_picture_employee" class="form-label">Profile Picture</label>
                            <input type="file" id="profile_picture_employee" name="profile_picture_employee" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="branch" value="cebu">
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger px-4">Submit</button>
                </div>
            </form>
        </div>
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

        <!-- Font Awesome & Bootstrap -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
            .btn-toolbar .btn {
        min-width: 32px;
    }
    .form-control[contenteditable="true"] {
        min-height: 80px;
        background: #f8f9fa;
        border-radius: 0.375rem;
        overflow-y: auto;
    }

    /* Add to your existing style section */
[id^="employees-"]::-webkit-scrollbar {
    height: 10px;
}

[id^="employees-"]::-webkit-scrollbar-thumb {
    background: #ec2a2a;
    border-radius: 6px;
}

[id^="employees-"]::-webkit-scrollbar-track {
    background: #f5f5f5;
}

/* For Firefox */
[id^="employees-"] {
    scrollbar-width: thin;
    scrollbar-color: #ec2a2a #f5f5f5;
}

.flex-nowrap {
    display: flex;
    flex-wrap: nowrap;
    gap: 1.5rem;
}

/* Add these styles to your existing style section */
.employee-container {
        display: flex;
        flex-wrap: nowrap;
        gap: 1.5rem;
        min-width: 100%;
        scrollbar-width: thin;
        scrollbar-color: #ec2a2a #f5f5f5;
        padding: 1rem 0;
    }

    .employee-card {
        flex-shrink: 0;
        width: 350px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);
        border-radius: 0.5rem;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 430px;
    }

    .employee-image-container {
        width: 250px;
        height: 250px;
        margin: 0 auto;
        background-color: #f5f5f5;
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.5rem;
    }

    .employee-image {
        width: 250px;
        height: 250px;
        object-fit: cover;
        border-radius: 0.375rem;
    }

    .employee-actions {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .employee-button {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        border: none;
        color: white;
        cursor: pointer;
        transition: all 0.2s;
    }

    .employee-button:hover {
        transform: translateY(-1px);
    }

    .employee-button.edit {
        background-color: #2196f3;
    }

    .employee-button.delete {
        background-color: #ec2a2a;
    }
        </style>
        <!-- Include Quill.js -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <script>
            // Function to format text in contenteditable divs
            function formatText(command, value = null) {
                document.execCommand(command, false, value);
            }

            // Before form submission, transfer contenteditable content to hidden input fields
            document.addEventListener('DOMContentLoaded', function() {
                const employeeForm = document.getElementById('EmployeeForm');
                const branchManagerForm = document.getElementById('branchManagerForm');
                const editManagerForm = document.getElementById('editManagerForm');
                const editEmployeeForm = document.getElementById('editEmployeeForm');

                if (employeeForm) {
                    employeeForm.addEventListener('submit', function(e) {
                        // Copy the content from contenteditable divs to hidden inputs
                        document.getElementById('hidden_education_background').value = document.getElementById(
                            'educationback').innerHTML.trim();
                        document.getElementById('hidden_keyskills').value = document.getElementById('keyskills')
                            .innerHTML.trim();
                    });
                }

                if (branchManagerForm) {
                    branchManagerForm.addEventListener('submit', function(e) {
                        // Ensure the IDs match the updated field names
                        document.getElementById('hidden_educbackground').value = document.getElementById(
                            'educbackground').innerHTML.trim();
                        document.getElementById('hidden_keyskills').value = document.getElementById('keyskills')
                            .innerHTML.trim();
                    });
                }

                if (editManagerForm) {
                    editManagerForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_edit_educbackground').value = document.getElementById(
                            'edit_manager_educbackground').innerHTML.trim();
                        document.getElementById('hidden_edit_keyskills').value = document.getElementById(
                            'edit_manager_keyskills').innerHTML.trim();
                    });
                }

                if (editEmployeeForm) {
                    editEmployeeForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_edit_educbackground').value = document.getElementById(
                            'edit_educbackground').innerHTML.trim();
                        document.getElementById('hidden_edit_keyskills').value = document.getElementById(
                            'edit_keyskills').innerHTML.trim();
                    });
                }
            });

            // JavaScr
        </script>


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
// Replace or add this script at the bottom of your file
document.addEventListener('DOMContentLoaded', function() {
    // Initialize edit manager button functionality
    const editManagerButtons = document.querySelectorAll('.editManagerBtn');
    const editBranchManagerModalElement = document.getElementById('editBranchManagerModal');
    const editBranchManagerModal = new bootstrap.Modal(editBranchManagerModalElement);

    editManagerButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get data from button attributes
            const managerId = this.dataset.managerId;
            const managerName = this.dataset.managerName;
            const managerPosition = this.dataset.managerPosition;
            const managerEducBackground = this.dataset.managerEducbackground;
            const managerKeySkills = this.dataset.managerKeyskills;
            const managerLink = this.dataset.managerLink;

            // Set form action
            const editManagerForm = document.getElementById('editManagerForm');
            editManagerForm.action = `/members/updateManagerProfile/${managerId}`;

            // Fill form fields
            document.getElementById('edit_manager_name').value = managerName || '';
            document.getElementById('edit_manager_position').value = managerPosition || '';
            document.getElementById('edit_manager_educbackground').innerHTML = managerEducBackground || '';
            document.getElementById('edit_manager_keyskills').innerHTML = managerKeySkills || '';
            document.getElementById('edit_manager_link').value = managerLink || '';

            // Show modal
            editBranchManagerModal.show();
        });
    });

    // Handle modal close
    editBranchManagerModalElement.addEventListener('hidden.bs.modal', function () {
        // Reset form when modal is closed
        document.getElementById('editManagerForm').reset();
    });
});

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
                            const employeeEducBackground = editButton.getAttribute(
                                'data-employee-educbackground'); // Fixed the attribute name here
                            const employeeKeySkills = editButton.getAttribute('data-employee-keyskills');
                            const employeeLink = editButton.getAttribute('data-employee-link');

                            // Set the form action and pre-fill the data
                            editEmployeeForm.action = `/members/updateEmployeeProfile/${employeeId}`;
                            document.getElementById('edit_name').value = employeeName;
                            document.getElementById('edit_position').value = employeePosition;

                            // Check if 'edit_educationback' is a textarea or contenteditable div
                            const editEducationBackElement = document.getElementById('edit_educationback');
                            if (editEducationBackElement.tagName === 'TEXTAREA') {
                                editEducationBackElement.value = employeeEducBackground; // For textarea
                            } else {
                                editEducationBackElement.innerHTML =
                                    employeeEducBackground; // For contenteditable div
                            }

                            document.getElementById('edit_keyskills').value =
                                employeeKeySkills; // Assuming this is also a textarea
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
                const allEmployeeContainers = document.querySelectorAll('[id^="employees-"]');
                allEmployeeContainers.forEach(container => container.classList.add('hidden'));

                fetch(`/managers/${managerId}/employees`)
                    .then(response => response.json())
                    .then(data => {
                        const employeeContainer = document.getElementById(`employees-${managerId}`);
                        let employeeHTML = '';

                        if (data.length === 0) {
                            employeeHTML = '<p class="text-center w-full">No employees found for this manager.</p>';
                        } else {
                            data.forEach(employee => {
                                employeeHTML += `
                                <div class="flex-shrink-0" style="width: 350px;">
                                    <div class="bg-white p-4 border-black-1 rounded-lg shadow-md flex flex-col justify-between text-center"
                                        style="background-color: #fff; box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 430px;">
                                        <div>
                                            <a href="${employee.link}" target="_blank" class="employee-name"
                                                style="color: black; text-decoration: underline;">
                                                <h3 class="text-lg font-semibold mt-2 underline">${employee.name}</h3>
                                            </a>
                                            <h4 class="text-md font-medium text-gray-600 mt-0.1">${employee.position}</h4>
                                            ${employee.profile_picture
                                                ? `<img src="/storage/${employee.profile_picture}" alt="${employee.name}"
                                                    class="object-cover rounded-md mb-2 mx-auto"
                                                    style="width: 250px; height: 250px;">`
                                                : `<div class="flex items-center justify-center mb-2 mx-auto"
                                                    style="width: 250px; height: 250px; background-color: #f5f5f5; border-radius: 0.375rem;">
                                                    <i class="fas fa-user-circle" style="font-size: 100px; color: #cecece;"></i>
                                                   </div>`
                                            }
                                        </div>
                                        <div class="flex justify-center space-x-3">
                                            <button type="button"
                                                class="editEmployeeBtn text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-200 flex items-center"
                                                style="background-color: #2196f3;"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editEmployeeModal"
                                                data-employee-id="${employee.id}"
                                                data-employee-name="${employee.name}"
                                                data-employee-position="${employee.position}"
                                                data-employee-educbackground="${employee.educationback}"
                                                data-employee-keyskills="${employee.keyskills}"
                                                data-employee-link="${employee.link}">
                                                <i class="fas fa-edit mr-2"></i>
                                                Edit
                                            </button>
                                            <form action="/employees/${employee.id}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this employee?');"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-200 flex items-center"
                                                    style="background-color: #ec2a2a;">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>`;
                            });
                        }
                        employeeContainer.innerHTML = employeeHTML;
                        employeeContainer.classList.remove('hidden');

                        // Initialize edit buttons after adding employees to DOM
                        initializeEditEmployeeButtons();
                    })
                    .catch(error => {
                        console.error('Error fetching employees:', error);
                        alert('There was an error fetching the employees. Please try again later.');
                    });
            }

            function initializeEditEmployeeButtons() {
    document.querySelectorAll('.editEmployeeBtn').forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.dataset.employeeId;
            const employeeName = this.dataset.employeeName;
            const employeePosition = this.dataset.employeePosition;
            const employeeEducBackground = this.dataset.employeeEducbackground;
            const employeeKeySkills = this.dataset.employeeKeyskills;
            const employeeLink = this.dataset.employeeLink;

            // Set form action and values
            const editForm = document.getElementById('editEmployeeForm');
            editForm.action = `/employees/update/${employeeId}`;

            document.getElementById('edit_name').value = employeeName || '';
            document.getElementById('edit_position').value = employeePosition || '';
            document.getElementById('edit_educationback').innerHTML = employeeEducBackground || '';
            document.getElementById('edit_keyskills').innerHTML = employeeKeySkills || '';
            document.getElementById('edit_link').value = employeeLink || '';
        });
    });
}
        </script>

        <script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    const branchManagerModal = new bootstrap.Modal(document.getElementById('branchManagerModal'));

    // Add click event listener to open button
    const openBranchManagerModalBtn = document.getElementById('openBranchManagerModal');
    if (openBranchManagerModalBtn) {
        openBranchManagerModalBtn.addEventListener('click', function() {
            branchManagerModal.show();
        });
    }

    // Add click event listener to close button
    const closeBranchManagerModalBtn = document.getElementById('closeBranchManagerModal');
    if (closeBranchManagerModalBtn) {
        closeBranchManagerModalBtn.addEventListener('click', function() {
            branchManagerModal.hide();
        });
    }

    // Handle form submission
    const branchManagerForm = document.getElementById('branchManagerForm');
    if (branchManagerForm) {
        branchManagerForm.addEventListener('submit', function(e) {
            document.getElementById('hidden_educbackground').value =
                document.getElementById('educbackground').innerHTML.trim();
            document.getElementById('hidden_keyskills').value =
                document.getElementById('keyskills').innerHTML.trim();
        });
    }
});
</script>

    @endsection
