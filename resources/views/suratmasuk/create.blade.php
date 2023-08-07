<x-adminlte-modal id="tambahmodal" title="Tambah Surat Masuk" theme="navy" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nomor Surat</label>
                    <input id="nomorsurat" type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat"
                        required value="{{ old('nomor_surat') }}">
                </div>
                <div class="form-group">
                    <label>Asal Surat</label>
                    <input id="alamatsurat" type="text" class="form-control" name="asal_surat"
                        placeholder="Alamat Surat" required value="{{ old('asal_surat') }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Surat</label>
                    <input id="tanggalsurat" type="date" class="form-control" name="tanggal_surat" required
                        value="{{ old('tanggal_surat') }}">
                </div>
                <div class="form-group">
                    <label>Perihal</label>
                    <input id="perihal" type="text" class="form-control" name="perihal" placeholder="Perihal"
                        required value="{{ old('perihal') }}">
                </div>
                <div class="form-group">
                    <label>File</label>
                    <input id="file" type="file" class="form-control" name="file" required
                        value="{{ old('file') }}">
                </div>
                <div class="form-group">
                    <label>Jenis Surat</label>
                    <select id="jenis" class="form-control" name="jenis" value="{{ old('jenis') }}">>
                        <option selected>Pilih Jenis Surat</option>
                        <option value="asli">Asli</option>
                        <option value="tembusan">Tembusan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lampiran</label>
                    <select id="lampiran" class="form-control" name="lampiran" value="{{ old('lampiran') }}">>
                        <option selected>Pilih Lampiran</option>
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
                    <select id="sifat" class="form-control" name="sifat" value="{{ old('sifat') }}">>
                        <option selected>Sifat</option>
                        <option value="segera">Segera</option>
                        <option value="sangat-segera">Sangat segera</option>
                        <option value="biasa">Biasa</option>
                    </select>
                </div>
                {{-- <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan" value="{{ old('tindakan') }}">>
                        <option selected>Pilih Tindakan</option>
                        <option value="diteruskan">Diteruskan</option>
                        <option value="tidak-diteruskan">Tidak diteruskan</option>
                    </select>
                </div> --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-adminlte-modal>
