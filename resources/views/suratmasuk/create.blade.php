<x-adminlte-modal id="tambahmodal" title="Tambah Surat Masuk" theme="navy" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>
    <div class="card">
        <div class="card-body">
            <form id="createForm" action="{{ route('suratmasuk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input id="nomor_surat" type="text" class="form-control" name="nomor_surat"
                                placeholder="Nomor Surat" required value="{{ old('nomor_surat') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tanggal_surat">Tanggal Surat</label>
                            <input id="tanggalsurat" type="date" class="form-control" name="tanggal_surat" required
                                value="{{ old('tanggal_surat') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="asal_surat">Asal Surat</label>
                            <input id="asal_surat" type="text" class="form-control" name="asal_surat"
                                placeholder="Asal Surat" required value="{{ old('asal_surat') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis">Jenis Surat</label>
                            <select id="jenis" class="form-control" name="jenis" value="{{ old('jenis') }}">>
                                <option selected disabled>Pilih Jenis Surat</option>
                                <option value="asli">Asli</option>
                                <option value="tembusan">Tembusan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lampiran">Lampiran</label>
                            <select id="lampiran" class="form-control" name="lampiran" value="{{ old('lampiran') }}">>
                                <option selected disabled>Pilih Lampiran</option>
                                <option value="0">0 Lampiran</option>
                                <option value="1">1 Lampiran</option>
                                <option value="2">2 Lampiran</option>
                                <option value="3">3 Lampiran</option>
                                <option value="4">4 Lampiran</option>
                                <option value="5">5 Lampiran</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sifat">Sifat</label>
                            <select id="sifat" class="form-control" name="sifat" value="{{ old('sifat') }}">>
                                <option selected disabled>Sifat</option>
                                <option value="segera">Segera</option>
                                <option value="sangat-segera">Sangat segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input id="perihal" type="text" class="form-control" name="perihal"
                                placeholder="Perihal" required value="{{ old('perihal') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="file">File</label>
                            <input id="file" type="file" class="form-control" name="file" required
                                value="{{ old('file') }}">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Tutup" data-dismiss="modal" />
                    <button type="button" class="btn btn-success" id="createSubmitBtn">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
