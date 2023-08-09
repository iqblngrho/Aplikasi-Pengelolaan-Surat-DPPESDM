<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
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
            'Status',
            // ['label' => 'Phone', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = SuratMasuk::where('tindakan', 1)->get();

        return view('home', [
            "heads" => $heads,
            "suratMasuk" => $suratMasuk
        ]);
    }
}