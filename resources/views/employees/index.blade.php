@extends('layouts.dashboard')

@section('container-dashboard')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Pegawai</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="/employees/create" class="btn btn-sm btn-outline-secondary">
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
                            <th></th>
                            <th></th>
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
                                        data-bs-target="#detailModal" onclick="handleDetailButton({{ $employee->id }})">
                                        <span data-feather="eye"></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                                        data-bs-target="#updateModalEmployee">
                                        <span data-feather="edit-2"></span>
                                    </a>
                                </td>
                                <td>
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

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td id="idNumber"></td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai</td>
                            <td>:</td>
                            <td id="name"></td>
                        </tr>
                        <tr>
                            <td>Golongan</td>
                            <td>:</td>
                            <td id="jobClass"></td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>:</td>
                            <td id="basicSalary"></td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td id="grade"></td>
                        </tr>
                        <tr>
                            <td>Tunjangan Jabatan</td>
                            <td>:</td>
                            <td id="positionalAllowance"></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td id="status"></td>
                        </tr>
                        <tr>
                            <td>Jumlah Anak</td>
                            <td>:</td>
                            <td id="numberOfChildren"></td>
                        </tr>

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const idNumber = document.getElementById('idNumber');
        const name = document.getElementById('name');
        const jobClass = document.getElementById('jobClass');
        const basicSalary = document.getElementById('basicSalary');
        const grade = document.getElementById('grade');
        const positionalAllowance = document.getElementById('positionalAllowance');
        const status = document.getElementById('status');
        const numberOfChildren = document.getElementById('numberOfChildren');

        function handleDetailButton(id) {
            fetch('/employees/' + id)
                .then(response => response.json())
                .then(data => {
                    idNumber.innerHTML = data.employee.id_number,
                        name.innerHTML = data.employee.name,
                        jobClass.innerHTML = data.employee.group.job_class,
                        basicSalary.innerHTML = data.employee.group.basic_salary,
                        grade.innerHTML = data.employee.position.grade,
                        positionalAllowance.innerHTML = data.employee.position.positional_allowance,
                        status.innerHTML = data.employee.status,
                        numberOfChildren.innerHTML = data.employee.number_of_children
                });
        }
    </script>
@endsection
