<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use TindakanSurat;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class SuratMasukController extends Controller
{
    public function index()
    {
        $heads = [
            'No Agenda',
            'Alamat surat',
            'Nomor Surat',
            'Tanggal Surat',
            'Perihal',
            'Tanggal Diterima',
            'Jenis Surat',
            'Tindakan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $surat_masuk = SuratMasuk::whereIn('tindakan', [0, 1, 5])->get();

        return view('suratmasuk.index', [
            "surat" => $surat_masuk,
            "heads" => $heads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("suratmasuk.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'asal_surat' => 'required',
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'jenis' => 'required',
            'sifat' => 'required',
            'lampiran' => 'required',
            'file' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->all();

        $file = $request->file('file');
        $filename = 'surat-masuk-' . $file->getClientOriginalName();
        $path = $file->storeAs('suratmasuk', $filename, 'public');

        $data['file'] = $path;
        try {

            SuratMasuk::create($data);

            return response()->json(['message' => 'Surat Masuk Berhasil Ditambah'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return response()->json(['error' => 'Gagal Membuat Surat Masuk'], 500);
        }
    }

    public function updateTindakan(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'tindakan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $request->except(['_token', '_method']);

        try {
            SuratMasuk::where('id', $id)->update($data);

            return response()->json(['message' => 'Berhasil Update'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return response()->json(['error' => 'Gagal Update'], 500);
        }
    }

    public function show($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        return response()->json([
            'data' => $surat
        ]);
    }

    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return response()->json([
            'surat' => $surat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_surat' => [
                'required',
                Rule::unique('surat_masuk')->ignore($id),
            ],
            'tanggal_surat' => 'required|date',
            'asal_surat' => 'required',
            'perihal' => 'required',
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
            $fileName = 'profile-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        try {
            SuratMasuk::where('id', $id)->update($data);

            return response()->json(['message' => 'Surat Masuk Berhasil Diupdate'], 200);
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return response()->json(['error' => 'Surat Masuk Gagal Diupdate'], 500);
        }
    }

    public function destroy($id)
    {
        $suratMasuk = SuratMasuk::find($id);

        if ($suratMasuk->disposisi) {
            $suratMasuk->disposisi->delete();
        }
    }
}
