<?php

use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;

class Helpers
{

    public static function checkBerkas()
    {
        $has_accepted = false;
        if (\auth()->user()->role === 'siswa') {
            $data = Berkas::where('user_id', '=', Auth::id())
                ->orderBy('id', 'DESC')
                ->get();
            $tmp_accepted = array_filter($data->toArray(), function ($obj) {
                if ($obj['status'] === 'terima') {
                    return true;
                }
                return false;
            });
            $has_accepted = count($tmp_accepted) > 0 ? true : false;
        }
        return $has_accepted;
    }

    public static function checkJudul()
    {
        $has_accepted = false;
        if (\auth()->user()->role === 'siswa') {
            $has_accepted = (\auth()->user()->laporan_acc !== null || \auth()->user()->laporan_selesai !== null )? true : false;
        }
        return $has_accepted;
    }
}

