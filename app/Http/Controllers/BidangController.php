<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangController extends Controller
{

    public function index()
    {

        $heads = [
            "Nama Bidang",
            [
                'label' => 'Actions',
                'no-export' => true,
                'width' => 5,
            ],
        ];

        $bidang = Bidang::all();

        return view("bidang.index", [
            'bidang' => $bidang,
            'heads' => $heads,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bidang.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Bidang::create($request->all());

            return redirect()->route('bidang.index')->with('success', 'Bidang berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan bidang.');
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


    public function edit($id)
    {
        $bidang = Bidang::findOrFail($id);

        return view('bidang.edit', [
            "bidang" => $bidang,
        ]);
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        Bidang::where('id', $id)->update($data);

        return redirect()->route('bidang.index')->with('success', 'Bidang berhasil diubah');
    }


    public function destroy($id)
    {
        Bidang::where('id', $id)->delete();
    }
}