@extends('admin.editNews')

@section('content')
    @include('components.embeded')

    <a href="{{ route('triumphs.create') }}" class="btn btn-primary mb-3">Add Triumphs</a><br><br>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="news-list">
        @foreach ($triumphs as $item)
            <div class="news-item">
                <div class="embed-code">
                    {!! $item->embed_code !!}
                </div>

                <div class="actions">
                    <a href="{{ route('triumphs.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('triumphs.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
