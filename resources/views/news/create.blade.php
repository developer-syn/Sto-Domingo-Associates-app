<!-- resources/views/news/form.blade.php -->

@extends('admin.editNews')

@section('content')
    @include('components.embeded')
    <h1>Create News</h1>
    <form action="{{ route('news.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="iframe">Embed Code</label>
            <textarea name="iframe" id="iframe" class="form-control" required>{{ old('iframe') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
    </form>
@endsection
