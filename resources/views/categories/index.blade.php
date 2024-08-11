@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center text-primary fw-bold">Categories</h1>

    <div class="mb-4 text-end">
        <a href="{{ route('categories.create') }}" class="btn btn-success rounded-pill shadow-sm">
            <i class="bi bi-plus-circle me-2"></i>Add New Category
        </a>
    </div>

    @if($categories->count())
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center fw-bold rounded-top">
                <i class="bi bi-list-ul me-2"></i>Category List
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" class="text-center">Name</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-center fw-semibold">{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-outline-warning btn-sm rounded-pill me-2" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill" title="Delete">
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
            <i class="bi bi-info-circle me-2"></i>No categories available.
        </div>
    @endif
</div>
@endsection
