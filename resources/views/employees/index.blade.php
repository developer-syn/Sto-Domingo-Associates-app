@extends('admin.dashboard')

@section('content')
    <div style="overflow-x: auto;">
        <table id="employeeTable" class="table table-striped table-bordered" style="width:100%;-webkit-scrollbar: 0.8pv">
            <thead>
                <tr>
                    <th>#</th>
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
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm"
                                style="color: green;font-weight:bold">Update</a>
                        </td>
                        <td>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    style="color:red;font-weight:bolder">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- DataTables JS and CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function() {
            $('#employeeTable').DataTable({
                responsive: true
            });
        });
    </script>
@endsection
