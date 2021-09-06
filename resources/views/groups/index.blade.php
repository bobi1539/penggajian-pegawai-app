@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Golongan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('messageSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('messageSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Golongan</th>
                            <th scope="col" class="text-center">Gaji Pokok</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $group->job_class }}</td>
                                <td class="text-end">
                                    Rp. {{ number_format($group->basic_salary, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-sm btn-outline-secondary">
                                        <span data-feather="edit-2"></span>
                                    </a>

                                    <form action="/groups/{{ $group->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-secondary"
                                            onclick="return confirm('Yakin ingin menghapus data?')">
                                            <span data-feather="trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Data-->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Golongan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
