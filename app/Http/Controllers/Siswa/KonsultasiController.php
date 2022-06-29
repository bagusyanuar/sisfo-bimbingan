<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($id)
    {
        $data = Pengajuan::with(['user', 'pembimbing.guru'])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();
        return view('siswa.konsultasi.index')->with(['data' => $data]);
    }
}
