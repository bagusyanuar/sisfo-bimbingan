<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;

class BerkasController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Berkas::where('user_id', '=', Auth::id())
            ->orderBy('id', 'DESC')
            ->get();
        $tmp_accepted = array_filter($data->toArray(), function ($obj){
            if($obj['status'] === 'terima' || $obj['status'] === 'menunggu') {
                return true;
            }
            return false;
        });
        $has_accepted = count($tmp_accepted) > 0 ? true : false;
        return view('siswa.berkas.index')->with(['data' => $data, 'has_accepted' => $has_accepted]);
    }
}
