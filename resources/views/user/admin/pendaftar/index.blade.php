
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
@extends('layout.app')
@section('content')
<style>

    .centers {
            height: 25%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .wave {
            width: 5px;
            height: 100px;
            background: linear-gradient(45deg, cyan, #02169a);
            margin: 10px;
            animation: wave 1s linear infinite;
            border-radius: 20px;
        }
        .wave:nth-child(2) {
        animation-delay: 0.1s;
        }
        .wave:nth-child(3) {
        animation-delay: 0.2s;
        }
        .wave:nth-child(4) {
        animation-delay: 0.3s;
        }
        .wave:nth-child(5) {
        animation-delay: 0.4s;
        }
        .wave:nth-child(6) {
        animation-delay: 0.5s;
        }
        .wave:nth-child(7) {
        animation-delay: 0.6s;
        }
        .wave:nth-child(8) {
        animation-delay: 0.7s;
        }
        .wave:nth-child(9) {
        animation-delay: 0.8s;
        }
        .wave:nth-child(10) {
        animation-delay: 0.9s;
        }

        @keyframes wave {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1);
        }
        100% {
            transform: scale(0);
        }
        }

        td {
            text-transform:uppercase;
        }
</style>
<input type="hidden" value="{{$active_by}}" id="active_by">
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Data Calon Mahasiswa Baru</h2>
                <div class="form-group">
                    <label for="">Tahun Akademik</label>
                    <select id="by_select" class="form-control">
                        @foreach ($data_by as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card">
                            {{-- <ul class="nav nav-tabs tab-card pt-3" role="tablist">
                                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav_week1" role="tab">Peminat</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav_week2" role="tab">Pendaftar</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav_week3" role="tab">Waiting Tes</a></li>
                                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav_week4" role="tab">Diterima</a></li>
                            </ul> --}}
                            <ul class="nav nav-tabs tab-page-toolbar rounded d-inline-flex" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week1" role="tab">
                                        <b>Peminat</b>
                                        <i class="fa fa-users" ></i>
                                        <span id="jml_peminat">{{$jml_peminat}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week2" role="tab">
                                        <b>Pendaftar</b>
                                        <i class="fa fa-users" ></i>
                                        <span id="jml_pendaftar">{{$jml_pendaftar}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week3" role="tab">
                                        <b>Waiting Tes</b>
                                        <i class="fa fa-users" ></i>
                                        <span id="jml_waiting_tes">{{$jml_tes}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week4" role="tab">
                                        <b>Daftar Ulang</b>
                                        <i class="fa fa-users" ></i>
                                        <span id="jml_diterima">{{$jml_diterima}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week5" role="tab">
                                        <b>Diterima</b>
                                        <i class="fa fa-users" ></i>
                                        <span id="jml_diterima2">{{$jml_mahasiswa}}</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- <div class="row nav nav-tabs tab-card" role="tablist">
                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#nav_week1" role="tab">
                                        <div class="card text-center">
                                            <div class="card-header" style="text-align: center">
                                                <h4 class="text-center">Peminat</h4>
                                            </div>
                                            <div class="card-body">
                                                <i class="fa fa-users"  style="font-size:25px"></i>
                                                <span id="jml_peminat" style="font-size:25px">{{$jml_peminat}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week2" role="tab">
                                        <div class="card text-center">
                                            <div class="card-header" style="text-align: center">
                                                <h4 class="text-center">Pendaftar</h4>
                                            </div>
                                            <div class="card-body">
                                                <i class="fa fa-users"  style="font-size:25px"></i>
                                                <span id="jml_pendaftar" style="font-size:25px">{{$jml_pendaftar}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week3" role="tab">
                                        <div class="card text-center">
                                            <div class="card-header" style="text-align: center">
                                                <h4 class="text-center">Waiting Tes</h4>
                                            </div>
                                            <div class="card-body">
                                                <i class="fa fa-users"  style="font-size:25px"></i>
                                                <span id="jml_waiting_tes" style="font-size:25px">{{$jml_tes}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week4" role="tab">
                                        <div class="card text-center">
                                            <div class="card-header" style="text-align: center">
                                                <h4 class="text-center">Daftar Ulang</h4>
                                            </div>
                                            <div class="card-body">
                                                <i class="fa fa-users"  style="font-size:25px"></i>
                                                <span id="jml_diterima" style="font-size:25px">{{$jml_diterima}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-2 col-lg-2 col-xl-2 col-sm-2">
                                    <a class="nav-link" data-bs-toggle="tab" href="#nav_week5" role="tab">
                                        <div class="card text-center">
                                            <div class="card-header" style="text-align: center">
                                                <h4 class="text-center">Diterima</h4>
                                            </div>
                                            <div class="card-body">
                                                <i class="fa fa-users"  style="font-size:25px"></i>
                                                <span id="jml_diterima" style="font-size:25px">{{$jml_mahasiswa}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div> --}}
                            <div class="tab-content mt-3" id="myTabContent">
                                <div class="tab-pane fade" id="nav_week1" role="tabpanel" style="margin:10px;">
                                    <div class="table-responsive">
                                        <table id="tabel_peminat" class="table align-middle mb-0 card-table mt-4">
                                            <thead>
                                                <tr>
                                                    {{-- <th>
                                                        <div class="form-check" style="font-size: 16px;">
                                                            <input class="form-check-input select-all" type="checkbox" value="">
                                                        </div>
                                                    </th> --}}
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Peminat</th>
                                                    <th>Jalur Seleksi</th>
                                                    <th>Periode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr class="row-selectable">
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                        </div>
                                                    </td>
                                                    <td>Monday</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="../assets/img/xs/avatar1.jpg" class="rounded sm avatar" alt="">
                                                            <div class="ms-2 mb-0">Marshall Nichols</div>
                                                        </div>
                                                    </td>
                                                    <td>Bridge – Bandha Sarvangasana</td>
                                                    <td>5</td>
                                                    <td>
                                                        <a href="#" title=""><img class="avatar xs rounded" src="../assets/img/xs/avatar3.jpg" alt="friend"> </a>
                                                        <a href="#" title=""><img class="avatar xs rounded" src="../assets/img/xs/avatar1.jpg" alt="friend"> </a>
                                                        <a href="#" title=""><img class="avatar xs rounded" src="../assets/img/xs/avatar7.jpg" alt="friend"> </a>
                                                        <a href="#" title=""><img class="avatar xs rounded" src="../assets/img/xs/avatar9.jpg" alt="friend"> </a>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-link btn-sm text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Video"><i class="fa fa-youtube-play"></i></button>
                                                        <button type="button" class="btn btn-link btn-sm text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Video"><i class="fa fa-envelope"></i></button>
                                                        <button type="button" class="btn btn-link btn-sm text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"><i class="fa fa-download"></i></button>
                                                    </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{url('export-pendaftar/waiting/'.$active_by)}}" id="btn_export_peminat" class="download_btn">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Download Rekap Peminat
                                            </button>
                                        </a>

                                        <span>
                                            <div class="centers" style="display: none">
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav_week2" role="tabpanel" style="margin:10px;">
                                    <div class="table-responsive">
                                        <table id="tabel_pendaftar" class="table align-middle mb-0 card-table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Jalur Seleksi</th>
                                                    <th>Periode</th>
                                                    <th>Status Daftar Ulang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{url('export-pendaftar/pendaftar/'.$active_by)}}" id="btn_export_pendaftar" class="download_btn">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Download Rekap Pendaftar
                                            </button>
                                        </a>

                                        <span>
                                            <div class="centers" style="display: none">
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav_week3" role="tabpanel" style="margin:10px;">
                                    <div class="table-responsive">
                                        <table id="tabel_tes" class="table align-middle mb-0 card-table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Jalur Seleksi</th>
                                                    <th>Periode</th>
                                                    <th>Status Tes</th>
                                                    <th>Status Daftar Ulang</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{url('export-pendaftar/tes/'.$active_by)}}" id="btn_export_tes" class="download_btn">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Download Rekap Tes
                                            </button>
                                        </a>

                                        <span>
                                            <div class="centers" style="display: none">
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav_week4" role="tabpanel" style="margin:10px;">
                                    <div class="table-responsive">
                                        <table id="tabel_harus_daftar_ulang" class="table align-middle mb-0 card-table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Jalur Seleksi</th>
                                                    <th>Periode</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{url('export-pendaftar/diterima/'.$active_by)}}" id="btn_export_diterima" class="download_btn">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Download Rekap Daftar Ulang
                                            </button>
                                        </a>

                                        <span>
                                            <div class="centers" style="display: none">
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav_week5" role="tabpanel" style="margin:10px;">
                                    <div class="table-responsive">
                                        <table id="tabel_diterima" class="table align-middle mb-0 card-table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{url('export-pendaftar/done/'.$active_by)}}" id="btn_export_done" class="download_btn">
                                            <button class="btn btn-success">
                                                <i class="fa fa-file-excel-o"></i> Download Rekap Diterima
                                            </button>
                                        </a>

                                        <span>
                                            <div class="centers" style="display: none">
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                                <div class="wave"></div>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modal --}}

    <div id="check_tes_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hasil Tes Calon Mahasiswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="" id="form_acc_tes" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_tes_registration" >
                    <input type="hidden" id="id_calon_mhs1">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Nama Calon Mahasiswa</label>
                                <input type="text" class="form-control" id="name_check" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Waktu Tes</label>
                                <input type="text" class="form-control" id="waktu_check" readonly>
                            </div>
                            <br>
                            <div class="form-group col-12 mt-4">
                                <h3 id="jml_benar"></h3> <br>
                                <h2 id="nilai_tes"></h2>
                            </div>
                            <br>
                            <div class="form-group col-6">
                                <label for="">Status Mahasiswa</label>
                                <select name="status" id="tes_status" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="tidak diterima">Tidak Diterima</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Prodi Diterima</label>
                                <select name="prodi_diterima" id="prodi_diterima_tes" class="form-control" disabled>
                                    <option value="" disabled selected>Pilih Prodi</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Beasiswa</label>
                                <select name="is_beasiswa" id="is_beasiswa1" class="form-control" required>
                                    <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                    <option value="Y">Mendapat Beasiswa</option>
                                    <option value="N">Tidak Mendapat Beasiswa</option>
                                </select>
                            </div>
                            <div class="form-group col-6 mb-2">
                                <label for="">Jumlah Beasiswa (%)</label>
                                <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa1" class="form-control" disabled>
                            </div>
                            <br>
                            <hr>
                            <div class="col-12 mt-2" id="tabel_daftar_ulang_price" style="display:none">
                                <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                                <table class="table table-striped mt-2" id="tabel_daftar_ulang">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nominal</th>
                                            <th>Beasiswa (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc_tes" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="check_tes_modal2" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hasil Tes Calon Mahasiswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="" id="form_acc_tes2" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id_tes_registration2" >
                    <input type="hidden" id="id_calon_mhs2">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Nama Calon Mahasiswa</label>
                                <input type="text" class="form-control" id="name_check2" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Status Mahasiswa</label>
                                <select name="status" id="tes_status2" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="tidak diterima">Tidak Diterima</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Prodi Diterima</label>
                                <select name="prodi_diterima" id="prodi_diterima_tes2" class="form-control" disabled>
                                    <option value="" disabled selected>Pilih Prodi</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Beasiswa</label>
                                <select name="is_beasiswa" id="is_beasiswa12" class="form-control" required>
                                    <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                    <option value="Y">Mendapat Beasiswa</option>
                                    <option value="N">Tidak Mendapat Beasiswa</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Jumlah Beasiswa (%)</label>
                                <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa12" class="form-control" disabled>
                            </div>
                            <br>
                            <hr>
                            <div class="col-12 mt-2" id="tabel_daftar_ulang_price2" style="display:none">
                                <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                                <table class="table table-striped mt-2" id="tabel_daftar_ulang2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nominal</th>
                                            <th>Beasiswa (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc_tes2" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="bukti_transfer_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-2">
                            <label>Nama Calon Mahasiswa</label>
                            <input type="text" class="form-control" id="name_bukti_transfer" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="">Waktu Transaksi</label>
                            <input type="text" class="form-control" id="waktu_bukti_transfer" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label>Nama Pada Rekening</label>
                            <input type="text" class="form-control" id="nama_rekening_bukti_transfer" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="">No Rekening</label>
                            <input type="text" class="form-control" id="no_rekening_bukti_transfer" readonly>
                        </div>
                        <br>
                        <div class="form-group col-12 mt-2">
                            <label for="" class="form-label"> Bukti Transfer
                                <a href="#" id="btn_download_bukti1">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fa fa-download"></i>Download
                                    </button>
                                </a>
                            </label>
                            <img src="" id="bukti_transfer_img" style="width:100%;" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="bukti_daftar_ulang_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-6 mt-2">
                            <label>Nama Calon Mahasiswa</label>
                            <input type="text" class="form-control" id="name_bukti_daftar_ulang" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="">Waktu Transaksi</label>
                            <input type="text" class="form-control" id="waktu_bukti_daftar_ulang" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label>Nama Pada Rekening</label>
                            <input type="text" class="form-control" id="nama_rekening_bukti_daftar_ulang" readonly>
                        </div>
                        <div class="form-group col-6 mt-2">
                            <label for="">No Rekening</label>
                            <input type="text" class="form-control" id="no_rekening_bukti_daftar_ulang" readonly>
                        </div>
                        <br>
                        <div class="form-group col-12 mt-2">
                            <label for="">Bukti Transfer
                                <a href="#" id="btn_download_bukti2">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fa fa-download"></i>Download
                                    </button>
                                </a>
                            </label>
                            <img src="" id="bukti_daftar_ulang_img" style="width:100%;" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="acc_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Konfirmasi Pendaftaran Calon Mahasiswa Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="" method="POST" id="form_acc_pendaftaran">
                    <input type="hidden" id="id_calon_mhs3">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" id="id_acc_registration" >
                            <div class="form-group col-6">
                                <label for="recipient-name" class="form-label">Nama Calon Mahasiswa Baru</label>
                                <input type="text" class="form-control" id="name_edit" placeholder="Masukan Nama calon_mahasiswa_baru" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="recipient-name" class="form-label">Nominal Pendaftaran (Rp)</label>
                                <input type="text" name="nominal" class="form-control" id="nominal_pendaftaran" placeholder="Masukan Nominal Pendaftaran (Rp)">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Pilihan Prodi 1</label>
                                <input type="text" class="form-control" id="pilihan_prodi_1_acc" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Pilihan Prodi 2</label>
                                <input type="text" class="form-control" id="pilihan_prodi_2_acc" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Status Mahasiswa</label>
                                <select name="status" id="acc_status" class="form-control" required>
                                    <option value="" disabled selected>Pilih Status Mahasiswa</option>
                                    <option value="diterima">Diterima</option>
                                    <option value="tes">Tes Potensi Akademik</option>
                                    <option value="upload_ulang_pembayaran">Upload Ulang Pembayaran</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Prodi Diterima</label>
                                <select name="prodi_diterima" id="prodi_diterima_acc" class="form-control" disabled>
                                    <option value="" disabled selected>Pilih Prodi</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Beasiswa</label>
                                <select name="is_beasiswa" id="is_beasiswa" class="form-control" required>
                                    <option value="" disabled selected>Apakah Calon Mahasiswa Mendapatkan Beasiswa ?</option>
                                    <option value="Y">Mendapat Beasiswa</option>
                                    <option value="N">Tidak Mendapat Beasiswa</option>
                                </select>
                            </div>
                            <div class="form-group col-6 mb-2">
                                <label for="">Jumlah Beasiswa (%)</label>
                                <input type="number" min="0" value="0" name="beasiswa" id="jml_beasiswa" class="form-control" disabled>
                            </div>
                            <br>
                            <hr>
                            <div class="col-12 mt-2" id="tabel_daftar_ulang_price3" style="display:none">
                                <h5 class="text-center">Rincian Biaya Daftar Ulang</h5>
                                <table class="table table-striped mt-2" id="tabel_daftar_ulang3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nominal</th>
                                            <th>Beasiswa (%)</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success waves-effect waves-light text-white btn_acc" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="detail_pendaftar_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Calon Mahasiswa Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-1">

                        </div>
                        <div class="col-md-3" style="margin-top: 3px;">
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">No Identitas</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Nama Lengkap</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tempat, Tanggal Lahir</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jenis Kelamin</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Asal Sekolah</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jurusan</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tahun Lulus</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;height:50px;">No Telpon</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Email</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 1</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 2</div>
                            <div class="row" style="font-size:16px;">Berkas Mahasiswa</div>
                        </div>
                        <div class="col-md-8" style="margin-top: 3px;">
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_no_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="name_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="ttl_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="gender_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="school_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="jurusan_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="tahun_lulus_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;height:50px;" id="phone_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="email_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi1_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi2_detail_peminat"></div>
                            <div class="row" style="padding:2px;font-size:16px;" id="file_detail_peminat">
                                <div class="order-actions" id="btn_files">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="detail_peminat_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Calon Mahasiswa Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-1">

                        </div>
                        <div class="col-md-3" style="margin-top: 3px;">
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">No Identitas</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Nama Lengkap</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tempat, Tanggal Lahir</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jenis Kelamin</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Asal Sekolah</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Jurusan</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Tahun Lulus</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">No Telpon</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Email</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 1</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Pilihan Prodi 2</div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;">Nama Rekomendasi</div>
                            <div class="row" style="font-size:16px;">Berkas Mahasiswa</div>

                        </div>
                        <div class="col-md-8" style="margin-top: 3px;">
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_no_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="name_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="ttl_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="gender_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="school_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="jurusan_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="tahun_lulus_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="phone_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="email_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi1_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="id_prodi2_detail_peminat"></div>
                            <div class="row" style="border-bottom:1px solid gray;padding:2px;font-size:16px;" id="nama_rekomendasi"></div>
                            <div class="row" style="padding:2px;font-size:16px;" id="file_detail_peminat"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Mahasiswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <img src="" id="img_mahasiswa" style="width: 100%;" alt="">
                        </div>
                        <div class="col-9">
                            <table class="table">
                                <tr>
                                    <th>NIM</th>
                                    <td id="nim"></td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td id="name"></td>
                                </tr>
                                <tr>
                                    <th>Tempat,Tgl Lahir</th>
                                    <td id="ttl_mhs"></td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td id="gender"></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td id="address"></td>
                                </tr>
                                <tr>
                                    <th>Prodi</th>
                                    <td id="prodi"></td>
                                </tr>
                                <tr>
                                    <th>Sistem Kuliah</th>
                                    <td id="sistem_kuliah"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <th>Status Perkawinan</th>
                                    <td id="status_perkawinan"></td>
                                    <th>Agama</th>
                                    <td id="agama"></td>
                                </tr>
                                <tr>
                                    <th>NISN</th>
                                    <td id="nisn"></td>
                                    <th>Email</th>
                                    <td id="email"></td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td id="phone"></td>
                                    <th>No.HP Orang Tua</th>
                                    <td id="no_hp_ortu"></td>
                                </tr>
                                <tr>
                                    <th>Nama Ayah</th>
                                    <td id="nama_ayah"></td>
                                    <th>Nama Ibu</th>
                                    <td id="nama_ibu"></td>
                                </tr>
                                <tr>
                                    <th>Pekerjaan Ayah</th>
                                    <td id="pekerjaan_ayah"></td>
                                    <th>Pekerjaan Ibu</th>
                                    <td id="pekerjaan_ibu"></td>
                                </tr>
                                <tr>
                                    <th>Nama Wali</th>
                                    <td id="nama_wali"></td>
                                    <th>Alamat Orang Tua</th>
                                    <td id="alamat_ortu"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="add_berkas_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Berkas Mahasiswa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <form action="{{url('upload-berkas-mahasiswa')}}" id="form_upload_berkas_mahasiswa" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id_mahasiswa" id="id_mahasiswa_berkas">
                    <div class="modal-body">
                        <div id="loading_screen" style="display: none;">
                            <div class="form-group col-11 text-center">
                                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="row g-2" id="upload_form_berkas" style="display: none;">
                            @foreach ($berkas as $row)
                                <div class="form-group col-md-5 col-11 m-2">
                                    <h6>{{$row->name}}</h6>
                                    <input type="file" name="{{$row->id}}" id="berkas_{{$row->id}}" data-nama="{{$row->name}}" class="dropify" data-allowed-file-extensions="{{$row->type}}" {{$row->is_required}}>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" id="edit_modal_close" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success waves-effect waves-light text-white btn_berkas" data-bs-dismiss="modal">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="biaya_daftar_ulang_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Biaya Daftar Ulang Calon Mahasiswa Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class="col-5">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" id="name_du_modal" class="form-control" readonly>
                        </div>
                        <div class="col-5">
                            <label for="" class="form-label">Status</label><br>
                            <span id="status_du_modal">
                            </span>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tbl_biaya_du">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Beasiswa</th>
                                            <th>Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot></tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <h4>Keterangan : </h4>
                            <p id="remark_owner_du_modal"></p>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="id_reg_du_modal">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success waves-effect send_mhs_du_modal" id="send_mhs_du" data-bs-dismiss="modal" style="display:none;" >Submit</button>
                    <button class="btn btn-danger text-white cancel_du" title="Batalkan" id="cancel_du"  data-bs-dismiss="modal" style="display:none;" ><i class="fa fa-times-circle"></i> Batalkan </button>
                </div>
            </div>
        </div>
    </div>
{{-- end modal --}}

{{-- JS --}}
<script src="{{asset('style/easy-number-separator.js')}}"></script>
<script>
    easyNumberSeparator({
      selector: '.number-separator',
      separator: ',',
      decimalSeparator: '.',
      resultInput: '#result_input',
    })
  </script>
<script>
    function formatRupiah(number) {
        var rupiah = "Rp" + number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
        return rupiah;
    }
    $(document).ready(function(){
        $("#by_select").select2();
        $(document).ajaxError(function() {
            swal.fire({
                icon : 'error',
                html : '<h3>Ada Kesalahan sistem</h3><br><b>silahkan coba lagi </b><br><p>Jika pesan ini masih muncul , silahkan reload halaman!</p>',
                timer: 1500,
            })
            $('#overlay').hide();
        });
        var opened_tabs = window.location.hash.substring(1);
        if(opened_tabs.includes('nav')){
            $('.nav-item a').removeClass('active');
            $('.tab-content a').removeClass('show');
            $('.tab-content a').removeClass('active');
            $('a[href="#'+opened_tabs+'"]').addClass('active');
            $("#"+opened_tabs).addClass('active');
            $("#"+opened_tabs).addClass('show');
        }else{
            $('a[href="#nav_week1"]').addClass('active');
            $("#nav_week1").addClass('active');
            $("#nav_week1").addClass('show');
        }
        var active_by = $("#active_by").val();
        var url_tabel_peminat = `{{ url('get-calon_mahasiswa_baru') }}/${active_by}`;
        var url_tabel_pendaftar = `{{ url('get-calon_mahasiswa_baru_pendaftar') }}/${active_by}`;
        var url_tabel_tes = `{{ url('get-calon_mahasiswa_baru_tes') }}/${active_by}`;
        var url_tabel_diterima = `{{ url('get-calon_mahasiswa_baru_diterima') }}/${active_by}`;
        var url_tabel_diterima2 = `{{ url('get-mahasiswa') }}/${active_by}`;

        var table = $('#tabel_peminat').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: url_tabel_peminat,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "drawCallback": function( settings ) {
                var api = this.api();
                var totalRecords = api.page.info().recordsTotal;
                $("#jml_peminat").html(totalRecords)
            }
        });
        var table_pedaftar = $('#tabel_pendaftar').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: url_tabel_pendaftar,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status_du', name: 'status_du'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "drawCallback": function( settings ) {
                var api = this.api();
                var totalRecords = api.page.info().recordsTotal;
                $("#jml_pendaftar").html(totalRecords)
            }
        });
        var table_tes = $('#tabel_tes').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: url_tabel_tes,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status', name: 'status'},
                {data: 'status_du', name: 'status_du'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "drawCallback": function( settings ) {
                var api = this.api();
                var totalRecords = api.page.info().recordsTotal;
                $("#jml_waiting_tes").html(totalRecords)
            }
        });
        var table_diterima = $('#tabel_harus_daftar_ulang').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: url_tabel_diterima,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {data: 'jalur_seleksi', name: 'jalur_seleksi'},
                {data: 'periode', name: 'periode'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "drawCallback": function( settings ) {
                var api = this.api();
                var totalRecords = api.page.info().recordsTotal;
                $("#jml_diterima").html(totalRecords)
            }
        });
        var table_diterima2 = $('#tabel_diterima').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: url_tabel_diterima2,
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kode', name: 'kode'},
                {data: 'name', name: 'name'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "drawCallback": function( settings ) {
                var api = this.api();
                var totalRecords = api.page.info().recordsTotal;
                $("#jml_diterima2").html(totalRecords)
            }
        });

        $("#by_select").change(function(){
            var id_by = $(this).val();
            var url_tabel_peminat = `{{ url('get-calon_mahasiswa_baru') }}/${id_by}`;
            var url_tabel_pendaftar = `{{ url('get-calon_mahasiswa_baru_pendaftar') }}/${id_by}`;
            var url_tabel_tes = `{{ url('get-calon_mahasiswa_baru_tes') }}/${id_by}`;
            var url_tabel_diterima = `{{ url('get-calon_mahasiswa_baru_diterima') }}/${id_by}`;
            var url_tabel_diterima2 = `{{ url('get-mahasiswa') }}/${id_by}`;

            table.ajax.url(url_tabel_peminat).load();
            table_pedaftar.ajax.url(url_tabel_pendaftar).load();
            table_tes.ajax.url(url_tabel_tes).load();
            table_diterima.ajax.url(url_tabel_diterima).load();
            table_diterima2.ajax.url(url_tabel_diterima2).load();

            var url_export_peminat = `{{url('export-pendaftar/waiting')}}/${id_by}`
            var url_export_pendaftar = `{{url('export-pendaftar/pendaftar')}}/${id_by}`
            var url_export_tes = `{{url('export-pendaftar/tes')}}/${id_by}`
            var url_export_diterima = `{{url('export-pendaftar/diterima')}}/${id_by}`
            var url_export_done = `{{url('export-pendaftar/done')}}/${id_by}`

            $("#btn_export_peminat").attr('href',url_export_peminat);
            $("#btn_export_pendaftar").attr('href',url_export_pendaftar);
            $("#btn_export_tes").attr('href',url_export_tes);
            $("#btn_export_diterima").attr('href',url_export_diterima);
            $("#btn_export_done").attr('href',url_export_done);
        })

        var tabel_data_daftar_ulang = $('#tabel_daftar_ulang').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var tabel_data_daftar_ulang2 = $('#tabel_daftar_ulang2').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        var tabel_data_daftar_ulang3 = $('#tabel_daftar_ulang3').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-daftar-ulang-calon-mhs/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'biaya', name: 'biaya'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
        $("body").on('click','.img_bukti_transfer',function(){
            var img = $(this).data('img');
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var nama_rekening = $(this).data('nama_rekening');
            var no_rekening = $(this).data('no_rekening');

            $("#nama_rekening_bukti_transfer").val(nama_rekening);
            $("#no_rekening_bukti_transfer").val(no_rekening);
            $("#name_bukti_transfer").val(name);
            $("#waktu_bukti_transfer").val(waktu);
            $("#bukti_transfer_img").attr('src','file/payment/pendaftaran/'+img)
            var url_download = "{{url('download-bukti-transfer1/{file_name}')}}";
            url_download = url_download.replace('{file_name}',img);
            $("#btn_download_bukti1").attr('href',url_download)
        })
        $("body").on('click','.img_bukti_daftar_ulang',function(){
            var img = $(this).data('img');
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var nama_rekening = $(this).data('nama_rekening');
            var no_rekening = $(this).data('no_rekening');

            $("#nama_rekening_bukti_daftar_ulang").val(nama_rekening);
            $("#no_rekening_bukti_daftar_ulang").val(no_rekening);
            $("#name_bukti_daftar_ulang").val(name);
            $("#waktu_bukti_daftar_ulang").val(waktu);
            $("#bukti_daftar_ulang_img").attr('src','https://pmb.sugenghartono.ac.id/file/payment/daftar_ulang/'+img)

            var url_download = "https://pmb.sugenghartono.ac.id/download-bukti-transfer2/{file_name}";
            url_download = url_download.replace('{file_name}',img);
            $("#btn_download_bukti2").attr('href',url_download)
        })
        $("body").on('click','.check_tes',function(){
            var id = $(this).val();
            var name = $(this).data('name');
            var waktu = $(this).data('waktu');
            var id_mahasiswa = $(this).data('id');
            $("#id_calon_mhs1").val(id_mahasiswa);

            $("#name_check").val(name);
            $("#waktu_check").val(waktu);
            var url_detail = "{{ url('get-hasil-ujian/:id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type:'GET',
                url: url_detail,
                success:function(response){
                    $("#jml_benar").html('Jumlah jawaban benar '+response.data['jawaban_benar']+' dari '+response.data['total_soal']+' soal');
                    $("#nilai_tes").html('Nilai : '+response.nilai)
                }
            })
            url_details = 'detail-calon_mahasiswa_baru/'+id_mahasiswa;
            $("#id_tes_registration").val(id);
            $.ajax({
                type : 'GET',
                url : url_details,
                success:function(response){
                    $("#prodi_diterima_tes").empty();
                    $("#id_tes_registration").val(response.data['id']);
                    $("#pilihan_prodi_1_tes").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_tes").val(response.data['prodi2']);
                    $("#prodi_diterima_tes").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    if(response.data['id_prodi2'] == '1'){
                        $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi2']+'" disabled>'+response.data['prodi2']+'</option>');
                    }else{
                        $("#prodi_diterima_tes").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                    }

                }
            })
        })
        $("body").on('click','.check_tes2',function(){
            var id = $(this).val();
            var name = $(this).data('name');

            $("#name_check2").val(name);
            var id_mahasiswa = $(this).data('id');
            $("#id_calon_mhs2").val(id_mahasiswa);
            url_details = 'detail-calon_mahasiswa_baru/'+id_mahasiswa;
            $("#id_tes_registration").val(id);
            $.ajax({
                type : 'GET',
                url : url_details,
                success:function(response){
                    $("#prodi_diterima_tes2").empty();
                    $("#id_tes_registration2").val(response.data['id']);
                    $("#pilihan_prodi_1_tes").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_tes").val(response.data['prodi2']);
                    $("#prodi_diterima_tes2").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    if(response.data['id_prodi2'] == '1'){
                        $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi2']+'" disabled>'+response.data['prodi2']+'</option>');
                    }else{
                        $("#prodi_diterima_tes2").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                    }

                }
            })
        })
        $("body").on('click','.save_data',function(){
            // alert('tes');
            var name = $("#name").val();
            if(name == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                $("#overlay").fadeIn();
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    data : {
                        _token: '{{ csrf_token() }}',
                        name : $("#name").val(),
                    },
                    success:function(response){
                        $("#name").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Data calon_mahasiswa_baru berhasil ditambahkan !'
                        });
                        $('#tabel_peminat').DataTable().ajax.reload();
                        $('#tabel_pendaftar').DataTable().ajax.reload();
                        $('#tabel_tes').DataTable().ajax.reload();
                        $('#tabel_diterima').DataTable().ajax.reload();
                        $('#tabel_diterima2').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                    }
                })

            }
        })
        $("body").on('click','.detail_peminat', function(){
            var id = $(this).val();
            url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $.ajax({
                type: 'GET',
                url : url_detail,
                success:function(response){
                    $("#id_no_detail_peminat").html(response.data['id_no']);
                    $("#name_detail_peminat").html(response.data['name']);
                    $("#ttl_detail_peminat").html(response.data['place_birth']+', '+response.data['date_birth']);
                    $("#gender_detail_peminat").html(response.data['gender']);
                    $("#school_detail_peminat").html(response.data['school']);
                    $("#jurusan_detail_peminat").html(response.data['jurusan']);
                    $("#tahun_lulus_detail_peminat").html(response.data['tahun_lulus']);
                    var phone_number = response.data['phone'].substr(0,1);
                    if(phone_number == "0"){
                        var no_telp = response.data['phone'].substr(2);
                        var nomer_telpon = phone_number.replace('0','62');
                        var telp = phone_number+no_telp;
                    }else{
                        var telp = response.data['phone'];
                    }
                    $("#phone_detail_peminat").html('<div class="order-actions">'+response.data['phone']+'<a target="_blank" href="https://wa.me/'+telp+'"><button class="btn btn-sm btn-success"><i class="fa fa-phone"></i></button></a></div>');
                    $("#email_detail_peminat").html(response.data['email']);
                    $("#id_prodi1_detail_peminat").html(response.data['prodi1']);
                    $("#id_prodi2_detail_peminat").html(response.data['prodi2']);
                    $("#nama_rekomendasi").html(response.data['nama_rekomendasi']);
                    $("#btn_files").html('');
                    $.each(response.files, function(key,item){
                        $("#btn_files").append(item);
                    })
                }
            })
        })
        $("body").on('click','.acc_pendaftaran',function(){
            var id = $(this).val();
            $("#id_calon_mhs3").val(id);
            url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $("#id_edit").val(id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#prodi_diterima_acc").empty();
                    $("#name_edit").val(response.data['name']);
                    $("#id_acc_registration").val(response.data['id']);
                    $("#pilihan_prodi_1_acc").val(response.data['prodi1']);
                    $("#pilihan_prodi_2_acc").val(response.data['prodi2']);
                    $("#prodi_diterima_acc").append('<option disabled selected>Pilih Prodi Diterima</option>');
                    $("#prodi_diterima_acc").append('<option value="'+response.data['id_prodi1']+'">'+response.data['prodi1']+'</option>');
                    $("#prodi_diterima_acc").append('<option value="'+response.data['id_prodi2']+'">'+response.data['prodi2']+'</option>');
                }
            })
        });
        $("body").on('change','#acc_status',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_acc").prop('disabled',false);
            }else{
                $("#prodi_diterima_acc").prop('disabled',true);
                $("#tabel_daftar_ulang_price3").css('display','none');
            }

        })
        $("body").on('change','#tes_status',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_tes").prop('disabled',false);
            }else{
                $("#prodi_diterima_tes").prop('disabled',true);
                $("#tabel_daftar_ulang_price").css('display','none');
            }

        })
        $("#prodi_diterima_tes").change(function(){
            $("#tabel_daftar_ulang_price").css('display','block');
            var id = $("#id_calon_mhs1").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang.ajax.url(url_data_daftar_ulang).load();

        })
        $("#prodi_diterima_acc").change(function(){
            $("#tabel_daftar_ulang_price3").css('display','block');
            var id = $("#id_calon_mhs3").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang3.ajax.url(url_data_daftar_ulang).load();

        })
        $("#prodi_diterima_tes2").change(function(){
            $("#tabel_daftar_ulang_price2").css('display','block');
            var id = $("#id_calon_mhs2").val();
            var id_prodi = $(this).val();
            var url_data_daftar_ulang = "{{url('get-daftar-ulang-calon-mhs/{id}/{id_prodi}')}}";
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id}',id);
            url_data_daftar_ulang = url_data_daftar_ulang.replace('{id_prodi}',id_prodi);
            tabel_data_daftar_ulang2.ajax.url(url_data_daftar_ulang).load();

        })
        $("#jml_beasiswa").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("#jml_beasiswa1").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("#jml_beasiswa12").change(function(){
            $(".input_beasiswa").val($(this).val());
        })
        $("body").on('change','#tes_status2',function(){
            var status = $(this).val();
            if(status == "diterima"){
                $("#prodi_diterima_tes2").prop('disabled',false);
            }else{
                $("#prodi_diterima_tes2").prop('disabled',true);
                $("#tabel_daftar_ulang_price2").css('display','none');
            }

        })
        $("body").on('click','.update',function(){
            // alert('tes');
            var id = $("#id_edit").val();
            url_update = url_update.replace(':id', id);
            $("#overlay").fadeIn();
            $.ajax({
                type : 'PUT',
                url : url_update,
                data : {
                    _token: '{{ csrf_token() }}',
                    name : $("#name_edit").val(),
                },
                success:function(response){
                    $("#name_edit").val('');
                    // get_calon_mahasiswa_baru();
                    swal.fire({
                        icon: 'success',
                        title: 'Data calon_mahasiswa_baru berhasil diupdate !'
                    });
                        $('#tabel_peminat').DataTable().ajax.reload();
                        $('#tabel_pendaftar').DataTable().ajax.reload();
                        $('#tabel_tes').DataTable().ajax.reload();
                        $('#tabel_diterima').DataTable().ajax.reload();
                        $('#tabel_diterima2').DataTable().ajax.reload();
                        $("#overlay").fadeOut();

                }
            })
        })
        $("body").on('click','.btn_acc',function(){
            var status = $("#acc_status").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_acc").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_pendaftaran')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_acc").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_pendaftaran')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_acc").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                }

            }
        })
        $("body").on('click','.hapus',function(){
            Swal.fire({
                icon:'question',
                title: 'Apakah Anda Yakin Untuk Menghapus Data ini?',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    url_delete = url_delete.replace(':id', id);
                    $.ajax({
                        type : 'DELETE',
                        url : url_delete,
                        data : {
                            _token : '{{csrf_token()}}'
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Hapus data berhasil',
                            });
                            // get_calon_mahasiswa_baru();
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
                            $('#tabel_tes').DataTable().ajax.reload();
                            $('#tabel_diterima').DataTable().ajax.reload();

                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                    });
                }
            });
        });
        $("body").on('click','.btn_acc_tes',function(){
            var status = $("#tes_status").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_tes").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#tes_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });

                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                            }
                        })
                }

            }
        })
        $("body").on('click','.btn_acc_tes2',function(){
            var status = $("#tes_status2").val();
            if(status == null){
                swal.fire({
                    icon : 'error',
                    title : 'Ada data yang masih kosong!',
                    text: 'mohon isi semua data',
                });
            }else {
                if(status == "diterima"){
                    var prodi_diterima = $("#prodi_diterima_tes2").val();
                    if(prodi_diterima == null){
                        swal.fire({
                            icon : 'error',
                            title : 'Ada data yang masih kosong!',
                            text: 'Data Prodi diterima belum dipilih',
                        });
                    }else {
                        var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes2')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#overlay").fadeIn();
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#tes_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes2").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });

                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                                $('#tabel_diterima2').DataTable().ajax.reload();
                                $("#overlay").fadeOut();
                            }
                        })
                    }
                }else{
                    var url_acc = '{{url('acc-pendaftaran')}}';

                        var form = $('#form_acc_tes2')[0];
                        var data = new FormData(form);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type : 'POST',
                            url : url_acc,
                            enctype: 'multipart/form-data',
                            processData: false,
                            data: data,
                            contentType: false,
                            cache: false,
                            success:function(response){
                                $('#acc_status option[value=""]').attr('selected','selected');
                                $("#prodi_diterima_tes2").prop('disabled',true);
                                swal.fire({
                                    icon: 'success',
                                    title: 'Konfirmasi Tes berhasil dilakukan !'
                                });
                                $('#tabel_peminat').DataTable().ajax.reload();
                                $('#tabel_pendaftar').DataTable().ajax.reload();
                                $('#tabel_tes').DataTable().ajax.reload();
                                $('#tabel_diterima').DataTable().ajax.reload();
                            }
                        })
                }

            }
        })
        $("body").on('click','.acc_daftar_ulang',function(){
            var img = $(this).data('img');
            swal.fire({
                icon:'question',
                title:'Apakah anda yakin untuk konfirmasi daftar ulang?',
                html : '<img id="img_acc_du" src="file/payment/daftar_ulang/'+img+'" style="max-height:400px;"> <br><br>\
                        <input type="text" id="total_bayar_du" class="form-control number-separator" placeholder="Masukkan total pembayaran">',
                showDenyButton: true,
                confirmButtonText: 'Iya',
                denyButtonText: 'Batal',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var id = $(this).val();
                    $("#overlay").fadeIn();
                    $.ajax({
                        type : 'POST',
                        url : 'acc-daftar-ulang',
                        data : {
                            _token : '{{csrf_token()}}',
                            id : id,
                            total: $("#total_bayar_du").val(),
                            img: img,
                        },
                        success:function(response){
                            swal.fire({
                                icon: 'success',
                                title : 'Konfirmasi Daftar Ulang Berhasil',
                            });
                            // get_calon_mahasiswa_baru();
                            $('#tabel_peminat').DataTable().ajax.reload();
                            $('#tabel_pendaftar').DataTable().ajax.reload();
                            $('#tabel_tes').DataTable().ajax.reload();
                            $('#tabel_diterima').DataTable().ajax.reload();
                            $('#tabel_diterima2').DataTable().ajax.reload();
                            $("#overlay").fadeOut();

                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                    });
                }
            });
        })
        $("body").on('change','#is_beasiswa',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa").val(0)
                $("#jml_beasiswa").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('change','#is_beasiswa1',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa1").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa1").val(0)
                $("#jml_beasiswa1").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('change','#is_beasiswa12',function(){
            var val = $(this).val();
            if(val == "Y"){
                $("#jml_beasiswa12").prop('disabled',false)
                $(".input_beasiswa").prop('disabled',false)
            }else{
                $("#jml_beasiswa12").val(0)
                $("#jml_beasiswa12").prop('disabled',true)
                $(".input_beasiswa").val(0)
                $(".input_beasiswa").prop('disabled',true)
            }
        })
        $("body").on('click','.detail',function(){
            var id = $(this).val();
            var url_detail = "{{ url('detail_mhs/:id') }}";
            url_detail = url_detail.replace(':id', id);
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#img_mahasiswa").attr('src','image/user/'+response.img);
                    $("#nim").html(response.data['nim']);
                    $("#name").html(response.data['name']);
                    $("#gender").html(response.data['gender']);
                    $("#ttl_mhs").html(response.data['place_birth']+', '+response.data['date_birth']);
                    $("#address").html(response.data['address']);
                    $("#prodi").html(response.prodi);
                    $("#sistem_kuliah").html(response.sistem_kuliah);
                    $("#status_perkawinan").html(response.data['status_perkawinan']);
                    $("#agama").html(response.data['agama']);
                    $("#nisn").html(response.data['nisn']);
                    $("#email").html(response.data['email']);
                    $("#phone").html(response.data['phone']);
                    $("#no_hp_ortu").html(response.data['no_hp_ortu']);
                    $("#nama_ayah").html(response.data['nama_ayah']);
                    $("#nama_ibu").html(response.data['nama_ibu']);
                    $("#pekerjaan_ayah").html(response.data['pekerjaan_ayah']);
                    $("#pekerjaan_ibu").html(response.data['pekerjaan_ibu']);
                    $("#nama_wali").html(response.data['nama_wali']);
                    $("#alamat_ortu").html(response.data['alamat_ortu']);
                }
            })
        });

        $(".download_btn").click(function(){
            $(".download_btn") .fadeOut();
            $(".centers").fadeIn();
            setTimeout(() => {
                $(".download_btn").fadeIn();
                $(".centers").fadeOut();
            }, 3000);
        })
        $('body').on('click','.add_berkas', function(){
            $("#loading_screen").fadeIn();
            $("#upload_form_berkas").fadeOut();
            var id = $(this).val();
            $("#id_mahasiswa_berkas").val(id);
            var url_detail = 'detail-calon_mahasiswa_baru/'+id;
            $.ajax({
                type : 'GET',
                url : url_detail,
                success:function(response){
                    $("#loading_screen").fadeOut();
                    $("#upload_form_berkas").fadeIn();
                    $.each(response.filename, function(key,item){
                        if(item.status == "Y"){

                            var file_name = "{{ url('file/registration/:file') }}";
                            file_name = file_name.replace(':file',item.name);
                            $('#berkas_'+item.id_berkas).attr('data-default-file',file_name);

                            var drEvent = $('#berkas_'+item.id_berkas).dropify(
                            {
                                defaultFile: file_name
                            });
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = file_name;
                            drEvent.destroy();
                            drEvent.init();
                        }else{
                            $('#berkas_'+item.id_berkas).attr('data-default-file','File tidak ditemukan');
                            var drEvent = $('#berkas_'+item.id_berkas).dropify({
                                defaultFile: 'file tidak ditemukan'
                            });
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();
                            drEvent.settings.defaultFile = 'file tidak ditemukan';
                            drEvent.destroy();
                            drEvent.init();
                        }
                    })
                }

            })
        })
        $('#form_upload_berkas_mahasiswa').parsley();
        $("body").on('click','.btn_berkas',function(){
            // alert('tes');
            var id = $("#id_mahasiswa_berkas").val();
            var url_update = "{{ url('update-berkas-mahasiswa') }}";
            var form = $('#form_upload_berkas_mahasiswa')[0];
            var data = new FormData(form);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if($('#form_upload_berkas_mahasiswa').parsley().isValid()){
                $("#edit_modal .close").click();
                $("#overlay").fadeIn();
                $.ajax({
                    type : 'POST',
                    url : url_update,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        $("#title").val('');
                        swal.fire({
                            icon: 'success',
                            title: 'Berkas Mahasiswa berhasil diupdate !'
                        });
                        // $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                    }
                })
            }else{
                swal.fire({
                    icon:'error',
                    title: 'Ada data yang salah',
                })
            }
        })
        $('body').on('click','.du_modal', function(){
            var id = $(this).val();
            $("#id_reg_du_modal").val(id);
            var url = "{{url('get-detail-du-calon-mhs/{id}')}}";
            url = url.replace('{id}',id);
            $.ajax({
                type:'GET',
                url : url,
                success:function(res){
                    $("#name_du_modal").val(res.registration.name);
                    if(res.tagihan.status == "W"){
                        $("#send_mhs_du").css('display','none');
                        $("#cancel_du").css('display','block');
                        $("#cancel_du").val(id);
                        $("#status_du_modal").html('<button class="btn btn-sm btn-warning text-white"><i class="fa fa-clock-o"></i> Menunggu Persetujuan Owner</button>');
                    }else if(res.tagihan.status == "A"){
                        $("#send_mhs_du").css('display','block');
                        $("#cancel_du").css('display','none');
                        $("#status_du_modal").html('<button class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i> Sudah di Setujui Owner</button>');
                    }else if(res.tagihan.status == "D"){
                        $("#send_mhs_du").css('display','none');
                        $("#cancel_du").css('display','none');
                        $("#status_du_modal").html('<button class="btn btn-sm btn-danger"><i class="fa fa-times-circle"></i> Ditolak Owner</button>');
                    }
                    $("#tbl_biaya_du tbody").empty();
                    $("#tbl_biaya_du tfoot").empty();
                    var nomer = 1;
                    var total = 0;
                    $.each(res.tagihan_detail, function(key,item){
                        $("#tbl_biaya_du tbody").append('<tr>\
                                                <td>'+nomer+'</td>\
                                                <td>'+item.nama_tagihan+'</td>\
                                                <td>'+item.beasiswa+'%</td>\
                                                <td>'+formatRupiah(item.nominal)+'</td>\
                                            </tr>');
                            total = total + item.nominal;
                            nomer++
                    })
                    $("#tbl_biaya_du tfoot").append('<tr><td colspan=3></td><td>'+formatRupiah(total)+'</td><tr>');
                    $("#remark_owner_du_modal").html(res.tagihan.remark_owner);
                }
            })
        })
        $('body').on('click','#cancel_du', function(){
            var id = $(this).val();
            var url = "{{url('cancel-du-calon-mhs')}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#overlay").fadeIn();
            $.ajax({
                type : 'POST',
                url : url,
                enctype: 'multipart/form-data',
                data: {
                    _token : '{{csrf_token()}}',
                    id : id,
                },
                success:function(response){
                    swal.fire({
                        icon: 'success',
                        title: 'Dokumen Daftar Ulang Mahasiswa dibatalkan!'
                    });
                    $("#overlay").fadeOut();
                    $('#tabel_peminat').DataTable().ajax.reload();
                    $('#tabel_pendaftar').DataTable().ajax.reload();
                    $('#tabel_tes').DataTable().ajax.reload();
                    $('#tabel_diterima').DataTable().ajax.reload();
                    $('#tabel_diterima2').DataTable().ajax.reload();
                }
            })


        })
        $('body').on('click','.send_mhs_du_modal', function(){
            var url = "{{url('acc-pendaftaran')}}";
            var id = $("#id_reg_du_modal").val();
            var status = 'diterima_final';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#overlay").fadeIn();
            $.ajax({
                type : 'POST',
                url : url,
                enctype: 'multipart/form-data',
                data: {
                    _token : '{{csrf_token()}}',
                    id : id,
                    status : status,
                },
                success:function(response){
                    swal.fire({
                        icon: 'success',
                        title: 'Konfirmasi Pendaftaran berhasil dilakukan !'
                    });
                    $("#overlay").fadeOut();
                    $('#tabel_peminat').DataTable().ajax.reload();
                    $('#tabel_pendaftar').DataTable().ajax.reload();
                    $('#tabel_tes').DataTable().ajax.reload();
                    $('#tabel_diterima').DataTable().ajax.reload();
                    $('#tabel_diterima2').DataTable().ajax.reload();
                }
            })
        })
    });
</script>
@endsection
