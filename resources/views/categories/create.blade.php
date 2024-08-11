@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h1 class="text-primary fw-bold">{{ isset($category) ? 'Edit' : 'Add' }} Category</h1>
                <p class="text-muted">{{ isset($category) ? 'Modify the category details' : 'Create a new category' }}</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-5">
                    <form method="POST" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-lg rounded-pill shadow-sm" value="{{ old('name', $category->name ?? '') }}" required placeholder="Enter category name">
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left-circle me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="bi bi-save me-2"></i>{{ isset($category) ? 'Update' : 'Add' }} Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
