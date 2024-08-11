@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center text-primary fw-bold mb-5">
        Welcome, {{ Auth::user()->name }}
    </h1>

    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card text-center shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="mb-3">
                        <i class="bi bi-book-half display-4 text-primary"></i>
                    </div>
                    <h5 class="card-title text-secondary fw-bold">My Books</h5>
                    <p class="card-text text-muted">View and manage your collection of books.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary rounded-pill shadow-sm px-4">View My Books</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
