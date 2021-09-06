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
            @error('basic_salary')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @error('job_class')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
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
                <form action="/groups" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="job_class" class="form-label">Golongan</label>
                            <input name="job_class" type="text" class="form-control" id="job_class"
                                value="{{ old('job_class') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="basic_salary" class="form-label">Gaji Pokok</label>
                            <input name="basic_salary" type="text" class="form-control" id="basic_salary"
                                value="{{ old('basic_salary') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const basicSalary = document.getElementById('basic_salary');

        basicSalary.addEventListener('keyup', function() {
            let val = this.value;
            val = val.replace(/[^0-9\.]/g, '');

            if (val != "") {
                valArr = val.split('.');
                valArr[0] = (parseInt(valArr[0], 10)).toLocaleString();
                val = valArr.join('.');
            }

            this.value = val;
        });
    </script>
@endsection
