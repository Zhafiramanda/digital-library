@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center text-primary fw-bold">Edit Book</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" id="title" class="form-control border-0 shadow-sm rounded-3" value="{{ old('title', $book->title) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label fw-semibold">Category</label>
                            <select name="category_id" id="category" class="form-select border-0 shadow-sm rounded-3" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control border-0 shadow-sm rounded-3" style="height: 150px;" required>{{ old('description', $book->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-semibold">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control border-0 shadow-sm rounded-3" value="{{ old('quantity', $book->quantity) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="book_file" class="form-label fw-semibold">Book File (PDF)</label>
                            <input type="file" name="book_file" id="book_file" class="form-control border-0 shadow-sm rounded-3">
                            @if($book->book_file)
                                <small class="text-muted d-block mt-2">Current file: <a href="{{ Storage::url($book->book_file) }}" target="_blank">{{ basename($book->book_file) }}</a></small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="form-label fw-semibold">Cover Image (jpeg/jpg/png)</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control border-0 shadow-sm rounded-3">
                            @if($book->cover_image)
                                <small class="text-muted d-block mt-2">Current image: <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="img-thumbnail mt-2" width="100"></small>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm rounded-3">Update Book</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('books.index') }}" class="btn btn-secondary mt-4 rounded-3 shadow-sm">Back to Books</a>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
    .form-control, .form-select {
        background-color: #f8f9fa;
    }
    .card {
        background-color: #ffffff;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
@endsection
