@extends('admin.editNews')

@section('content')
    @include('components.embeded')

    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add News</a><br><br>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="news-list">
        @foreach ($news as $item)
            <div class="news-item">
                <div class="embed-code">
                    {!! $item->embed_code !!}
                </div>

                <div class="actions">
                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
