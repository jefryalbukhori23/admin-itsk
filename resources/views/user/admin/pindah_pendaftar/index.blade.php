@extends('layout.app')
@section('content')

<style>
    .error_msg{
        border:2px solid red;
        color:red;
    }
</style>
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
                <h2 class="text-center">Data Pendaftar T.A {{$active_by->name}}</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive mt-4">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telpon</th>
                                <th>Progres Pendaftaran</th>
                                <th>Prodi 1</th>
                                <th>Prodi 2</th>
                                <th>Jalur Seleksi</th>
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

@include('user.admin.pindah_pendaftar._modal')
@include('user.admin.pindah_pendaftar._script')
@endsection
