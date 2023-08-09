<x-adminlte-modal id="editmodal{{$row->id}}" title="Edit Surat Masuk" theme="navy"  icon="fas fa-solid fa-file-medical" size='lg'
    v-centered  scrollable>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Surat Masuk</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('suratmasuk.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required
                        value="{{ $row->nomor_surat }}">
                </div>
                <div class="form-group">
                    <label>Alamat Surat</label>
                    <input type="text" class="form-control" name="asal_surat" placeholder="Alamat Surat" required
                        value="{{ $row->asal_surat }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input type="date" class="form-control" name="tanggal_surat" required
                        value="{{ $row->tanggal_surat }}">
                </div>
                <div class="form-group">
                    <label>Perihal</label>
                    <input type="text" class="form-control" name="perihal" placeholder="Perihal" required
                        value="{{ $row->perihal }}">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input type="file" class="form-control" name="file" required value="{{ $row->file }}">
                </div>
                
                <div class="form-group">
                    <label>Jenis Surat</label>
                    <select id="jenis" class="form-control" name="jenis" value="{{ $row->jenis }}">>
                        <option selected>{{ $row->jenis }}</option>
                        <option value="asli">Asli</option>
                        <option value="tembusan">Tembusan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lampiran</label>
                    <select id="lampiran" class="form-control" name="lampiran" value="{{ $row->lampiran }}">>
                        <option selected>{{$row->lampiran}}</option>
                        <option value="0">0 Lampiran</option>
                        <option value="1">1 Lampiran</option>
                        <option value="2">2 Lampiran</option>
                        <option value="3">3 Lampiran</option>
                        <option value="4">4 Lampiran</option>
                        <option value="5">5 Lampiran</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sifat</label>
                    <select id="sifat" class="form-control" name="sifat" value="{{ $row->sifat }}">>
                        <option selected>{{ $row->sifat }}</option>
                        <option value="segera">Segera</option>
                        <option value="sangat-segera">Sangat segera</option>
                        <option value="biasa">Biasa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan" value="{{ $row->tindakan }}">>
                        <option selected>{{ $row->tindakan }}</option>
                        <option value="diteruskan">Diteruskan</option>
                        <option value="tidak-diteruskan">Tidak diteruskan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-adminlte-modal>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-edit').on('click', function(event) {

            var id = $(this).data('id');

            $.get(`suratmasuk/${id}`, function(surat) {
                $('#id').val(surat.id);
                $('#nomor_surat').val(surat.nomor_surat);
                $('#tanggal_surat').val(surat.tanggal_surat);
                $('#alamat_surat').val(surat.asal_surat);
                $('#tanggal_masuk').val(surat.tanggal_diterima);
                $('#perihal').val(surat.perihal);
                $('#status').val(surat.status);
                $('#lampiran').val(surat.lampiran);
                $('#tindakan').val(surat.tindakan);
                $('#sifat').val(surat.sifat);
                // Note: File input can't be set directly due to security reasons
            })
        });
    })
</script>

