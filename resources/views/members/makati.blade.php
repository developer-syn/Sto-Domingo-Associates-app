@extends('admin.members')

@section('title', 'Members')

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1
            style="text-align: center; font-weight: bolder; font-size: 30px; font-family: 'Palatino', serif; flex: 1;">
            Makati Branch Managers
        </h1>

    </div>

        <div class="d-flex align-items-center mb-4" style="gap: 10px; margin-left: 20px;">
            <button id="openBranchManagerModal" class="btn btn-primary d-flex align-items-center"
                style="background-color: #2196f3; border: none;">
                <i class="fas fa-plus me-2"></i> Add Manager
            </button>
            <button type="button"
                id="openEmployeeModal"
                class="btn btn-primary d-flex align-items-center"
                style="background-color: #2196f3; border: none;"
                data-bs-toggle="modal"
                data-bs-target="#employeeModal">
                <i class="fas fa-plus me-2"></i> Add Employee
            </button>
        </div>



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
                                    data-manager-link="{{ $manager->link }}"
                                    data-manager-picture="{{ $manager->profile_picture }}">
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
                                            style="padding: .2rem; background-color: #fff; box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 250px; height: 250px; object-fit: cover;">
                                            <h3 class="text-lg font-semibold mt-2">{{ $employee->name }}</h3>
                                            @if ($employee->profile_picture)
                                                <img src="{{ asset('storage/' . $employee->profile_picture) }}"
                                                    alt="{{ $employee->name }}"
                                                    class="object-cover rounded-md mb-2 mx-auto"
                                                    style="width: 150px; height: 150px;">
                                            @else
                                                <div class="flex items-center justify-center mb-2 mx-auto"
                                                     style="width: 150px; height: 150px; background-color: #f5f5f5; border-radius: 0.375rem;">
                                                    <i class="fas fa-user-circle" style="font-size: 50px; color: #cecece;"></i>
                                                </div>
                                            @endif
                                            <div class="flex justify-center mt-2">
                                                <form
                                                    action="{{ route('members.deleteEmployeeProfile', ['id' => $employee->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white mx-2"
                                                        style="background-color: #ec2a2a; border-radius: 5px; padding: 8px 16px; border: none;">
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
        <div id="branchManagerModal" class="modal fade" tabindex="-1" aria-labelledby="branchManagerModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="branch" value="makati">
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
        </div>
        </div>

        <br>


                <h1 class="text-center fw-bold mb-4" style="font-size: 30px; font-family: 'Palatino', serif;">
                    Employees
                </h1>
        <!-- Employee Modal Trigger -->

            <div class="max-w-full mx-auto bg-white p-6 rounded-lg shadow-md"
                style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575); width: 100%; height: 460px; overflow: auto;">


                @foreach ($managerProfiles as $manager)
                    <div id="employees-{{ $manager->id }}" class="flex flex-nowrap gap-6 hidden py-4"
                        style="min-width: 100%; scrollbar-width: thin; scrollbar-color: #ec2a2a #f5f5f5;">
                        <!-- Employee cards will be loaded here via JavaScript -->
                    </div>
                @endforeach
            </div>


        <br>
        <h1 class="text-center fw-bold mb-4" style="font-size: 30px; font-family: 'Palatino', serif;">
            New Recruits
        </h1>

        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md"
            style="box-shadow: 0 4px 8px rgba(223, 14, 14, 0.575);">
            @if ($managerProfiles->isEmpty())
                <p>No manager profiles found.</p>
            @endif
            @if ($acceptedRecruits->isEmpty())
                <p>No accepted recruits found.</p>
            @else
                <div style="overflow-x: auto;">
                    <table id="contact_us" class="table table-striped table-bordered" style="width:100%; text-align:center;">
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
                            @foreach ($acceptedRecruits as $recruit)
                                <tr>
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
                                                class="text-white mx-2"
                                                style="background-color: #ec2a2a; border-radius: 5px; padding: 8px 16px; border: none;">
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
                            <input type="hidden" name="branch" value="makati">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-danger px-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Employee Modal -->
        <div class="modal fade" id="editEmployeeModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editEmployeeModalLabel">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow-lg">
                    <div class="modal-header" style="background-color: #ec2a2a; color: #fff;">
                        <h5 class="modal-title w-100 text-center" id="editEmployeeModalLabel">Edit Employee</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editEmployeeForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="edit_name" class="form-label">Name</label>
                                    <input type="text" id="edit_name" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_position" class="form-label">Position</label>
                                    <input type="text" id="edit_position" name="position" class="form-control" required>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="edit_educationback" class="form-label">Education Background</label>
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
                                <div id="edit_educationback" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                                <input type="hidden" name="educationback" id="hidden_edit_educationback">
                            </div>
                            <div class="mt-3">
                                <label for="edit_keyskills" class="form-label">Key Skills</label>
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
                                <div id="edit_keyskills" contenteditable="true" class="form-control" style="min-height: 80px; background: #f8f9fa; border-radius: 0.375rem; overflow-y: auto;"></div>
                                <input type="hidden" name="keyskills" id="hidden_edit_keyskills">
                            </div>
                            <div class="row g-3 mt-3">
                                <div class="col-md-6">
                                    <label for="edit_link" class="form-label">Link</label>
                                    <input type="url" id="edit_link" name="link" placeholder="https://example.com" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="edit_profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" id="edit_profile_picture" name="profile_picture_employee" class="form-control">
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

        <!-- Font Awesome & Bootstrap -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <style>
            .btn-toolbar .btn {
                min-width: 32px;
            }
            .form-control[contenteditable="true"] {
                min-height: 80px;
                background: #f8f9fa;
                border-radius: 0.375rem;
                overflow-y: auto;
            }
            /* Custom scrollbars */
            .max-w-full::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }

            .max-w-full::-webkit-scrollbar-thumb {
                background: #424242;
                border-radius: 6px;
            }

            .max-w-full::-webkit-scrollbar-track {
                background: #f5f5f5;
            }

            /* For Firefox */
            .max-w-full {
                scrollbar-width: thin;
                scrollbar-color: #424242 #f5f5f5;
            }

            /* Custom scrollbar for horizontal scroll */
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
        </style>

        <script>
            // Format text in contenteditable divs
            function formatText(command, value = null) {
                document.execCommand(command, false, value);
            }

            // Transfer contenteditable content to hidden input fields before submit
            document.addEventListener('DOMContentLoaded', function() {
                const branchManagerForm = document.getElementById('branchManagerForm');
                const editManagerForm = document.getElementById('editManagerForm');
                if (branchManagerForm) {
                    branchManagerForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_educbackground').value = document.getElementById('educbackground').innerHTML.trim();
                        document.getElementById('hidden_keyskills').value = document.getElementById('keyskills').innerHTML.trim();
                    });
                }
                if (editManagerForm) {
                    editManagerForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_edit_educbackground').value = document.getElementById('edit_manager_educbackground').innerHTML.trim();
                        document.getElementById('hidden_edit_keyskills').value = document.getElementById('edit_manager_keyskills').innerHTML.trim();
                    });
                }
            });

            // Bootstrap modal logic for Add Branch Manager
            document.addEventListener('DOMContentLoaded', function () {
    // Initialize the Bootstrap modal
    const branchManagerModal = new bootstrap.Modal(document.getElementById('branchManagerModal'), {
        keyboard: true,
        backdrop: 'static'
    });

    // Handle open button click
    const openBranchManagerModalBtn = document.getElementById('openBranchManagerModal');
    if (openBranchManagerModalBtn) {
        openBranchManagerModalBtn.addEventListener('click', () => branchManagerModal.show());
    }

    // Handle close button click
    const closeBranchManagerModalBtn = document.getElementById('closeBranchManagerModal');
    if (closeBranchManagerModalBtn) {
        closeBranchManagerModalBtn.addEventListener('click', () => branchManagerModal.hide());
    }

    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && branchManagerModal._isShown) {
            branchManagerModal.hide();
        }
    });
});
            // Edit Branch Manager Modal logic
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the Bootstrap modal
                const editBranchManagerModal = new bootstrap.Modal(document.getElementById('editBranchManagerModal'), {
                    keyboard: true,
                    backdrop: 'static'
                });

                // Get the close button and form
                const closeModalBtn = document.querySelector('#editBranchManagerModal .btn-close');
                const editManagerForm = document.getElementById('editManagerForm');

                // Add click handler for edit buttons
                document.querySelectorAll('.editManagerBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const managerId = this.dataset.managerId;
                        const managerName = this.dataset.managerName;
                        const managerPosition = this.dataset.managerPosition;
                        const managerEducBackground = this.dataset.managerEducbackground;
                        const managerKeySkills = this.dataset.managerKeyskills;
                        const managerLink = this.dataset.managerLink;

                        // Set form values
                        editManagerForm.action = `/members/updateManagerProfile/${managerId}`;
                        document.getElementById('edit_manager_name').value = managerName || '';
                        document.getElementById('edit_manager_position').value = managerPosition || '';
                        document.getElementById('edit_manager_educbackground').innerHTML = managerEducBackground || '';
                        document.getElementById('edit_manager_keyskills').innerHTML = managerKeySkills || '';
                        document.getElementById('edit_manager_link').value = managerLink || '';

                        // Show modal
                        editBranchManagerModal.show();
                    });
                });

                // Add click handler for close button
                if (closeModalBtn) {
                    closeModalBtn.addEventListener('click', function() {
                        editBranchManagerModal.hide();
                    });
                }

                // Add form submission handler
                if (editManagerForm) {
                    editManagerForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_edit_educbackground').value =
                            document.getElementById('edit_manager_educbackground').innerHTML.trim();
                        document.getElementById('hidden_edit_keyskills').value =
                            document.getElementById('edit_manager_keyskills').innerHTML.trim();
                    });
                }

                // Add keyboard escape handler
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        editBranchManagerModal.hide();
                    }
                });
            });

            // Show Employees function (AJAX)
            function showEmployees(managerId) {
                // Hide all employee containers first
                const allEmployeeContainers = document.querySelectorAll('[id^="employees-"]');
                allEmployeeContainers.forEach(container => {
                    container.classList.add('hidden');
                    container.innerHTML = ''; // Clear previous content
                });

                // Show the selected manager's employee container
                const selectedContainer = document.getElementById(`employees-${managerId}`);
                if (!selectedContainer) return;

                // Remove hidden class from the selected container
                selectedContainer.classList.remove('hidden');

                // Fetch and display employees for the selected manager
                fetch(`/managers/${managerId}/employees`)
                    .then(response => response.json())
                    .then(data => {
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
                                                    class="editEmployeeBtn bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-200 flex items-center"
                                                    style="background-color: #2196f3;"
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
                                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors duration-200 flex items-center"
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
                        selectedContainer.innerHTML = employeeHTML;
                    })
                    .catch(error => {
                        console.error('Error fetching employees:', error);
                        selectedContainer.innerHTML = '<p class="text-center w-full">Error loading employees. Please try again later.</p>';
                    });
            }

            // Initialize all Bootstrap modals
            document.addEventListener('DOMContentLoaded', function() {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    new bootstrap.Modal(modal, {
                        keyboard: true,
                        backdrop: 'static'
                    });
                });

                // Add form submission handlers
                const employeeForm = document.getElementById('EmployeeForm');
                if (employeeForm) {
                    employeeForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_educationback').value =
                            document.getElementById('educationback').innerHTML.trim();
                        document.getElementById('hidden_employee_keyskills').value =
                            document.getElementById('employee_keyskills').innerHTML.trim();
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const editEmployeeModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));

                // Use event delegation for dynamically added edit buttons
                document.addEventListener('click', function(event) {
                    if (event.target.closest('.editEmployeeBtn')) {
                        const button = event.target.closest('.editEmployeeBtn');
                        const employeeId = button.dataset.employeeId;
                        const employeeName = button.dataset.employeeName;
                        const employeePosition = button.dataset.employeePosition;
                        const employeeEducBackground = button.dataset.employeeEducbackground;
                        const employeeKeySkills = button.dataset.employeeKeyskills;
                        const employeeLink = button.dataset.employeeLink;

                        // Set form action and values
                        const editForm = document.getElementById('editEmployeeForm');
                        editForm.action = `/employees/update/${employeeId}`;

                        document.getElementById('edit_name').value = employeeName || '';
                        document.getElementById('edit_position').value = employeePosition || '';
                        document.getElementById('edit_educationback').innerHTML = employeeEducBackground || '';
                        document.getElementById('edit_keyskills').innerHTML = employeeKeySkills || '';
                        document.getElementById('edit_link').value = employeeLink || '';

                        // Show modal
                        editEmployeeModal.show();
                    }
                });

                // Add form submission handler for employee edit form
                const editEmployeeForm = document.getElementById('editEmployeeForm');
                if (editEmployeeForm) {
                    editEmployeeForm.addEventListener('submit', function(e) {
                        document.getElementById('hidden_edit_educationback').value =
                            document.getElementById('edit_educationback').innerHTML.trim();
                        document.getElementById('hidden_edit_keyskills').value =
                            document.getElementById('edit_keyskills').innerHTML.trim();
                    });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
    // Initialize edit manager modal
    const editBranchManagerModal = new bootstrap.Modal(document.getElementById('editBranchManagerModal'));

    // Handle edit manager button clicks
    document.querySelectorAll('.editManagerBtn').forEach(button => {
        button.addEventListener('click', function() {
            const managerId = this.getAttribute('data-manager-id');

            // Set the form action URL
            document.getElementById('editManagerForm').action = `/members/updateManagerProfile/${managerId}`;

            // Set form values
            document.getElementById('edit_manager_name').value = this.getAttribute('data-manager-name');
            document.getElementById('edit_manager_position').value = this.getAttribute('data-manager-position');
            document.getElementById('edit_manager_educbackground').innerHTML = this.getAttribute('data-manager-educbackground');
            document.getElementById('edit_manager_keyskills').innerHTML = this.getAttribute('data-manager-keyskills');
            document.getElementById('edit_manager_link').value = this.getAttribute('data-manager-link');

            // Show the modal
            editBranchManagerModal.show();
        });
    });
});
        </script>
@endsection
