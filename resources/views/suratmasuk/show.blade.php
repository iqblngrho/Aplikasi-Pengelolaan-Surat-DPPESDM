{{-- Modal View Surat Masuk --}}
<x-adminlte-modal id="detailmodal" title="DETAIL SURAT MASUK" theme="navy" icon="fa fa-lg fa-fw fa-info-circle"
    size='lg' disable-animations>
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="NOMOR AGENDA" theme="secondary">
                <table class="table table-sm table-hover">
                    <tr>
                        <td>No</td>
                        <td class="id"></td>
                    </tr>
                    <tr>
                        <td>Sifat</td>
                        <td class="sifat"></td>
                    </tr>
                    <tr>
                        <td>Tanggal Diterima</td>
                        <td class="tanggal_masuk"></td>
                    </tr>
                </table>
            </x-adminlte-card>
        </div>


        <div class="col-md-6">
            <x-adminlte-card id="detailsurat" title="INFORMASI TAMBAHAN" theme="success">
                <table class="table table-sm table-hover">
                    <tr>
                        <td style="width: 40%;">Catatan</td>
                        <td class="catatan"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Catatan Kadis</td>
                        <td class="catatanKadis"></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;">Tindakan</td>
                        <td><span class="badge tindakan"></span></td>
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
                <td>Lampiran</td>
                <td class="lampiran"></td>
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
</x-adminlte-modal>
{{-- End Modal View Surat Masuk --}}
