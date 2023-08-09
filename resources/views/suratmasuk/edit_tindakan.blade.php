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
                        <option value="1">Diteruskan</option>
                        <option value="0">Tidak diteruskan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-adminlte-modal>
