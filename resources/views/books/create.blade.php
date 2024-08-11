@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-5 text-center text-primary fw-bold">{{ isset($book) ? 'Edit' : 'Add' }} Book</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <form method="POST" action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($book))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="title" class="form-label text-muted fw-semibold">Book Title</label>
                            <input type="text" name="title" id="title" class="form-control shadow-sm border-0 rounded-3" value="{{ old('title', $book->title ?? '') }}" required placeholder="Enter book title">
                        </div>

                        <div class="mb-4">
                            <label for="category" class="form-label text-muted fw-semibold">Category</label>
                            <select name="category_id" id="category" class="form-select shadow-sm border-0 rounded-3" required>
                                <option value="" disabled selected>Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id') ?? $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label text-muted fw-semibold">Description</label>
                            <textarea name="description" id="description" class="form-control shadow-sm border-0 rounded-3" rows="5" placeholder="Enter book description">{{ old('description', $book->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="quantity" class="form-label text-muted fw-semibold">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control shadow-sm border-0 rounded-3" value="{{ old('quantity', $book->quantity ?? '') }}" required placeholder="Enter quantity">
                        </div>

                        <div class="mb-4">
                            <label for="book_file" class="form-label text-muted fw-semibold">Book File (PDF)</label>
                            <input type="file" name="book_file" id="book_file" class="form-control shadow-sm border-0 rounded-3" {{ isset($book) ? '' : 'required' }}>
                            @if(isset($book) && $book->book_file)
                                <small class="text-muted d-block mt-2">Current file: <a href="{{ Storage::url($book->book_file) }}" target="_blank">{{ basename($book->book_file) }}</a></small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="form-label text-muted fw-semibold">Cover Image (jpeg/jpg/png)</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control shadow-sm border-0 rounded-3" {{ isset($book) ? '' : 'required' }}>
                            @if(isset($book) && $book->cover_image)
                                <small class="text-muted d-block mt-2">Current image:</small>
                                <img src="{{ Storage::url($book->cover_image) }}" alt="{{ $book->title }}" class="img-thumbnail mt-2" width="150">
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg shadow-lg rounded-pill">
                                {{ isset($book) ? 'Update Book' : 'Add Book' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <a href="{{ route('books.index') }}" class="btn btn-outline-primary mt-4 rounded-pill shadow-sm d-block text-center py-2">
                <i class="bi bi-arrow-left-circle me-2"></i>Back to Books
            </a>
        </div>
    </div>
</div>

@endsection
