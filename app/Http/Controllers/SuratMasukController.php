<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class SuratMasukController extends Controller
{

    public function index()
    {
        $heads = [
            'No',
            'Alamat surat',
            'Nomor Surat',
            'Tanggal Surat',
            'Perihal',
            'Tanggal Diterima',
            'Tindakan',
            'Catatan',
            'Status',
            // ['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];
        $surat_masuk = SuratMasuk::where('tindakan', 0)->get();
        return view('suratmasuk.index', [
            "surat" => $surat_masuk,
            "heads" => $heads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
            'status' => 'required',
            'sifat' => 'required',
            'lampiran' => 'required',
            'file' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        try {
            $file = $request->file('file');
            $filename = 'surat-masuk-' . $file->getClientOriginalName();
            $path = $file->storeAs('suratmasuk', $filename, 'public');

            $data['file'] = $path;

            SuratMasuk::create($data);

            return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan surat masuk.');
        }
    }

    public function updateTindakan(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'tindakan' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            SuratMasuk::where('id', $id)->update([
                "tindakan" => $request->tindakan,
                "catatan" => $request->catatan,
            ]);

            return redirect()->route('suratmasuk.index')->with('success', 'Surat Berhasil Diteruskan');
        } catch (\Exception $e) {
            dd($e);
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan Tindakan.');
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
        $surat = SuratMasuk::findOrFail($id);
        return response()->json([
            'data' => $surat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('suratmasuk.edit', ["surat" => $surat]);
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
        $validator = Validator::make($request->all(), [
            'nomor_surat' => [
                'required',
                Rule::unique('surat_masuk')->ignore($id),
            ],
            'tanggal_surat' => 'required|date',
            'asal_surat' => 'required',
            'perihal' => 'required',
            'status' => 'required',
            'sifat' => 'required',
            'lampiran' => 'required',
            'tindakan' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,pdf'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']); // Exclude unnecessary fields from the update data

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'profile-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        SuratMasuk::where('id', $id)->update($data);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SuratMasuk::where('id', $id)->delete();
        return redirect()->route('suratmasuk.index')->with('success', 'Data berhasil dihapus');
    }
}