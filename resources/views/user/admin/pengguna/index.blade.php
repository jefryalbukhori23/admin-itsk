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
                <h2 class="text-center">Data Pengguna</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
            <div class="card-body">
                <div class="form-group col-5">
                    <label for="" class="form-label">Filter Role</label>
                    <select id="role_select" class="form-select" data-placeholder="Pilih Role">
                        <option value=""></option>
                        @foreach ($role as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped" id="tabel">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>No. Telpon</th>
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

@include('user.admin.pengguna._modal')
@include('user.admin.pengguna._script')
@endsection
