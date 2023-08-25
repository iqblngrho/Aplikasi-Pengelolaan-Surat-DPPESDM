<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = [
            'No',
            'Nomor Surat',
            'Perihal',
            'Catatan',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];
        $bidang = Bidang::all();
        $suratKeluar = SuratKeluar::all();
        return view('suratkeluar.index', [
            "bidang" => $bidang,
            "suratkeluar" => $suratKeluar,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
