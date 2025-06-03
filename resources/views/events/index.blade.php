@extends('admin.editNews')

@section('content')
    @include('components.embeded')

    <!-- Add required CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Add Event Button -->
    <button id="openEventModal" class="btn btn-primary d-flex align-items-center mb-3"
        style="background-color: #2196f3; border: none;">
        <i class="fas fa-plus me-2"></i> Add Event
    </button>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="eventModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header" style="background-color: rgb(212, 6, 16); color: #fff;">
                    <h5 class="modal-title w-100 text-center" id="eventModalLabel">Add New Event</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="iframe" class="form-label">Embed Code</label>
                            <textarea
                                name="iframe"
                                id="iframe"
                                class="form-control"
                                rows="6"
                                required
                                style="background: #f8f9fa; border-radius: 0.375rem; min-height: 80px; overflow-y: auto;">{{ old('iframe') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger px-4" style="background-color: rgb(212, 6, 16);">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editEventModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header" style="background-color: rgb(212, 6, 16); color: #fff;">
                    <h5 class="modal-title w-100 text-center" id="editEventModalLabel">Edit Event</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editEventForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editIframe" class="form-label">Embed Code</label>
                            <textarea
                                name="iframe"
                                id="editIframe"
                                class="form-control"
                                rows="6"
                                required
                                style="background: #f8f9fa; border-radius: 0.375rem; min-height: 80px; overflow-y: auto;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-danger px-4" style="background-color: rgb(212, 6, 16);">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Events List -->
    <div class="row g-4">
        @foreach($events as $item)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="iframe-container mb-3">
                            {!! $item->embed_code !!}
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-primary btn-sm edit-event"
                                    data-id="{{ $item->id }}"
                                    data-iframe="{{ $item->embed_code }}">
                                <i class="fas fa-edit me-1"></i> Edit
                            </button>
                            <form action="{{ route('events.destroy', $item->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Required JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize modals
        const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
        const editEventModal = new bootstrap.Modal(document.getElementById('editEventModal'));

        // Add Event Modal
        const openEventModalBtn = document.getElementById('openEventModal');
        if (openEventModalBtn) {
            openEventModalBtn.addEventListener('click', function() {
                eventModal.show();
            });
        }

        // Edit Event Modal
        document.querySelectorAll('.edit-event').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const iframe = this.dataset.iframe;

                document.getElementById('editIframe').value = iframe;
                document.getElementById('editEventForm').action = `/events/${id}`;

                editEventModal.show();
            });
        });

        // Delete Confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this event?')) {
                    this.submit();
                }
            });
        });
    });
    </script>

    <style>
    .modal-content {
        border: none;
        border-radius: 0.5rem;
    }

    .modal-header {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .form-control {
        border: 1px solid #ced4da;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        scrollbar-width: thin;
        scrollbar-color: #ec2a2a #f5f5f5;
    }

    .iframe-container {
        position: relative;
        overflow: hidden;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
    }

    .iframe-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-primary {
        background-color: #2196f3;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1976d2;
    }

    .btn-danger {
        background-color: rgb(212, 6, 16);
        border: none;
    }

    .btn-danger:hover {
        background-color: rgb(180, 4, 12);
    }
    </style>
@endsection
