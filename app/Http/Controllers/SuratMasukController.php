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
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $surat_masuk = SuratMasuk::all();

        return view('surat-masuk.index', [
            "surat_masuk" => $surat_masuk,
            "heads" => $heads,
        ]);
    }

    public function create()
    {
        return view("surat-masuk.create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat_surat' => 'required',
            'nomor_surat' => 'required|unique:surat_masuk',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'status' => 'required|integer',
            'file' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        try {
            $file = $request->file('file');
            $filename = 'surat-masuk-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('suratmasuk', $filename, 'public');

            $data['file'] = $path;

            SuratMasuk::create($data);

            return redirect()->route('surat-masuk.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan surat masuk.');
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

    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);

        return view('surat-masuk.edit', [
            "surat" => $surat,
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
            $path = $file->storeAs('suratmasuk', $fileName, 'public');
            $data['file'] = $path;
        }

        $data['tanggal_surat'] = Carbon::createFromFormat('d-m-Y', Carbon::parse($request->tanggal_surat)->format('d-m-Y'));

        SuratMasuk::where('id', $id)->update($data);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat Masuk berhasil diubah');
    }

    public function destroy($id)
    {
        SuratMasuk::where('id', $id)->delete();
    }
}