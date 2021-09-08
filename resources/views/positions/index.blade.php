@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Jabatan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                    data-bs-target="#createModalPosition">
                    <span data-feather="plus-square"></span> Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            @if (session()->has('messageSuccess'))
                <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
            @endif
            @error('grade')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @enderror
            @error('positional_allowance')
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
                            <th scope="col" class="text-center">Jabatan</th>
                            <th scope="col" class="text-center">Tunjangan Jabatan</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($positions as $position)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $position->grade }}</td>
                                <td class="text-end">
                                    Rp. {{ number_format($position->positional_allowance, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#updateModalPosition"
                                        onclick="handleEditButton({{ $position->id }})">
                                        <span data-feather="edit-2"></span>
                                    </a>

                                    <form action="/positions/{{ $position->id }}" method="POST" class="d-inline">
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
    <!-- Modal Tambah Data-->
    <div class="modal fade" id="createModalPosition" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/positions" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="grade" class="form-label">Jabatan</label>
                            <input name="grade" type="text" class="form-control" id="grade" value="{{ old('grade') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="positional_allowance" class="form-label">Tunjangan Jabatan</label>
                            <input name="positional_allowance" type="text" class="form-control" id="positional_allowance"
                                value="{{ old('positional_allowance') }}" required>
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

    <!-- Modal Tambah Data-->
    <div class="modal fade" id="updateModalPosition" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Data Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/positions" method="POST" id="form-update-position">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="grade" class="form-label">Jabatan</label>
                            <input name="grade" type="text" class="form-control" id="grade_update"
                                value="{{ old('grade') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="positional_allowance" class="form-label">Gaji Pokok</label>
                            <input name="positional_allowance" type="text" class="form-control"
                                id="positional_allowance_update" value="{{ old('positional_allowance') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // number format create data
        const positionalAllowance = document.getElementById('positional_allowance');

        positionalAllowance.addEventListener('keyup', function() {
            numberFormatThousands(positionalAllowance);
        });
        // end-------------

        // get upate data--------------------
        const gradeUpdate = document.getElementById('grade_update');
        const positionalAllowanceUpdate = document.getElementById('positional_allowance_update');
        const formUpdatePosition = document.getElementById('form-update-position');


        function handleEditButton(id) {
            fetch('/positions/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    gradeUpdate.value = data.position.grade,
                        positionalAllowanceUpdate.value = data.position.positional_allowance
                });

            // mengganti action form update
            formUpdatePosition.action = "/positions/" + id;
        }

        positionalAllowanceUpdate.addEventListener('keyup', function() {
            numberFormatThousands(positionalAllowanceUpdate);
        })
    </script>
@endsection
