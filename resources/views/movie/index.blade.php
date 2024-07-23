@extends('layouts.main')
@section('content')
@if (session()->has('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <i class="bi bi-star me-1"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<h1>Movie Management</h1>
@endsection
