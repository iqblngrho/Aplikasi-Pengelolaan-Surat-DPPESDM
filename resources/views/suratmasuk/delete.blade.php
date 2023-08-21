<x-adminlte-modal id="deleteSuratMasukModal" title="Hapus Surat Masuk" size="md" theme="danger" icon="fas fa-trash" v-centered
        static-backdrop scrollable>
        <div>Anda yakin ingin menghapus Surat ?</div>
        <x-slot name="footerSlot">
            <x-adminlte-button class="mr-auto" theme="success" label="Batal" data-dismiss="modal" />
            <x-adminlte-button theme="danger" label="Hapus" id="confirmDeleteBtn" />
        </x-slot>
    </x-adminlte-modal>
