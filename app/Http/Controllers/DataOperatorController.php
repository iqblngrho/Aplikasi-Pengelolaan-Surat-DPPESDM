<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class DataOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataOperator = User::all();
        return view('dataoperator.index', [
            "dataoperator" => $dataOperator
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataOperator  $dataOperator
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataOperator = User::findOrFail($id);
        return response()->json([
            'data' => $dataOperator
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataOperator = User::findOrFail($id);

        return view('dataoperator.edit', [
            "edit" => $dataOperator,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $dataOperator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'nama' => 'required',
            'password' => 'required',
            'jabatan' => 'required',
            'bidang' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->except(['_token', '_method']);
        User::where('id', $id)->update($data);

        return redirect()->route('dataoperator.index')->with('success', 'Data Operator berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $dataOperator
     * @return \Illuminate\Http\Response
     */
    public function destroy(USer $dataOperator)
    {
        //
    }
}
