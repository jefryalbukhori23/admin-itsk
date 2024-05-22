@extends('layout.app')

@section('content')



{{-- Loading --}}

<div id="overlay">

  <div class="cv-spinner">

    <span class="spinner"></span><br>

    <h3 style="color: white;">Data Sedang di Proses...</h3>

  </div>

</div>



{{-- Content --}}

<div class="container-fluid">

  <div class="row">

    <div class="card">

      <div class="card-header">

        <h2 class="text-center"> Berita</h2>

        <div class="order-actions">

          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal">

            <i class="fa fa-plus"></i> Tambah Data

          </button>

        </div>

      </div>

      <div class="card-body">

        <div class="table-responsive">

          <table class="table table-striped" id="tabel">

            <thead>

              <tr>

                <th>No</th>

                <th>Judul</th>

                <th>Gambar</th>

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



{{-- Add Modal --}}

<div id="add_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"

  style="display: none;">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Form Tambah Berita</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

      </div>



      <form action="" id="form_add_berita" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="row">



            <div class="form-group col-12">

              <label class="form-label">Judul</label>

              <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Berita" required

                data-parsley-trigger="keyup">

            </div>



            <div class="form-group col-12">

              <label for="form-label">Gambar Cover</label>

              <input type="file" name="image" class="dropify" accept="image/*"

                data-allowed-file-extensions="png jpg jpeg" id="image">

            </div>



            <div class="form-group col-12">

              <label for="">Isi Berita</label>

              <textarea name="berita" id="desc" class="form-control" placeholder="Masukkan isi berita "></textarea>

            </div>



          </div>

        </div>

      </form>



      <div class="modal-footer">

        <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">

          Close

        </button>

        <button type="button" class="btn btn-success waves-effect waves-light text-white save_data">

          Save changes

        </button>

      </div>

    </div>

  </div>

</div>



{{-- Edit Modal --}}

<div id="edit_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"

  style="display: none;">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Form Edit Berita</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

      </div>

      <form action="" id="form_edit_berita" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <input type="hidden" name="id" id="id_edit">

        <div class="modal-body">

          <div class="row">



            <div class="form-group col-12">

              <label class="form-label">Judul</label>

              <input type="text" class="form-control" name="judul" id="judul_edit" placeholder="Judul Berita" required

                data-parsley-trigger="keyup">

            </div>



            <div class="form-group col-12">

              <label for="form-label">Gambar Cover</label>

              <input type="file" name="image" class="dropifys" accept="image/*"

                data-allowed-file-extensions="png jpg jpeg" id="image">

            </div>



            <div class="form-group col-12">

              <label for="">Isi Berita</label>

              <textarea name="berita" id="desc_edit" class="form-control" placeholder="Masukkan isi berita "></textarea>

            </div>

          </div>

      </form>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">

          Close

        </button>

        <button type="button" class="btn btn-success waves-effect waves-light text-white edit_data">

          Save changes

        </button>

      </div>

    </div>

  </div>

</div>



{{-- Show Modal --}}

<div id="detail_modal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"

  style="display: none;">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title">Detail Berita</h4>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>

      </div>



      <div class="d-flex align-items-md-start align-items-center flex-column flex-md-row" style="padding: 1%;">

        <div class="media-body ms-md-5 m-0 mt-4 mt-md-0 text-md-start text-center">

          <p>

            <b>Keterangan : </b>

            <span id="keterangan_detail"></span>

          </p>

          <p>

            <b>Isi berita : </b>

          </p>

          <div id="isi_berita_detail">



          </div>

        </div>

      </div>



      <div class="modal-footer">

        <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">

          Close

        </button>

        <button type="button" class="btn btn-info waves-effect waves-light text-white history_pj" data-bs-toggle="modal"

          id="#btn_pj_history" data-bs-target="#history_pj_modal">

          Lihat Histori PJ

        </button>

      </div>

    </div>

  </div>

</div>



<input type="hidden" id="same_edit" value="no">



{{-- Script --}}

<script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

