@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Pegawai</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/employees" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="arrow-left"></span> Kembali
                </a>
            </div>
        </div>
    </div>
    @error('id_number')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    <form action="/employees" method="POST" class="mb-5" onsubmit="return handleSubmit()">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-6">
                @if (session()->has('messageSuccess'))
                    <div id="flash-data-success" data-flashdata="{{ session('messageSuccess') }}"></div>
                @endif

                <div class="mb-2">
                    <label for="id_number" class="form-label">NIP</label>
                    <input name="id_number" type="text" class="form-control" id="id_number"
                        value="{{ old('id_number') }}" required>
                </div>
                <div class="mb-2">
                    <label for="name" class="form-label">Nama Pegawai</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-2">
                    <label for="group_id" class="form-label">Golongan</label>
                    <select name="group_id" class="form-select" id="group_id" onchange="handleBasicSalary()">
                        <option value="choose" selected>--Pilih--</option>
                        @foreach ($groups as $group)
                            @if (old('group_id') == $group->id)
                                <option value="{{ $group->id }}" selected>{{ $group->job_class }}</option>
                            @else
                                <option value="{{ $group->id }}">{{ $group->job_class }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="basic_salary" class="form-label">Gaji Pokok</label>
                    <input name="basic_salary" type="text" class="form-control" id="basic_salary"
                        value="{{ old('basic_salary') }}" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-2">
                    <label for="position_id" class="form-label">Jabatan</label>
                    <select name="position_id" class="form-select" id="position_id" onchange="handlePosition()">
                        <option value="choose" selected>--Pilih--</option>
                        @foreach ($positions as $position)
                            @if (old('position_id') == $position->id)
                                <option value="{{ $position->id }}" selected>{{ $position->grade }}</option>
                            @else
                                <option value="{{ $position->id }}">{{ $position->grade }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="positional_allowance" class="form-label">Tunjangan Jabatan</label>
                    <input type="text" class="form-control" name="positional_allowance" id="positional_allowance"
                        value="{{ old('positional_allowance') }}" readonly>
                </div>
                <div class="mb-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option value="choose" selected>--Pilih--</option>
                        @if (old('status') == 'Menikah')
                            <option value="Menikah" selected>Menikah</option>
                            <option value="Tidak Menikah">Tidak Menikah</option>
                        @elseif(old('status') == 'Tidak Menikah')
                            <option value="Menikah">Menikah</option>
                            <option value="Tidak Menikah" selected>Tidak Menikah</option>
                        @else
                            <option value="Menikah">Menikah</option>
                            <option value="Tidak Menikah">Tidak Menikah</option>
                        @endif
                    </select>
                </div>
                <div class="mb-2">
                    <label for="number_of_children" class="form-label">Jumlah Anak</label>
                    <input name="number_of_children" type="number" class="form-control" id="number_of_children"
                        value="{{ old('number_of_children') }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-dark float-end mt-2">Simpan</button>
            </div>
        </div>
    </form>

    <script>
        function handleBasicSalary() {
            const groupId = document.querySelector('#group_id').value;
            const basicSalary = document.querySelector('#basic_salary');

            if (groupId === 'choose') {
                basicSalary.value = '';
            } else {
                fetch('/groups/' + groupId + '/edit')
                    .then(response => response.json())
                    .then(data => {
                        basicSalary.value = data.group.basic_salary,
                            numberFormatThousands(basicSalary);
                    });

            }
        }

        function handlePosition() {
            const positionId = document.querySelector('#position_id').value;
            const positionalAllowance = document.getElementById('positional_allowance');

            if (positionId === 'choose') {
                positionalAllowance.value = '';
            } else {
                fetch('/positions/' + positionId + '/edit')
                    .then(response => response.json())
                    .then(data => {
                        positionalAllowance.value = data.position.positional_allowance,
                            numberFormatThousands(positionalAllowance);
                    });
            }
        }

        function handleSubmit() {
            const groupId = document.querySelector('#group_id').value;
            const positionId = document.querySelector('#position_id').value;
            const status = document.querySelector('#status').value;

            if (groupId === 'choose') {
                getAlertWarning('Silahkan pilih golongan');
                return false;
            } else if (positionId === 'choose') {
                getAlertWarning('Silahkan pilih jabatan');
                return false
            } else if (status === 'choose') {
                getAlertWarning('Silahkan pilih status');
                return false
            }
            return true;
        }
    </script>
@endsection
