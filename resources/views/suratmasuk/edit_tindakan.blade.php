<x-adminlte-modal id="editTindakan{{ $row->id }}" title="Edit Surat Masuk" theme="navy"
    icon="fas fa-solid fa-file-medical" size='lg' v-centered scrollable>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit Surat Masuk</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('suratmasuk.updateTindakan', $row->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Tindakan</label>
                    <select id="tindakan" class="form-control" name="tindakan">>
                        <option value="1">Diteruskan</option>
                        <option value="0">Tidak diteruskan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</x-adminlte-modal>
{{-- <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-edit').on('click', function(event) {

            var id = $(this).data('id');

            $.get(`suratmasuk/${id}`, function(surat) {
                $('#tindakan').val(surat.tindakan);
                // Note: File input can't be set directly due to security reasons
            })
        });
    })
</script> --}}
