@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Pegawai</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/employees" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="plus-square"></span> Kembali
                </a>
            </div>
        </div>
    </div>
    <form action="/employees" method="POST" class="mb-5">
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
                    <select name="group_id" class="form-select" id="group_id">
                        <option value="choose" selected>--Pilih--</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->job_class }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="basic_salary" class="form-label">Gaji Pokok</label>
                    <input type="text" class="form-control" id="basic_salary" value="" readonly>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-2">
                    <label for="position_id" class="form-label">Jabatan</label>
                    <select name="position_id" class="form-select" id="position_id">
                        <option value="choose" selected>--Pilih--</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->grade }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label for="positional_allowance" class="form-label">Tunjangan Jabatan</label>
                    <input type="text" class="form-control" id="positional_allowance" value="" readonly>
                </div>
                <div class="mb-2">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option value="choose" selected>--Pilih--</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Tidak Menikah">Tidak Menikah</option>
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
@endsection
