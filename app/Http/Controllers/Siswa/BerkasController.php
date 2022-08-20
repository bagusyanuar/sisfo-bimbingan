<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
use App\Models\Berkas;
use App\Models\Jurusan;
use App\Models\Konsultasi;
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

    public function add_page()
    {
        return view('siswa.berkas.add');
    }

    public function create()
    {
        try {

            $data = [
                'user_id' => Auth::id(),
                'tanggal' => date('Y-m-d'),
                'status' => 'menunggu',
                'keterangan' => '',
            ];
            $file_kegiatan = $this->generateImageName('file_kegiatan');
            $file_selesai = $this->generateImageName('file_selesai');
            $file_penilaian = $this->generateImageName('file_penilaian');

            if ($file_kegiatan !== '' && $file_selesai !== null && $file_penilaian !== null) {
                $data['file_kegiatan'] = $file_kegiatan;
                $this->uploadImage('file_kegiatan', $file_kegiatan, 'file');
                $data['file_selesai'] = $file_selesai;
                $this->uploadImage('file_selesai', $file_selesai, 'file');
                $data['file_penilaian'] = $file_penilaian;
                $this->uploadImage('file_penilaian', $file_penilaian, 'file');
            }
            Berkas::create($data);
            return redirect('/berkas')->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Berkas::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
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
