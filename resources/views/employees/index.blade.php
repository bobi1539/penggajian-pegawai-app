@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pegawai</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/employees/create" class="btn btn-sm btn-outline-secondary" >
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('messageSuccess'))
                <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover" id="table-employees">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">NIP</th>
                            <th scope="col" class="text-center">Nama Pegawai</th>
                            <th scope="col" class="text-center">Golongan</th>
                            <th scope="col" class="text-center">Jabatan</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Jumlah Anak</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $employee->id_number }}</td>
                                <td>{{ $employee->name }}</td>
                                <td class="text-center">{{ $employee->group->job_class }}</td>
                                <td class="text-center">{{ $employee->position->grade }}</td>
                                <td class="text-center">{{ $employee->status }}</td>
                                <td class="text-center">{{ $employee->number_of_children }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailModalEmployee">
                                        <span data-feather="eye"></span>
                                    </a>

                                    <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#updateModalEmployee">
                                        <span data-feather="edit-2"></span>
                                    </a>

                                    <form action="/employees/{{ $employee->id }}" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-outline-secondary"
                                            onclick="return confirm('Yakin data ingin dihapus?')">
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
@endsection
