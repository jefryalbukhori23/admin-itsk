@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row g-3 mb-3 align-items-center">
        <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a class="text-secondary" href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col">
            <h1 class="fs-5 color-900 mt-1 mb-0">Selamat Datang kembali, {{auth()->user()->name}}</h1>
        </div>
        <div class="row g-3 row-deck">
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <i class="fa fa-mortar-board fa-lg position-absolute top-0 end-0 p-3"></i>
                        <div class="mb-2 text-uppercase">Mahasiswa</div>
                        <div>
                            <span class="h4">{{$count_mhs}}</span>
                        </div>
                        <small class="text-muted">Jumlah Seluruh Mahasiswa</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <i class="fa fa-users fa-lg position-absolute top-0 end-0 p-3"></i>
                        <div class="mb-2 text-uppercase">Dosen</div>
                        <div>
                            <span class="h4">{{$count_lecture}}</span>
                        </div>
                        <small class="text-muted">Jumlah Seluruh Dosen</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <i class="fa fa-university fa-lg position-absolute top-0 end-0 p-3"></i>
                        <div class="mb-2 text-uppercase">Fakultas</div>
                        <div>
                            <span class="h4">{{$count_fakultas}}</span>
                        </div>
                        <small class="text-muted">Jumlah Fakultas</small>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <i class="fa fa-gears fa-lg position-absolute top-0 end-0 p-3"></i>
                        <div class="mb-2 text-uppercase">Prodi</div>
                        <div>
                            <span class="h4">{{$count_prodi}}</span>
                        </div>
                        <small class="text-muted">Jumlah Prodi</small>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h6 class="card-title m-0">Total Revenue</h6>
                  <div class="dropdown morphing scale-left">
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i
                        class="icon-size-fullscreen"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div class="bg-light px-4 py-3 d-flex flex-row align-items-center rounded-4">
                    <div>
                      <h6 class="mb-0 fw-bold">$3,056</h6>
                      <small class="text-muted font-11">Fees</small>
                    </div>
                    <div class="ms-lg-5 ms-md-4 ms-3">
                      <h6 class="mb-0 fw-bold">$1,998</h6>
                      <small class="text-muted font-11">Donation</small>
                    </div>
                    <div class="d-none d-sm-block ms-auto">
                      <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                        <label class="btn btn-outline-secondary" for="btnradio1">Week</label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                        <label class="btn btn-outline-secondary" for="btnradio2">Month</label>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" checked="">
                        <label class="btn btn-outline-secondary" for="btnradio3">Year</label>
                      </div>
                    </div>
                  </div>
                  <div id="apex-TotalRevenue"></div>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h6 class="card-title m-0">Device use by Student</h6>
                  <div class="dropdown morphing scale-left">
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i
                        class="icon-size-fullscreen"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex text-center">
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Desktop</span>
                      <h5>1.08K</h5>
                      <small class="text-success"><i class="fa fa-angle-up"></i> 1.03%</small>
                    </div>
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Mobile</span>
                      <h5>3.20K</h5>
                      <small class="text-danger"><i class="fa fa-angle-down"></i> 1.63%</small>
                    </div>
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Tablet</span>
                      <h5>8.18K</h5>
                      <small class="text-success"><i class="fa fa-angle-up"></i> 4.33%</small>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="apex-DeviceusebyStudent"></div>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h6 class="card-title m-0">Students by Level</h6>
                  <div class="dropdown morphing scale-left">
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i
                        class="icon-size-fullscreen"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div id="apex-StudentsbyLevel"></div>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h6 class="card-title m-0">Students by College</h6>
                  <div class="dropdown morphing scale-left">
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i
                        class="icon-size-fullscreen"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div id="apex-StudentsbyCollege"></div>
                </div>
              </div>
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h6 class="card-title m-0">Active Student</h6>
                  <div class="dropdown morphing scale-left">
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i
                        class="icon-size-fullscreen"></i></a>
                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-h"></i></a>
                    <ul class="dropdown-menu shadow border-0 p-2">
                      <li><a class="dropdown-item" href="#">File Info</a></li>
                      <li><a class="dropdown-item" href="#">Copy to</a></li>
                      <li><a class="dropdown-item" href="#">Move to</a></li>
                      <li><a class="dropdown-item" href="#">Rename</a></li>
                      <li><a class="dropdown-item" href="#">Block</a></li>
                      <li><a class="dropdown-item" href="#">Delete</a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Daily (Avg)</span>
                      <h5>1.08K</h5>
                      <small class="text-success"><i class="fa fa-angle-up"></i> 1.03%</small>
                    </div>
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Weekly</span>
                      <h5>3.20K</h5>
                      <small class="text-danger"><i class="fa fa-angle-down"></i> 1.63%</small>
                    </div>
                    <div class="p-2 flex-fill">
                      <span class="text-muted">Monthly</span>
                      <h5>8.18K</h5>
                      <small class="text-success"><i class="fa fa-angle-up"></i> 4.33%</small>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="apexcharts-line-0" id="apexspark5"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">

                <ul class="nav nav-tabs tab-card pt-3">
                  <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#ExamToppers">Exam
                      Toppers</a></li>
                  <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#NewAdmission">New Admission</a>
                  </li>
                </ul>
                <div class="card-body">

                  <div class="tab-content mt-3">
                    <div role="tabpanel" class="tab-pane in active" id="ExamToppers">
                      <div class="table-responsive">
                        <table class="table myDataTable card-table align-middle table-hover mb-0">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Report</th>
                              <th>Year</th>
                              <th>Field</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Dean Otto</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2018</td>
                              <td>MCA</td>
                            </tr>
                            <tr>
                              <td>K. Thornton</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-warning" role="progressbar" style="width: 65%"
                                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2018</td>
                              <td>B.E</td>
                            </tr>
                            <tr>
                              <td>Kane D.</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2019</td>
                              <td>B.Pharm</td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 23%"
                                    aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2018</td>
                              <td>MCA</td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 34%"
                                    aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2020</td>
                              <td>PHD</td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 90%"
                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2018</td>
                              <td>MCA</td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 85%"
                                    aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2020</td>
                              <td>MBA</td>
                            </tr>
                            <tr>
                              <td>Kane D.</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 12%"
                                    aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2019</td>
                              <td>B.Pharm</td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-success" role="progressbar" style="width: 81%"
                                    aria-valuenow="81" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2018</td>
                              <td>MCA</td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>
                                <div class="progress" style="height: 3px;">
                                  <div class="progress-bar bg-danger" role="progressbar" style="width: 9%"
                                    aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                              </td>
                              <td>2020</td>
                              <td>PHD</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="NewAdmission">
                      <div class="table-responsive">
                        <table class="table myDataTable card-table align-middle table-hover mb-0">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Age</th>
                              <th>Number</th>
                              <th>Department</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Dean Otto</td>
                              <td>22</td>
                              <td>+404-447-6013</td>
                              <td><span class="badge bg-primary">MCA</span></td>
                            </tr>
                            <tr>
                              <td>K. Thornton</td>
                              <td>23</td>
                              <td>+404-447-6013</td>
                              <td><span class="badge bg-info">MBA</span></td>
                            </tr>
                            <tr>
                              <td>Kane D.</td>
                              <td>22</td>
                              <td>+404-447-4582</td>
                              <td><span class="badge bg-warning">Medical</span></td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>24</td>
                              <td>+404-447-3214</td>
                              <td><span class="badge bg-success">BBA</span></td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>22</td>
                              <td>+404-447-2589</td>
                              <td><span class="badge bg-primary">MCA</span></td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>23</td>
                              <td>+404-447-1478</td>
                              <td><span class="badge bg-secondary">M.COM</span></td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>22</td>
                              <td>+404-447-7896</td>
                              <td><span class="badge bg-danger">M.COM</span></td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>24</td>
                              <td>+404-447-3214</td>
                              <td><span class="badge bg-success">BBA</span></td>
                            </tr>
                            <tr>
                              <td>Hughe L.</td>
                              <td>22</td>
                              <td>+404-447-2589</td>
                              <td><span class="badge bg-primary">MCA</span></td>
                            </tr>
                            <tr>
                              <td>Jack Bird</td>
                              <td>23</td>
                              <td>+404-447-1478</td>
                              <td><span class="badge bg-info">M.COM</span></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
    </div>
</div>
@endsection
