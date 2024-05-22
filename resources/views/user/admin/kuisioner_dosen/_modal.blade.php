<div id="add_modal_soal" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Tambah Soal Kuisioner Dosen</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <form action="" id="form_add_in" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label class="form-label">Kategori</label>
                            <select type="text" class="form-select form-select-add-in" name="kategori" id="kategori" data-placeholder="Pilih Kategori Soal" required data-parsley-trigger="change">
                                <option value=""></option>
                                <option value="Kompetensi Pedagogik">Kompetensi Pedagogik</option>
                                <option value="Kompetensi Profesional">Kompetensi Profesional</option>
                                <option value="Kompetensi Kepribadian">Kompetensi Kepribadian</option>
                                <option value="Kompetensi Sosial">Kompetensi Sosial</option>
                            </select>
                        </div>
                        <div class="form-group col-12 mt-2">
                            <label class="form-label">Soal</label>
                            <textarea name="desc" id="desc" class="form-control" placeholder="Masukan"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success waves-effect waves-light text-white btn_add_in"  data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
