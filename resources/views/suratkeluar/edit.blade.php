<x-adminlte-modal id="editmodalSK" title="Edit Surat Masuk" theme="navy" icon="fas fa-solid fa-file-medical" size='lg'
    v-centered scrollable>
    <div class="card">
        <div class="card-body">
            <form id="editFormSK" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editNomorSuratKeluar">Nomor Surat</label>
                            <input id="editNomorSuratKeluar" type="text" class="form-control" name="nomor_surat"
                                placeholder="Nomor Surat" required>
                        </div>
                        <div class="form-group">
                            <label for="editAlamatTujuanSuratKeluar">Alamat Tujuan</label>
                            <input id="editAlamatTujuanSuratKeluar" type="text" class="form-control"
                                name="alamat_tujuan" placeholder="Alamat Tujuan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editTanggalSuratKeluar">Tanggal Surat</label>
                            <input id="editTanggalSuratKeluar" type="date" class="form-control" name="tanggal_surat"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="editSifatSuratKeluar">Jenis Surat</label>
                            <select id="editSifatSuratKeluar" class="form-control" name="sifat">
                                <option value="Penting">Penting</option>
                                <option value="Sangat Penting">Sangat Penting</option>
                                <option value="Biasa">Biasa</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lampiran</label>
                            <select id="editLampiranSuratKeluar" class="form-control" name="lampiran">
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
                            <label>Bidang</label>
                            <select class="form-control" id="editBidangSuratKeluar" name="id_bidang">
                                @foreach ($bidang as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->bidang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="editPerihalSuratKeluar">Perihal</label>
                            <input id="editPerihalSuratKeluar" type="text" class="form-control" name="perihal"
                                placeholder="Perihal" required>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input id="editFileSuratKeluar" type="file" class="form-control" name="file" required>
                        </div>
                    </div>
                </div>

                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Tutup" data-dismiss="modal" />
                    <button type="button" class="btn btn-success" id="editSubmitBtnSK">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
