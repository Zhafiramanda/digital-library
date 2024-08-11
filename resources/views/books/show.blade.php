@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary fw-bold display-4">{{ $book->title }}</h1>
    
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <img src="{{ Storage::url($book->cover_image) }}" class="card-img-top" alt="{{ $book->title }}" style="height: 500px; object-fit: cover;">
                <div class="card-body p-5">
                    <h5 class="card-title text-primary fw-bold fs-3 mb-4">{{ $book->title }}</h5>
                    <p class="card-text text-muted fs-5">{{ $book->description }}</p>
                    <p class="mb-2"><strong>Category:</strong> <span class="badge bg-primary">{{ $book->category->name }}</span></p>
                    <p class="mb-4"><strong>Quantity:</strong> <span class="badge bg-success">{{ $book->quantity }}</span></p>
                    <p class="mb-4"><strong>Book File:</strong>
                        @if($book->book_file)
                            <a href="{{ Storage::url($book->book_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill ms-2"><i class="bi bi-file-earmark-pdf"></i> Download PDF</a>
                        @else
                            <span class="text-muted">No PDF available</span>
                        @endif
                    </p>
                    <div class="d-flex justify-content-start mt-4">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning rounded-pill me-2 px-4"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill px-4"><i class="bi bi-trash me-2"></i>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('books.index') }}" class="btn btn-secondary mt-4 rounded-pill px-4"><i class="bi bi-arrow-left-circle me-2"></i>Back to Books</a>
        </div>
    </div>
</div>
@endsection
