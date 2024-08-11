@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-5 text-center text-primary fw-bold">Manage Categories</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-secondary">Category List</h5>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-success rounded-pill shadow-sm px-4">
                <i class="bi bi-plus-circle me-2"></i>Add New Category
            </a>
        </div>
    </div>

    @if($categories->count())
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-header bg-gradient bg-primary text-white text-center fw-bold p-3">
                <i class="bi bi-list-ul me-2"></i>Available Categories
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="fw-semibold">Category Name</th>
                            <th scope="col" class="fw-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr class="bg-white">
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm rounded-pill me-2 px-3 shadow-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm" title="Delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center shadow-sm mt-4 rounded-3">
            <i class="bi bi-info-circle me-2"></i>No categories available. Please add a new category to get started.
        </div>
    @endif
</div>
@endsection
