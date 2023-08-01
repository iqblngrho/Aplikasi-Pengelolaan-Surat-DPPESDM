<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class DisposisiController extends Controller
{

    public function index()
    {
        $heads = [
            'No',
            'Nomor Surat',
            'Alamat surat',
            'Tanggal Surat',
            'Perihal',
            'Riwayat Bidang',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = SuratMasuk::with('disposisi')->get();

        return view('disposisi.index', [
            "suratMasuk" => $suratMasuk,
            "heads" => $heads,
        ]);
    }


    public function create()
    {
        $suratMasuk = SuratMasuk::all();
        $roles = Role::all()->pluck('name');

        return view("disposisi.create", [
            "suratMasuk" => $suratMasuk,
            "roles" => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_surat' => 'required',
            'sifat' => 'required',
            'catatan' => 'required',
            'diteruskan_ke' => 'required',
            'file' => 'required|mimes:pdf,jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['id_user'] = auth()->id();

        try {
            $file = $request->file('file');
            $filename = 'disposisi-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('disposisi', $filename, 'public');

            $data['file'] = $path;

            Disposisi::create($data);

            return redirect()->route('disposisi.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during file upload or data storage
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan surat masuk.');
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $roles = Role::all()->pluck('name');

        return view('disposisi.edit', [
            "disposisi" => $disposisi,
            "roles" => $roles,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'diteruskan_ke' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $disposisi = Disposisi::findorFail($id);

        Disposisi::create([
            "id_surat" => $disposisi->id_surat,
            "id_user" => auth()->user()->id,
            "sifat" => $disposisi->sifat,
            "catatan" => $disposisi->catatan,
            "diteruskan_ke" => $request->diteruskan_ke,
            "file" => $disposisi->file,
        ]);

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diubah');
    }

    public function destroy($id)
    {
        Disposisi::where('id', $id)->delete();
    }
}