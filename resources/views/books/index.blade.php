@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center text-primary fw-bold">Books Collection</h1>
    
    <form method="GET" action="{{ route('books.index') }}" class="mb-5">
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <label for="category" class="form-label">Filter by Category</label>
                <select name="category_id" id="category" class="form-select shadow-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100 shadow-sm">Apply Filter</button>
            </div>
        </div>
    </form>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="text-muted">
            Showing {{ $books->count() }} books
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-success">+ Add New Book</a>
    </div>

    @if($books->count())
        <div class="row g-4">
            @foreach($books as $book)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="image-container" style="height: 220px;">
                            <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="card-img-top" style="height: 100%; width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($book->description, 80) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning btn-sm">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($books instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-5">
                {{ $books->links('pagination::bootstrap-5') }}
            </div>
        @endif
    @else
        <div class="alert alert-info mt-4 text-center">
            No books available.
        </div>
    @endif
</div>
@endsection
