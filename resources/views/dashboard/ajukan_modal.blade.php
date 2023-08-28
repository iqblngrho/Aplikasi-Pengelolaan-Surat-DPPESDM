<x-adminlte-modal id="ajukanModal" title="Ajukan" theme="navy" icon="fas fa-solid fa-file-medical" size='lg' v-centered
    scrollable>
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="NOMOR AGENDA" theme="secondary">
                <table class="table table-sm table-hover">
                    <tr>
                        <td>No Agenda</td>
                        <td class="id"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Diterima</td>
                        <td class="tanggal_masuk"></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td class="lampiran"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>


        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="success">
                <table class="table table-sm table-hover">
                    <tr>
                        <td style="width: 40%;">Sifat</td>
                        <td class="sifat"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Jenis</td>
                        <td class="jenis"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>
    </div>

    <x-adminlte-card id="detailsurat" title="DATA SURAT" theme="navy">
        <table class="table table-sm">
            <tr>
                <td>Nomor Surat</td>
                <td class="nomor_surat"></td>
            </tr>
            <tr>
                <td>Asal Surat</td>
                <td class="asal_surat"></td>
            </tr>
            <tr>
                <td>Perihal Surat</td>
                <td class="perihal"></td>
            </tr>
            <tr>
                <td>Tanggal Surat</td>
                <td class="tanggal_surat"></td>
            </tr>
            <tr>
                <td>File</td>
                <td>
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow pdfViewerBtn"
                        title="Lihat File">Lihat PDF
                        <i class="fas fa-regular fa-eye"></i>
                    </button>
                </td>
            </tr>
        </table>
    </x-adminlte-card>
    <div class="card">
        <div class="card-body">
            <div class="pdfContainer">
                <iframe class="pdfViewer" style="width: 100%; height: 500px;"></iframe>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form id="ajukanForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group" id="catatanContainer">
                    <label>Catatan</label>
                    <x-adminlte-textarea name="catatan" placeholder="Tambah catatan" id="catatan" />
                </div>

                <div class="form-group">
                    <label for="tindakan">TindakanSurat</label>
                    <select id="tindakan" class="form-control" name="tindakan">
                        <option value="" selected disabled>Pilih TindakanSurat</option>
                        <option value="{{ REVISI }}">Koreksi kembali</option>
                        <option value="{{ TINDAK_LANJUT }}">Tindak Lanjut ke Kepala Dinas</option>
                    </select>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Tutup" data-dismiss="modal" />
                    <button id="btn-ajukan-submit" type="button" class="btn btn-success update">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
