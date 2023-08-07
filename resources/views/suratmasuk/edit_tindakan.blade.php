<x-adminlte-modal id="editTindakan{{ $row->id }}" title="Tambah Tindakan Surat Masuk" theme="navy"
    icon="fas fa-solid fa-file-medical" size='lg' v-centered scrollable>

    <div class="card">

        <div class="card-body">
            <form action="{{ route('suratmasuk.updateTindakan', $row->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan">>
                        <option selected>Pilih Tindakan</option>
                        <option value="teruskan">Diteruskan</option>
                        <option value="tidak-teruskan">Tidak diteruskan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
</x-adminlte-modal>
