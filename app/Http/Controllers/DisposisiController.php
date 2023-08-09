<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
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
            'catatan',
            'tindakan_dari',
            'diteruskan_ke',
            'status',
            // ['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];
        $disposisi = Disposisi::all();
        return view('disposisi.index', [
            "disposisi" => $disposisi,
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
        //
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
            'catatan' => 'required',
            'tindakan_dari' => 'required',
            'diteruskan_ke' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        try {
            Disposisi::create($data);

            return redirect()->route('disposisi.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
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
