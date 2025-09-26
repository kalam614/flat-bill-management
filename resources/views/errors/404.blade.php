@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="text-center">
            <h1 class="display-1 fw-bold text-danger">404</h1>
            <h4 class="mb-3"><i class="fas fa-exclamation-triangle me-2 text-warning"></i> Oops! Page not found</h4>
            <p class="text-muted mb-4">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-custom">
                <i class="fas fa-home me-2"></i> Back to Dashboard
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary ms-2">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </a>
        </div>
    </div>
@endsection
