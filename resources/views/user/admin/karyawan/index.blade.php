@extends('layout.app')
@section('content')
{{-- loadiing screen --}}
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
{{-- konten --}}
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data Karyawan</h2>
                <div class="order-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#import_modal">
                        <i class="fa fa-download"></i> Import Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.admin.karyawan._modal')
@include('user.admin.karyawan._script')
@endsection
