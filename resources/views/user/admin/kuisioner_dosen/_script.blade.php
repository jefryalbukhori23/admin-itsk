<script src="{{asset('style/assets/ckeditor/script.js')}}"></script>
<script>
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + ribuan;
    }
    CKEDITOR.ClassicEditor.create(document.getElementById("desc"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'exportPDF','exportWord', '|',
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                'textPartLanguage', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Tuliskan Soal',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: 'desc',
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType
            'MathType'
        ]
    }).then( editor => {
        // console.log( 'Editor was initialized', editor );
        myEditor = editor;
    } );

    function resetEditor() {
        const originalContent = "";
        myEditor.setData(originalContent);
    }
    $(document).ready(function(){
        $("#lecture_laporan").fadeOut();
        $(document).ajaxError(function() {
            swal.fire({
                icon : 'error',
                html : '<h3>Ada Kesalahan sistem</h3><br><b>silahkan coba lagi </b><br><p>Jika pesan ini masih muncul , silahkan reload halaman!</p>',
                timer: 1500,
            })
            $('#overlay').hide();
        });

        $(".form-select-add-in").select2({
            dropdownParent: $("#add_modal_soal")
        })
        $(".form-select-add-out").select2({
            dropdownParent: $("#add_modal_out")
        })
        $(".form-select-edit").select2({
            dropdownParent: $("#edit_modal")
        })
        $(".form-select-filter").select2();

        var tabel_soal = $('#tabel_soal').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-soal_kuisioner_dosen') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'kategori', name: 'kategori'},
                {data: 'soal', name: 'soal'},
                {data: 'action', name: 'action'},
            ]
        });
        var tabel_hasil = $('#tabel_hasil').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-hasil_kuisioner_dosen/null/null/null') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'by', name: 'by'},
                {data: 'semester', name: 'semester'},
                {data: 'dosen', name: 'dosen'},
                {data: 'mahasiswa', name: 'mahasiswa'},
                {data: 'nilai', name: 'nilai'},
                {data: 'action', name: 'action'},
            ],
            beforeSend: function(xhr) {
                // track the current AJAX request
                currentRequest = xhr;
            },
            complete: function() {
                // reset the current AJAX request when it completes
                currentRequest = null;
            }
        });

        var currentRequest = null;

        $("#by_select").change(function(){
            var id_by = $("#by_select").val();
            var semester = $("#semester_select").val();
            var id_lecture = $("#lecture_select").val();

            if(semester == "" || semester == null){
                semester = "all";
            }else{
                semester = $("#semester_select").val();
            }

            if(id_lecture == "" || id_lecture == null){
                id_lecture = "all";
            }else{
                id_lecture = $("#lecture_select").val();
            }

            $("#semester_select").val([]).trigger('change');
            $("#lecture_select").val([]).trigger('change');

            var url_data = "{{url('get-hasil_kuisioner_dosen/{id_by}/{semester}/{id_lecture}')}}";
            url_data = url_data.replace('{id_by}',id_by);
            url_data = url_data.replace('{semester}',semester);
            url_data = url_data.replace('{id_lecture}',id_lecture);

            if (currentRequest !== null) {
                currentRequest.abort(); // abort previous AJAX request if one exists
            }
            $('#tabel_hasil').DataTable().ajax.url(url_data).load();

        })
        $("#semester_select").change(function(){
            if($(this).val() != null){
                var id_by = $("#by_select").val();
                var semester = $("#semester_select").val();
                var id_lecture = $("#lecture_select").val();

                if(semester == "" || semester == null){
                    semester = "all";
                }else{
                    semester = $("#semester_select").val();
                }

                if(id_lecture == "" || id_lecture == null){
                    id_lecture = "all";
                }else{
                    id_lecture = $("#lecture_select").val();
                }

                $("#lecture_select").val([]).trigger('change');

                var url_data = "{{url('get-hasil_kuisioner_dosen/{id_by}/{semester}/{id_lecture}')}}";
                url_data = url_data.replace('{id_by}',id_by);
                url_data = url_data.replace('{semester}',semester);
                url_data = url_data.replace('{id_lecture}',id_lecture);
               if (currentRequest !== null) {
                    currentRequest.abort(); // abort previous AJAX request if one exists
                }
                $('#tabel_hasil').DataTable().ajax.url(url_data).load();
            }
        })

        $("#lecture_select").change(function(){
           if($(this).val() != null){
                var id_by = $("#by_select").val();
                var semester = $("#semester_select").val();
                var id_lecture = $("#lecture_select").val();

                if(semester == "" || semester == null){
                    semester = "all";
                }else{
                    semester = $("#semester_select").val();
                }

                if(id_lecture == "" || id_lecture == null){
                    id_lecture = "all";
                }else{
                    id_lecture = $("#lecture_select").val();
                }

                var url_data = "{{url('get-hasil_kuisioner_dosen/{id_by}/{semester}/{id_lecture}')}}";
                url_data = url_data.replace('{id_by}',id_by);
                url_data = url_data.replace('{semester}',semester);
                url_data = url_data.replace('{id_lecture}',id_lecture);

                if (currentRequest !== null) {
                    currentRequest.abort(); // abort previous AJAX request if one exists
                }
                $('#tabel_hasil').DataTable().ajax.url(url_data).load();
            }
        })
        tabel_hasil.on('xhr.dt', function(e, settings, json, xhr) {
            xhr = null; // reset xhr variable when AJAX request completes
        });
        $('#form_add_in').parsley();
        $('#form_add_out').parsley();
        $('#form_edit').parsley();

        $("body").on('click','.btn_add_in',function(){
            if($('#form_add_in').parsley().isValid()){
                $("#add_modal_in .close").click();
                $("#overlay").fadeIn();
                var url_save = '{{route('kuisioner_dosen.store')}}';

                var desc = myEditor.getData();
                var form = $('#form_add_in')[0];
                var data = new FormData(form);
                data.append('soal', desc);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        swal.fire({
                            icon: 'success',
                            title: 'Data transaksi masuk berhasil ditambahkan!',
                            timer: 1500,
                        });
                        $('#tabel_soal').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_add_in')[0].reset();
                        $("#kategori").val([]).trigger("change");
                        resetEditor();
                    }
                })

            }else{
                swal.fire({
                    icon:'error',
                    title: 'Ada data yang salah',
                })
            }
        })
        $("body").on('click','.edit', function(){
            var id = $(this).val();
            var url_show = "{{route('kuisioner_dosen.show',':id')}}";
            url_show = url_show.replace(':id',id);
            $.ajax({
                type:'GET',
                url: url_show,
                success:function(res){
                    $("#code_edit").val(res.data['code']);
                    $("#name_edit").val(res.data['name']);
                    $("#desc_edit").val(res.data['desc']);
                    $("#pic_edit").val(res.data['pic']);
                    $("#price_edit").val(res.data['price']);
                    $("#id_edit").val(res.data['id']);
                    $("#id_kategori_kuisioner_dosen_edit").val([res.data["id_kategori_kuisioner_dosen"]]).trigger("change");
                    var image_file = "{{ url('image/kuisioner_dosen/:img') }}";
                    image_file = image_file.replace(':img',res.data["image"]);
                    $("#image_edit").attr('data-default-file',image_file);
                    var drEvent = $('.dropifys').dropify(
                    {
                        defaultFile: image_file
                    });
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();
                    drEvent.settings.defaultFile = image_file;
                    drEvent.destroy();
                    drEvent.init();

                }
            })
        })
        $("body").on('click','.btn_edit',function(){
            if($('#form_edit').parsley().isValid()){
                $("#edit_modal .close").click();
                $("#overlay").fadeIn();
                var id = $("#id_edit").val();
                var url_save = "{{route('kuisioner_dosen.update',':id')}}";
                url_save = url_save.replace(':id',id);
                var form = $('#form_edit')[0];
                var data = new FormData(form);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : 'POST',
                    url : url_save,
                    enctype: 'multipart/form-data',
                    processData: false,
                    data: data,
                    contentType: false,
                    cache: false,
                    success:function(response){
                        swal.fire({
                            icon: 'success',
                            title: 'Data kategori kuisioner_dosen berhasil diupdate!',
                            timer: 1500,
                        });
                        $('#tabel').DataTable().ajax.reload();
                        $("#overlay").fadeOut();
                        $('#form_edit')[0].reset();
                    }
                })

            }else{
                swal.fire({
                    icon:'error',
                    title: 'Ada data yang salah',
                })
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
                    $("#overlay").fadeIn();
                    var id = $(this).val();
                    var url_delete = "{{ route('kuisioner_dosen.destroy', ':id') }}";
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
                                timer: 1500,
                            });
                            $('#tabel_soal').DataTable().ajax.reload();
                            $("#overlay").fadeOut();
                        }
                    })
                }else{
                    swal.fire({
                        icon: 'info',
                        title : 'Aksi dibatalkan',
                    });
                    $("#overlay").fadeOut();
                }
            });
        });

        var tabel_laporan_soal = $('#tabel_laporan_soal').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-laporan-kuisioner-soal/0/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'soal', name: 'soal'},
                {data: 'total', name: 'total'},
                {data: 'hasil', name: 'hasil'},
                {data: 'keterangan', name: 'keterangan'},
            ]
        });
        var tabel_laporan_dosen = $('#tabel_laporan_dosen').DataTable({
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            ajax: "{{ url('get-laporan-kuisioner-dosen/0/0') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'dosen', name: 'dosen'},
                {data: 'total', name: 'total'},
                {data: 'keterangan', name: 'keterangan'},
            ]
        });
        $("#by_select_laporan").change(function(){
            var id_by = $(this).val();
            var url_sub = "{{url('get-sub-by/{id}')}}";
            url_sub = url_sub.replace('{id}',id_by);
            $.ajax({
                type : 'GET',
                url : url_sub,
                success:function(res){
                    $("#sub_by_select_laporan").empty();
                    $("#sub_by_select_laporan").append('<option></option>');;
                    $.each(res.sub_by, function(key,item){
                        $("#sub_by_select_laporan").append('<option value="'+item.id+'">'+item.code+' - '+item.name+'</option>');
                    })
                }
            })
            $("#lecture_laporan").prop('disabled',true);
            $("#btn_filter_dosen_laporan").prop('disabled',true);
            var url_data_dosen = "{{ url('get-laporan-kuisioner-dosen/0/0') }}";
            $('#tabel_laporan_dosen').DataTable().ajax.url(url_data_dosen).load();
            $("#btn_laporan_dosen").attr('href',"#");
            $('#btn_laporan_dosen').removeAttr('target');
        })

        $("#btn_filter").click(function(){
            var id_by = $("#by_select_laporan").val();
            var id_sub_by = $("#sub_by_select_laporan").val();
            if(id_sub_by == null || id_sub_by == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Harap pilih semua filter !',
                });
                $("#btn_filter_dosen_laporan").prop('disabled',true);
                $("#lecture_laporan").prop('disabled',true);
            }else{

                $("#btn_filter_dosen_laporan").prop('disabled',false);
                $("#lecture_laporan").prop('disabled',false);

                var url_data_dosen = "{{url ('get-laporan-kuisioner-dosen/{id_by}/{id_sub_by}')}}";
                url_data_dosen = url_data_dosen.replace('{id_by}',id_by);
                url_data_dosen = url_data_dosen.replace('{id_sub_by}',id_sub_by);
                $('#tabel_laporan_dosen').DataTable().ajax.url(url_data_dosen).load();

                var url_report_dosen = "{{url ('report-laporan-kuisioner-dosen/{id_by}/{id_sub_by}')}}";
                url_report_dosen = url_report_dosen.replace('{id_by}',id_by);
                url_report_dosen = url_report_dosen.replace('{id_sub_by}',id_sub_by);
                $("#btn_laporan_dosen").attr('href',url_report_dosen);
                $('#btn_laporan_dosen').attr('target', '_blank');

            }
        })

        $("#btn_filter_dosen_laporan").click(function(){
            var id_by = $("#by_select_laporan").val();
            var id_sub_by = $("#sub_by_select_laporan").val();
            var id_lecture = $("#lecture_laporan").val();
            if(id_lecture == null || id_lecture == ""){
                swal.fire({
                    icon : 'error',
                    title : 'Harap pilih Dosen terlebih dahulu !',
                });
            }else{
                var url_data_soal = "{{url ('get-laporan-kuisioner-soal/{id_by}/{id_sub_by}/{id_lecture}')}}";
                url_data_soal = url_data_soal.replace('{id_by}',id_by);
                url_data_soal = url_data_soal.replace('{id_sub_by}',id_sub_by);
                url_data_soal = url_data_soal.replace('{id_lecture}',id_lecture);
                $('#tabel_laporan_soal').DataTable().ajax.url(url_data_soal).load();

                var url_report_soal = "{{url ('report-laporan-kuisioner-soal/{id_by}/{id_sub_by}/{id_lecture}')}}";
                url_report_soal = url_report_soal.replace('{id_by}',id_by);
                url_report_soal = url_report_soal.replace('{id_sub_by}',id_sub_by);
                url_report_soal = url_report_soal.replace('{id_lecture}',id_lecture);
                $("#btn_laporan_soal").attr('href',url_report_soal);
                $('#btn_laporan_soal').attr('target', '_blank');
            }
        });
    })
</script>
