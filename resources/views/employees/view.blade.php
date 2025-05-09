@extends('admin.dashboard')

@section('content')
    <div class="container mt-4">
        <h1>Employee List</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Age</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>
                            @if ($employee->profile_picture)
                                <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            @else
                                <img src="https://via.placeholder.com/50" alt="Default Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->middle_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->sex }}</td>
                        <td>{{ $employee->age }}</td>
                        <td>{{ $employee->phone_number }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">Update</a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('employees.create') }}" class="btn btn-success">Add New Employee</a>
    </div>
@endsection

<div class="card">
    <br>

    <strong>
        &nbsp;&nbsp;&nbsp;&nbsp;
        {{record.last_name|upper}},&nbsp;&nbsp;
        {{record.first_name|upper}}
        <hr>    
    </strong>

    <div class="card-body">
        <p><strong> ID: </strong> {{record.id}}</p>
        <p><strong> EMAIL: </strong> {{record.email}}</p>
        <p><strong> PHONE: </strong> {{record.phone}}</p>
        <p><strong> ADDRESS: </strong> {{record.address}}</p>
        <p><strong> PROVINCE: </strong> {{record.province}}</p>
        <p><strong> CITY: </strong> {{record.city}}</p>
        <p><strong> COUNTRY: </strong> {{record.country}}</p>
        <p><strong> DATE JOINED: </strong> {{record.creation_date}}</p>
    </div>
</div>