<script>

  $(document).ready(function () {

    let id_berita

    var table = $('#tabel').DataTable({

      processing: true,

      serverSide: true,

      language: {

        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '

      },

      ajax: "{{ url('get-berita') }}",

      columns: [

        { data: 'DT_RowIndex', name: 'DT_RowIndex' },

        { data: 'judul', name: 'judul' },

        { data: 'image', name: 'image'},

        {

          data: 'action',

          name: 'action',

          orderable: true,

          searchable: true

        },

      ]

    });



    $('#form_add_berita').parsley();

    $('#form_edit_berita').parsley();



    // Select2

    $(".add-select").select2({

      dropdownParent: $('#add_modal')

    })



    $(".edit-select").select2({

      dropdownParent: $('#edit_modal')

    })  



    // Dropify

    $(function () {

      $('.dropify').dropify();

        var drEvent = $('#dropify-event').dropify();

        drEvent.on('dropify.beforeClear', function (event, element) {

        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");

        });

        drEvent.on('dropify.afterClear', function (event, element) {

        alert('File deleted');

      });

    });



    // CKEditor

    let editor

    

    ClassicEditor

      .create( document.querySelector('#desc'), {

        updateSourceElementOnDestroy: true

      }).then(newEditor=> {

        editor = newEditor

      })

      .catch( error => {

        console.error( error );

      });

    

    let YourEditor

    

    ClassicEditor

      .create(document.querySelector('#desc_edit'))

      .then(editor => {

        window.editor = editor;

        YourEditor = editor;

      })



    // Save data

    $("body").on('click', '.save_data', function () {

      const editorData = editor.getData();

      if ($('#form_add_berita').parsley().isValid()) {

        $("#add_modal .close").click();

        $("#overlay").fadeIn();

        var url_save = "{{route('berita.store')}}";



        var form = $('#form_add_berita')[0];

        var data = new FormData(form);

        data.append('berita', editorData)

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

          type: 'POST',

          url: url_save,

          enctype: 'multipart/form-data',

          processData: false,

          data: data,

          contentType: false,

          cache: false,

          success: function (response) {

            $("#judul").val('');

            swal.fire({

              icon: 'success',

              title: 'Data berita ditambahkan!',

              timer: 1500,

            });

            $('#tabel').DataTable().ajax.reload();

            $("#overlay").fadeOut();

            editor.setData('');
            $(".dropify-clear").trigger("click");

          },

          error:function(){

          $("#overlay").fadeOut();

          swal.fire({

          icon:'error',

          title: 'ada kesalahan sistem',

          text: 'Silahkan coba lagi',

          });

          }

        })



      } else {

        swal.fire({

          icon: 'error',

          title: 'Ada data yang salah',

        })

      }

    })



    // Edit data

    $("body").on('click', '.edit', function () {

      var id = $(this).val();

      var url_detail = "{{ route('berita.show', ':id') }}";

      url_detail = url_detail.replace(':id', id);

      $("#id_edit").val(id);

      $.ajax({

        type: 'GET',

        url: url_detail,

        success: function (response) {

          var image_file = "{{ url('image/berita/:img') }}";

          image_file = image_file.replace(':img', response.berita.image);

          $("#image_edit").attr('data-default-file', image_file);

          var drEvent = $('.dropifys').dropify({defaultFile: image_file});

          drEvent = drEvent.data('dropify');



          $("#judul_edit").val(response.berita.judul);

          $("#berita_edit").val(response.berita.berita);

          YourEditor.setData(response.berita.berita);

        },

        error:function(){

        $("#overlay").fadeOut();

        swal.fire({

        icon:'error',

        title: 'ada kesalahan sistem',

        text: 'Silahkan coba lagi',

        });

        }

      })

    });



    $("body").on('click', '.edit_data', function () {

      const editorData = YourEditor.getData();

      var id = $("#id_edit").val();

      var url_update = "{{ route('berita.update', ':id') }}";

      url_update = url_update.replace(':id', id);

      var form = $('#form_edit_berita')[0];

      var data = new FormData(form);

      data.append('berita', editorData)

      

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });



      if ($('#form_edit_berita').parsley().isValid()) {

        $("#edit_modal .close").click();

        $("#overlay").fadeIn();

        

        $.ajax({

          type: 'POST',

          url: url_update,

          enctype: 'multipart/form-data',

          processData: false,

          data: data,

          contentType: false,

          cache: false,

          success: function (response) {

            $("#name").val('');

            swal.fire({

              icon: 'success',

              title: 'Data berita diupdate!',

            });

            $('#tabel').DataTable().ajax.reload();

            $("#overlay").fadeOut();

            $('#form_edit_berita')[0].reset();

          },

          error:function(){

          $("#overlay").fadeOut();

          swal.fire({

          icon:'error',

          title: 'ada kesalahan sistem',

          text: 'Silahkan coba lagi',

          });

          }

        })



        } else {

          swal.fire({

            icon: 'error',

            title: 'Ada data yang salah',

          })

      }

    })



    // Delete data

    $("body").on('click', '.hapus', function () {

      Swal.fire({

        icon: 'question',

        title: 'Apakah Anda Yakin Untuk Menghapus Data ini?',

        showDenyButton: true,

        confirmButtonText: 'Iya',

        denyButtonText: 'Batal',

      }).then(result => {

        if (result.isConfirmed) {

          $("#overlay").fadeIn();

          var id = $(this).val();

          var url_delete = "{{ route('berita.destroy', ':id') }}";

          url_delete = url_delete.replace(':id', id);



          $.ajax({

            type: 'DELETE',

            url: url_delete,

            data: {

            _token: '{{csrf_token()}}'

            },

            success: function (response) {

              swal.fire({

                icon: 'success',

                title: 'Hapus data berhasil',

                timer: 1500,

            });

            $('#tabel').DataTable().ajax.reload();

            $("#overlay").fadeOut();

            },

            error:function(){

            $("#overlay").fadeOut();

            swal.fire({

            icon:'error',

            title: 'ada kesalahan sistem',

            text: 'Silahkan coba lagi',

            });

            }

          })

        }else{

          swal.fire({

            icon: 'info',

            title: 'Aksi dibatalkan',

          });

        }

      })

    });



    // Detail data

    $("body").on('click', '.detail',function () {

      var id = $(this).val();

      id_berita = id

      var url_detail = "{{ route('berita.show', ':id') }}";

      url_detail = url_detail.replace(':id', id);

      $.ajax({

        type: "GET",

        url: url_detail,

        dataType: "JSON",

        success: function (response) {

          $("#keterangan_detail").text(response.berita.keterangan);

          $("#isi_berita_detail").html(response.berita.isi_berita);

        },

        error:function(){

        $("#overlay").fadeOut();

        swal.fire({

        icon:'error',

        title: 'ada kesalahan sistem',

        text: 'Silahkan coba lagi',

        });

        }

      });

    });

    

  });



</script>

@endsection