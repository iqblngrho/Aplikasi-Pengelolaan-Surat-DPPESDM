<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
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
            'Nomor Surat',
            'Alamat surat',
            'Tanggal Surat',
            'Perihal',
            'Sifat',
            'Catatan',
            'Dari Bidang',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5, 'text-align' => 'center'],
        ];

        $suratMasuk = SuratMasuk::all()->count();
        $disposi = Disposisi::all()->count();

        $suratMasukWithDisposisi = SuratMasuk::with([
            'disposisi' => function ($query) {
                $query->where('diteruskan_ke', auth()->user()->getRoleNames()[0]);
            }
        ])->where('status', 0)
            ->whereHas('disposisi', function ($query) {
                $query->where('diteruskan_ke', auth()->user()->getRoleNames()[0]);
            })
            ->get();

        return view('home', [
            'heads' => $heads,
            'totalSuratMasuk' => $suratMasuk,
            'totalDisposisi' => $disposi,
            'suratMasuk' => $suratMasukWithDisposisi,
        ]);
    }
}