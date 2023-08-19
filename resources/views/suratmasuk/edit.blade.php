<x-adminlte-modal id="editmodal" title="Edit Surat Masuk" theme="navy" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>
    <div class="card">
        <div class="card-body">
            <form id="editForm" action="{{ route('suratmasuk.update', $row->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editNomorSurat">Nomor Surat</label>
                            <input id="editNomorSurat" type="text" class="form-control" name="nomor_surat"
                                placeholder="Nomor Surat" required>
                        </div>
                        <div class="form-group">
                            <label for="editAsalSurat">Asal Surat</label>
                            <input id="editAsalSurat" type="text" class="form-control" name="asal_surat"
                                placeholder="Asal Surat" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editTanggalSurat">Tanggal Surat</label>
                            <input id="editTanggalSurat" type="date" class="form-control" name="tanggal_surat"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editTanggalTerima">Tanggal Masuk</label>
                            <input disabled id="editTanggalTerima" type="datetime-local" class="form-control" name="tanggal_diterima">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="editJenis">Jenis Surat</label>
                            <select id="editJenis" class="form-control" name="jenis">
                                <option value="asli">Asli</option>
                                <option value="tembusan">Tembusan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lampiran</label>
                            <select id="editLampiran" class="form-control" name="lampiran">
                                <option value="0">0 Lampiran</option>
                                <option value="1">1 Lampiran</option>
                                <option value="2">2 Lampiran</option>
                                <option value="3">3 Lampiran</option>
                                <option value="4">4 Lampiran</option>
                                <option value="5">5 Lampiran</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sifat</label>
                            <select id="editSifat" class="form-control" name="sifat">
                                <option value="segera">Segera</option>
                                <option value="sangat-segera">Sangat segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="editPerihal">Perihal</label>
                            <input id="editPerihal" type="text" class="form-control" name="perihal"
                                placeholder="Perihal" required>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input id="editFile" type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Tutup"  data-dismiss="modal" />
                    <button type="button" class="btn btn-success"  id="editSubmitBtn">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
