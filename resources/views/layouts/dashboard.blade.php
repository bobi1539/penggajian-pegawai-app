@extends('layouts.main')

@section('container')
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">

            @include('layouts.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                @yield('container-dashboard')

            </main>
        </div>
    </div>
@endsection
