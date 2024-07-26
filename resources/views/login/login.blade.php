@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
                
            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
                <form action="/login" method="post">
                    @csrf
                <div class="form-floating">
                    <input name="username" class="form-control @error('username') is-invalid @enderror" id="username" autofocus required value="{{ old('username') }}">
                    <label for="username" class="text-dark">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password" class="text-dark">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-secondary" type="submit">Login</button>
                </form>
            </main>
        </div>
    </div>
</div>
@endsection