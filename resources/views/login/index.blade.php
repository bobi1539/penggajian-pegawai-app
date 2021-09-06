@extends('layouts.main')

@section('container')
    <div class="bg-light">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-lg-5">
                    <h3 class="text-center mb-3">Aplikasi Penggajian Pegawai</h3>
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h4 class="text-center">Login</h4>
                        </div>
                        <div class="card-body">
                            @if (session()->has('messageError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('messageError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="/login" method="POST" autocomplete="on">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="name@example.com" required value="{{ @old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" required>
                                </div>
                                <button class="btn btn-dark col-12">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
