<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $heads = [
            'No',
            'Nomor Surat',
            'Perihal',
            'Bidang',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];
        $bidang = Bidang::all();
        $suratkeluar = SuratKeluar::all();
        return view('suratkeluar.index', [
            "bidang" => $bidang,
            "suratkeluar" => $suratkeluar,
            "heads" => $heads
        ]);
    }


    public function create()
    {
        return view('suratkeluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'id_bidang' => 'required',
            'alamat_tujuan' => 'required',
            'perihal' => 'required',
            'lampiran' => 'required',
            'sifat' => 'required',
            'file' => 'required|mimes:jpg,jpeg,pdf,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $file = $request->file('file');
        $fileName = 'suratkeluar-' . $file->getClientOriginalName();
        $path = $file->storeAs('suratkeluar', $fileName, 'public');

        $data['file'] = $path;

        try {
            SuratKeluar::create($data);
            return response()->json(['message' => 'Surat Keluar berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal membuat Surat Keluar'], 500);
        }
    }


    public function show($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return response()->json([
            'data' => $surat
        ]);
    }


    public function edit($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $bidang = Bidang::all();

        return response()->json([
            'suratkeluar' => $suratkeluar,
            "bidang" => $bidang
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => [
                'required',
                Rule::unique('surat_keluar')->ignore($id),
            ],
            'tanggal_surat' => 'required|date',
            'alamat_tujuan' => 'required',
            'perihal' => 'required',
            'id_bidang' => 'required',
            'sifat' => 'required',
            'lampiran' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,pdf'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'updateSK-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('updateSK', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        try {
            SuratKeluar::where('id', $id)->update($data);

            return response()->json(['message' => 'Surat Keluar Berhasil Diupdate'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return response()->json(['error' => 'Surat Keluar Gagal Diupdate'], 500);
        }
    }


    public function destroy($id)
    {
        SuratKeluar::where('id', $id)->delete();
    }
}
