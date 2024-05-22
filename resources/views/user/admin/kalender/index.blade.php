@extends('layout.app')
@section('content')
<link href="{{ asset('style/new/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
<link href="{{ asset('style/new/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('style/new/calendar/lib/main.min.css')}}">

<style>

    .progress { position:relative; width:100%; border: 1px solid #7F98B2; padding: 1px; border-radius: 3px; }

    .bar { background-color: #B4F5B4; width:0%; height:25px; border-radius: 3px; }

    .percent { position:absolute; display:inline-block; top:3px; left:48%; color: #7F98B2;}

</style>
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span><br>
        <h3 style="color: white;">Data Sedang di Proses...</h3>
    </div>
</div>
<div class="container-fluid">
    <div class="page-content">
        @if (session('messageSuccess'))
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Berhasil</h6>
                        <div class="text-white">{{ session('messageSuccess') }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('messageDanger'))
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Berhasil</h6>
                        <div class="text-white">{{ session('messageDanger') }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="alert border-0 border-start border-5 border-info alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-info"><i class='bx bx-info-square'></i>
                </div>
                <div class="ms-3">
                    <h6 class="mb-2">Template Kalender</h6>
                    <div><a href="{{url('download-kalender')}}">Download Disini !</a></div>
                </div>
            </div>
        </div>
        <!--end row-->

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card border-top border-0 border-4 border-warning">
                    <div class="card-header">
                        <h3 class="card-title">Form Upload Kalender Akademik</h3>
                    </div>
                    <div class="card-body">
                        <div class="border p-4 rounded">
                                <form action="{{ url('upload-kalender') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-3">
                                            <label for="School Year" class="form-label">Tahun Akademik</label>
                                            <select name="id_batch_year" class="form-select" id="sy" required>
                                                @foreach ($batch_years as $sy)
                                                    <option value="{{$sy->id}}">{{$sy->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-9">
                                            <label for="file_kalender" class="form-label">File Import</label>
                                            <input class="dropify @error('file_import_valueknowledge_students') is-invalid @enderror" type="file" id="file_kalender" name="file_kalender" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" data-allowed-file-extensions="xlsx" id="image">
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-success" id="btn_upload_kalender">
                                                <i class="fa fa-save"></i> Update Kalender
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="card border-top border-0 border-4 border-warning col-md-7 col-sm-12">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <h6 class="card-title">Kalender Akademik Tahun {{$batch_year->name}}</h6>
                            <div id="calendar">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-top border-0 border-4 border-warning col-md-5 col-sm-12">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <h6 class="card-title">Keterangan</h6>
                            <table class="table">
                                <tr>
                                    <th>W1 O</th>
                                    <td>Perkuliahan Minggu 1 Ganjil</td>
                                </tr>
                                <tr>
                                    <th>W1 E</th>
                                    <td>Perkuliahan Minggu 1 Genap</td>
                                </tr>
                                <tr>
                                    <th>PTP1 O</th>
                                    <td>Pindah tgl perkuliahan Minggu 1 Ganjil</td>
                                </tr>
                                <tr>
                                    <th>PTP1 E</th>
                                    <td>Pindah tgl perkuliahan Minggu 1 Genap</td>
                                </tr>
                                <tr>
                                    <th>LU</th>
                                    <td>Libur Umum (Sabtu-Minggu)</td>
                                </tr>
                                <tr>
                                    <th>LHB</th>
                                    <td>Libur Hari Besar</td>
                                </tr>
                                <tr>
                                    <th>KRS</th>
                                    <td>KRS Mahasiswa</td>
                                </tr>
                                <tr>
                                    <th>KHS</th>
                                    <td>KHS Mahasiswa</td>
                                </tr>
                                <tr>
                                    <th>UTS</th>
                                    <td>UTS Mahasiswa</td>
                                </tr>
                                <tr>
                                    <th>UAS</th>
                                    <td>UAS Mahasiswa</td>
                                </tr>
                                <tr>
                                    <th>KT</th>
                                    <td>Kuliah Tamu</td>
                                </tr>
                                <tr>
                                    <th>CM</th>
                                    <td>Class Meeting</td>
                                </tr>
                                <tr>
                                    <th>DU</th>
                                    <td>Daftar Ulang</td>
                                </tr>
                                <tr>
                                    <th>MSG</th>
                                    <td>Mid Semester Gasal</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <!--end row-->
    </div>

</div>

<script src="{{ asset('style/new/calendar/lib/main.min.js') }}"></script>
<script src="{{ asset('style/new/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('style/new/fancy-file-uploader/jquery.fileupload.js') }}"></script>
<script src="{{ asset('style/new/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('style/new/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ asset('style/new/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $('.dropify').dropify();
            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });
        });
        $('#kalender').DataTable();

    });
    var kalender = @json($kalender);

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          events: kalender,
          textColor: '#000000'
        });
        calendar.render();
      });


  function displayMessage(message) {
    $(".response").html(""+message+"");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
  }
    // $('#file_import_valueknowledge_students').FancyFileUpload({
    //     params: {
    //         action: 'upload-valueknowledge-data'
    //     },
    //     maxfilesize: 1000000
    // });

    function ambilId(file){
        return document.getElementById(file);
    }

    $(document).ready(function(){
        $("#upload").click(function(){
            ambilId("progressBar").style.display = "block";
            var file = ambilId("file_kalender").files[0];

            if (file!="") {
                var formdata = new FormData();
                formdata.append("file", file);
                var ajax = new XMLHttpRequest();
                ajax.upload.addEventListener("progress", progressHandler, false);
                ajax.addEventListener("load", completeHandler, false);
                ajax.addEventListener("error", errorHandler, false);
                ajax.addEventListener("abort", abortHandler, false);
                ajax.open("POST", "upload.php");
                ajax.send(formdata);
            }
        });
        $("#btn_upload_kalender").click(function(){
            $("#overlay").fadeIn();
        })
    });

    function progressHandler(event){
        ambilId("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
        var percent = (event.loaded / event.total) * 100;
        ambilId("progressBar").value = Math.round(percent);
        ambilId("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }
    function completeHandler(event){
        ambilId("status").innerHTML = event.target.responseText;
        ambilId("progressBar").value = 0;
    }
    function errorHandler(event){
        ambilId("status").innerHTML = "Upload Failed";
    }
    function abortHandler(event){
        ambilId("status").innerHTML = "Upload Aborted";
    }
    $('#editmodal').on('show.bs.modal', function (e) {
        $(".de").html("");
        $(".idb").html("");
        var button = $(e.relatedTarget)
        var nisn = button.data('nisn')
        var id_student = button.data('id_student')
        var id_set_lesson = button.data('id_set_lesson')
        var name = button.data('name')
        var jml  = button.data('jml')
        var val = []
        var id_basic = []
        $(".de").append("<input type=hidden name=id_set_lesson value='"+id_set_lesson+"'><input type=hidden name=id_student value='"+id_student+"'>")
        $(".de").append("<td>"+nisn+"</td><td>"+name+"</td>");
        $(".idb").append("<input type=hidden name=name value='"+name+"'")
        for (let i = 0; i < jml; i++) {
            val.push(button.data('val_'+i))
            id_basic.push(button.data('id_basic_'+i))
            $(".idb").append("<input type=hidden name='id_basic[]' value='"+id_basic[i]+"'>")
            $(".de").append("<td><input class='form-control' name='value[]' type=number step='0.01' value='"+val[i]+"'></td>")
        }
        console.table(val);
        var modal = $(this)
      })
      $(".btn-close").click(function(){
          $("#editmodal").modal("hide");
      })
      $("#close-modal").click(function(){
          $("#editmodal").modal("hide");
      })
</script>
@endsection
