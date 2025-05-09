@extends('admin.editNews')

@section('content')
    @include('components.embeded')
    <h1>Edit Triumphs</h1>
    <form action="{{ route('triumphs.update', $triumph->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="iframe">Embed Code</label>
            <textarea name="iframe" id="iframe" class="form-control" required>{{ old('iframe', $triumph->embed_code) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
@endsection
