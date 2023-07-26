<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surat_masuk = SuratMasuk::all();
        return view('suratmasuk.index', [
            "surat_masuk" => $surat_masuk
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat_surat' => 'required',
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'status' => 'required|integer',
            'file' => 'required|mimes:pdf,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Data is valid, continue with storing the data into the database
        $data = $request->all();

        $file = $request->file('file');
        $filename = 'surat-masuk-' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('suratmasuk', $filename);

        $data['file'] = $path;

        SuratMasuk::create($data);

        return redirect()->route('suratmasuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
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

        return view('suratmasuk.edit', [
            "surat" => $surat,
        ]);
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
            'alamat_surat' => 'required',
            'perihal' => 'required',
            'status' => 'required|integer',
            'file' => 'nullable|mimes:jpg,jpeg,pdf'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']); // Exclude unnecessary fields from the update data

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'profile-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('files', $fileName);
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
