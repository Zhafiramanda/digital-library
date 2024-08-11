@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white text-center py-4" style="background: linear-gradient(45deg, #4e73df, #1cc88a);">
                    <h3 class="fw-bold mb-0">Admin Dashboard</h3>
                </div>
                <div class="card-body p-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-book-half me-2 text-primary" style="font-size: 1.5rem;"></i>
                                <span class="fw-bold">Manage Books</span>
                            </span>
                            <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm fw-bold" style="transition: all 0.3s;">
                                Go
                            </a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-tags me-2 text-success" style="font-size: 1.5rem;"></i>
                                <span class="fw-bold">Manage Categories</span>
                            </span>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-success btn-sm fw-bold" style="transition: all 0.3s;">
                                Go
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
