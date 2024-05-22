@extends('layout.app')
@section('content')
{{-- loading screen --}}
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
{{-- konten --}}
<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header">
            <ul class="nav nav-tabs tab-page-toolbar rounded d-inline-flex" role="tablist">
                <li class="nav-item">
                    <a class="nav-link border-0 active" data-bs-toggle="tab" href="#transaksi_in" role="tab">
                        <i class="fa fa-book me-2"></i>Soal Kuisioner
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-0" data-bs-toggle="tab" href="#transaksi_out" role="tab">
                        <i class="fa fa-users me-2"></i>Data Evaluasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border-0" data-bs-toggle="tab" href="#tab_laporan" role="tab">
                        <i class="fa fa-file-excel-o me-2"></i>Laporan
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="transaksi_in" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header">
                    <h4 class="text-center">Soal Kuisioner</h4>
                    <button class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#add_modal_soal">
                        <i class="fa fa-plus-circle"></i> Tambah Soal Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="tabel_soal">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Soal</th>
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
        <div class="tab-pane fade" id="transaksi_out" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-center">Hasil Evaluasi oleh Mahasiswa</h4>
                        </div>
                        <div class="form-group col-3 mt-1">
                            <label for="" class="form-label">Tahun Akademik</label>
                            <select name="id_by" id="by_select" class="form-select form-select-filter" data-placeholder="Pilih Tahun Akademik">
                                <option value=""></option>
                                @foreach ($by as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3 mt-1">
                            <label for="" class="form-label">Semester</label>
                            <select name="semester" id="semester_select" class="form-select form-select-filter" data-placeholder="Pilih Semester">
                                <option value=""></option>
                                @for($i=1;$i<=8;$i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-6 mt-1">
                            <label class="form-label">Dosen</label>
                            <select name="lecture" id="lecture_select" class="form-select form-select-filter" data-placeholder="Pilih Dosen">
                                <option value=""></option>
                                @foreach ($lecture as $row)
                                    <option value="{{$row->id}}">{{ Helper::haha(Helper::yohohoho($row->place_birth),$row->nidn) }} - {{ Helper::haha(Helper::yohohoho($row->place_birth),$row->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped" id="tabel_hasil">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Semester</th>
                                    <th>Dosen</th>
                                    <th>Mahasiswa</th>
                                    <th>Nilai</th>
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
        <div class="tab-pane fade" id="tab_laporan" role="tabpanel">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-center">Laporan EDOM</h4>
                        </div>
                        <div class="form-group col-3 mt-1">
                            <label for="" class="form-label">Tahun Akademik</label>
                            <select name="id_by" id="by_select_laporan" class="form-select form-select-filter" data-placeholder="Pilih Tahun Akademik">
                                <option value=""></option>
                                @foreach ($by as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-3 mt-1">
                            <label for="" class="form-label">Semester Tahun Akademik</label>
                            <select name="id_sub_by" id="sub_by_select_laporan" class="form-select form-select-filter" data-placeholder="Pilih Tahun Semester Akademik">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-3 mt-1">
                            <label for="" class="form-label">Terapkan Filter</label>
                            <button class="btn btn-info text-white" id="btn_filter">
                                <i class="fa fa-filter"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <h4>Laporan Per Soal</h4>
                            </div>
                            <div class="form-group col-4">
                                <select name="lecture" id="lecture_laporan" class="form-select form-select-filter" data-placeholder="Pilih Dosen" disabled>
                                    <option value=""></option>
                                    @foreach ($lecture as $row)
                                        <option value="{{$row->id}}">{{ Helper::haha(Helper::yohohoho($row->place_birth),$row->nidn) }} - {{ Helper::haha(Helper::yohohoho($row->place_birth),$row->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-sm btn-primary" title="Terapkan Filter Dosen" id="btn_filter_dosen_laporan">
                                    <i class="fa fa-filter"></i>
                                </button>
                            </div>
                            <div class="col-2">
                                <a href="#" id="btn_laporan_soal">
                                    <button class="btn btn-success btn-sm" title="Download Laporan Excel">
                                        <i class="fa fa-download"></i> <i class="fa fa-file-excel-o"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped" id="tabel_laporan_soal">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aspek yang dinilai</th>
                                    <th>Total</th>
                                    <th>Hasil Per Item</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-8">
                                <h4>Laporan Per Dosen</h4>
                            </div>
                            <div class="col-4">
                                <a href="#" id="btn_laporan_dosen">
                                    <button class="btn btn-success" >
                                        <i class="fa fa-download"></i> Download Laporan
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped" id="tabel_laporan_dosen">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dosen</th>
                                    <th>Total Skor</th>
                                    <th>Keterangan</th>
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
</div>
@include('user.admin.kuisioner_dosen._modal')
@include('user.admin.kuisioner_dosen._script')
@endsection
