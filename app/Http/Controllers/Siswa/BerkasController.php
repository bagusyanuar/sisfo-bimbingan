<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
use App\Models\Berkas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function password_page()
    {
        return view('siswa.password.index');
    }

    public function password_reset()
    {
        try {
            $user = User::find(Auth::id());

            if ($this->postField('password') !== '') {
                $password = Hash::make($this->postField('password'));
                $user->update([
                    'password' => $password
                ]);
                return redirect('/dashboard')->with(['success' => 'Berhasil Merubah Data...']);
            } else {
                return redirect('/dashboard');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }
}
