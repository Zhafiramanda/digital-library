@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-5 text-center text-primary fw-bold">Edit Book</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    <i class="bi bi-pencil-square me-2"></i>Edit Book Details
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-4">
                            <input type="text" name="title" id="title" class="form-control shadow-sm rounded-3" value="{{ old('title', $book->title) }}" placeholder="Title" required>
                            <label for="title" class="form-label">Title</label>
                        </div>

                        <div class="form-floating mb-4">
                            <select name="category_id" id="category" class="form-select shadow-sm rounded-3" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="category" class="form-label">Category</label>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea name="description" id="description" class="form-control shadow-sm rounded-3" placeholder="Description" style="height: 150px;" required>{{ old('description', $book->description) }}</textarea>
                            <label for="description" class="form-label">Description</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="number" name="quantity" id="quantity" class="form-control shadow-sm rounded-3" value="{{ old('quantity', $book->quantity) }}" placeholder="Quantity" required>
                            <label for="quantity" class="form-label">Quantity</label>
                        </div>

                        <div class="mb-4">
                            <label for="book_file" class="form-label fw-semibold">Book File (PDF)</label>
                            <input type="file" name="book_file" id="book_file" class="form-control shadow-sm rounded-3">
                            @if($book->book_file)
                                <small class="text-muted d-block mt-2">Current file: <a href="{{ Storage::url($book->book_file) }}" target="_blank">{{ basename($book->book_file) }}</a></small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="form-label fw-semibold">Cover Image (jpeg/jpg/png)</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control shadow-sm rounded-3">
                            @if($book->cover_image)
                                <small class="text-muted d-block mt-2">Current image: <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="img-thumbnail mt-2" width="100"></small>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm rounded-pill">Update Book</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('books.index') }}" class="btn btn-secondary rounded-pill shadow-sm">Back to Books</a>
            </div>
        </div>
    </div>
</div>
@endsection
