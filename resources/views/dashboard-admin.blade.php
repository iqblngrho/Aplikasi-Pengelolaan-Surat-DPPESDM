<div>
    <x-adminlte-datatable id="table5" :heads="$heads">
        @foreach ($suratMasuk as $row)
            <tr>
                <td> {{ $row->id }}</td>
                <td> {{ $row->nomor_surat }}</td>
                {{-- <td>{!! $row->id !!}</td>
                <td>{!! $row->alamat_surat !!}</td>
                <td>{!! $row->nomor_surat !!}</td>
                <td>{!! $row->tanggal_surat !!}</td>
                <td>{!! $row->perihal !!}</td>
                <td>{!! $row->tanggal_diterima !!}</td> --}}
                <td>
                    @if ($row->status === 0)
                        <span class="badge badge-danger">Belum Disposisi</span>
                    @else
                        <span class="badge badge-success">Sudah Disposisi</span>
                    @endif
                </td>
                <td class="d-flex">
                    <a href="{{ route('surat-masuk.edit', $row->id) }}"
                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>

                    <button class="btn btn-xs btn-default text-danger mx-1 shadow btn-delete    " title="Delete"
                        data-toggle="modal" data-target="#deleteModal" data-id="{{ $row->id }}">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>

                    <a href="{{ Storage::url($row->file) }}" target="_blank"
                        class="btn btn-xs btn-default text-primary mx-1 shadow" title="Lihat File">
                        <i class="fa fa-lg fa-fw fa-file"></i>
                    </a>

                    <button type="button" class="btn btn-xs btn-default text-success mx-1 shadow btn-detail"
                        title="Detail" data-toggle="modal" data-target="#detailmodal" data-id="{{ $row->id }}">
                        <i class="fa fa-lg fa-fw fa-info-circle"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
</div>
