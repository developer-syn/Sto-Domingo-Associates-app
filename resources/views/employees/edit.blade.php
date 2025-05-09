@extends('admin.dashboard')

@section('content')
    @include('components.employee-form')
    <div class="employee-form-section container">
        <h1>{{ isset($employee) ? 'Edit Employee' : 'Add New Employee' }}</h1>

        <!-- Form for adding/editing employee -->
        <form method="POST"
            action="{{ isset($employee) ? route('employees.edit', $employee->id) : route('employees.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if (isset($employee))
                @method('PUT')
            @endif

            <!-- Grid Layout for Form -->
            <div class="form-grid">
                <!-- First Name -->
                <div class="form-item">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"
                        value="{{ old('first_name', $employee->first_name ?? '') }}" required>
                </div>

                <!-- Middle Name -->
                <div class="form-item">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control"
                        value="{{ old('middle_name', $employee->middle_name ?? '') }}">
                </div>

                <!-- Last Name -->
                <div class="form-item">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"
                        value="{{ old('last_name', $employee->last_name ?? '') }}" required>
                </div>

                <!-- Email -->
                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                        value="{{ old('email', $employee->email ?? '') }}" required>
                </div>

                {{-- <!-- Sex -->
                <div class="form-item">
                    <label for="sex">Sex</label>
                    <input type="text" id="sex" name="sex" class="form-control" value="{{ old('sex', $employee->sex ?? '') }}" required>
                </div> --}}
                <!-- Sex -->
                <div class="form-item">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex" class="form-control" required>
                        <option value="">-- Select Sex --</option>
                        <option value="Male" {{ old('sex', $employee->sex ?? '') == 'Male' ? 'selected' : '' }}>Male
                        </option>
                        <option value="Female" {{ old('sex', $employee->sex ?? '') == 'Female' ? 'selected' : '' }}>Female
                        </option>
                    </select>
                </div>


                <!-- Phone Number -->
                <div class="form-item">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                        value="{{ old('phone_number', $employee->phone_number ?? '') }}" required minlength="99999999999"
                        maxlength="11">
                </div>

                <!-- Age -->
                <div class="form-item">
                    <label for="age">Age</label>
                    <input type="number" id="age" name="age" class="form-control"
                        value="{{ old('age', $employee->age ?? '') }}" required minlength="2" maxlength="2">
                </div>

                <!-- Position -->
                <div class="form-item">
                    <label for="position">Position</label>
                    <input type="text" id="position" name="position" class="form-control"
                        value="{{ old('position', $employee->position ?? '') }}" required>
                </div>

                <!-- Address -->
                <div class="form-item">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control" required>{{ old('address', $employee->address ?? '') }}</textarea>
                </div>
            </div>

            <!-- Profile Picture & Submit Button -->
            <div class="form-footer">
                <div>
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-control">
                    @if (isset($employee) && $employee->profile_picture)
                        <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture"
                            style="width:100px; height:100px; margin-top: 10px;">
                    @endif
                </div>
                <button type="submit" class="btn-submit">
                    {{ isset($employee) ? 'Update Employee' : 'Add Employee' }}
                </button>
            </div>
        </form>
    </div>
@endsection
