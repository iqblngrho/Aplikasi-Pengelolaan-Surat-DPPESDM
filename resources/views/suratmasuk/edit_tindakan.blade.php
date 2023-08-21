<x-adminlte-modal id="editTindakan" title="Tambah Tindakan Surat Masuk" theme="navy" icon="fas fa-solid fa-file-medical"
    size='lg' v-centered scrollable>

    <div class="card">
        <div class="card-body">
            <form id="editTindakanForm" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan">>
                        <option selected disabled>Pilih Tindakan</option>
                        <option value="{{ TERUSKAN }}">Diteruskan</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Tutup" data-dismiss="modal" />
                    <button type="button" class="btn btn-success" id="editTindakanSubmitBtn">Simpan</button>
                </x-slot>
            </form>
        </div>
    </div>
</x-adminlte-modal>
