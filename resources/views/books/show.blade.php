@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="text-center">
                <h1 class="display-4 text-primary fw-bold">{{ $book->title }}</h1>
                <p class="text-muted fs-5">{{ $book->author }}</p>
            </div>
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden my-4">
                <div class="row no-gutters">
                    <div class="col-md-6">
                        <img src="{{ Storage::url($book->cover_image) }}" class="img-fluid h-100 w-100 object-fit-cover" alt="{{ $book->title }}">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary fw-bold fs-3">{{ $book->title }}</h5>
                            <p class="card-text text-muted fs-5">{{ $book->description }}</p>
                            <p class="mb-2"><strong>Category:</strong> <span class="badge bg-primary">{{ $book->category->name }}</span></p>
                            <p class="mb-2"><strong>Quantity:</strong> <span class="badge bg-success">{{ $book->quantity }}</span></p>
                            <p class="mb-4"><strong>Book File:</strong>
                                @if($book->book_file)
                                    <a href="{{ Storage::url($book->book_file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill"><i class="bi bi-file-earmark-pdf"></i> Download PDF</a>
                                @else
                                    <span class="text-muted">No PDF available</span>
                                @endif
                            </p>
                            <div class="d-flex">
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning rounded-pill me-2 px-4"><i class="bi bi-pencil-square me-2"></i>Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4"><i class="bi bi-trash me-2"></i>Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('books.index') }}" class="btn btn-secondary mt-4 rounded-pill px-4"><i class="bi bi-arrow-left-circle me-2"></i>Back to Books</a>
            </div>
        </div>
    </div>
</div>
@endsection
