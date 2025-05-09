@extends('admin.inquiry')

@section('content')
    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table id="contact_us" class="table table-striped table-bordered" style="width:100%;-webkit-scrollbar: 0.8pv">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Profile Picture</th>
                    <th>Type of Inquiry</th>
                    <th>Type of Job</th>
                    <th>Recruiter</th>
                    <th>Manager Name</th>
                    <th>Branch</th>
                    <th>Hear From Us</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inquiries as $contactUs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($contactUs->profile_picture)
                                <img src="{{ asset('storage/' . $contactUs->profile_picture) }}" alt="Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            @else
                                <img src="https://via.placeholder.com/50" alt="Default Profile Picture"
                                    style="height: 50px; width: 50px; border-radius: 50%;">
                            @endif
                        </td>
                        <td>{{ $contactUs->inquiry_type }}</td>
                        <td>{{ $contactUs->job_type }}</td>
                        <td>{{ $contactUs->specify_manager }}</td>
                        <td>{{ $contactUs->manager_name }}</td>
                        <td>{{ $contactUs->branch ? $contactUs->branch : $contactUs->specify_branch }}</td>
                        <td>{{ $contactUs->hear_from_us }}</td>
                        <td>{{ $contactUs->name }}</td>
                        <td>{{ $contactUs->email }}</td>
                        <td>{{ $contactUs->phone }}</td>
                        <td>{{ $contactUs->message }}</td>
                        <td>
                            <div class="btn-group-flex">
                                <form action="{{ route('contact_us.accept', ['contactUs' => $contactUs->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-accept">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>

                                <form action="{{ route('contact_us.decline', ['contactUs' => $contactUs->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-decline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>

                                <a href="{{ route('inquiries.edit', $contactUs->id) }}" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        $(document).ready(function() {
            $('#contact_us').DataTable({
                responsive: true
            });
        });
    </script>
@endsection

<style>
.btn-group-flex {
    display: flex;
    justify-content: flex-start;
    gap: 10px;
    margin-top: 10px;
}

.btn-group-flex button,
.btn-edit {
    padding: 10px;
    cursor: pointer;
    text-decoration: none;
    border-radius: 5px;
    font-size: 18px;
    display: flex;
    height: 41px;
    align-items: center;
}

.btn-accept {
    background-color: #04AA6D;
    border: 1px solid green;
    color: white;
}

.btn-decline {
    background-color: #b41308;
    border: 1px solid red;
    color: white;
}

.btn-edit {
    background-color: #007BFF;
    border: 1px solid #003063;
    color: white;
}

.btn-accept:hover {
    background-color: #3e8e41;
}

.btn-decline:hover {
    background-color: #d32f2f;
}

.btn-edit:hover {
    background-color: #0056b3;
}
</style>
