<?php


namespace App\Http\Controllers\Guru;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class SiswaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Siswa::with(['user.pengajuan_terakhir'])
            ->where('pembimbing_id', '=', Auth::id())
            ->get();
        return view('guru.siswa.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Pengajuan::with('user.siswa.kelas.jurusan')
        ->findOrFail($id);
        return view('guru.siswa.detail')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $data = Pengajuan::with('user.siswa.kelas.jurusan')
                ->findOrFail($id);
            $status = $this->postField('status');
            $keterangan = $this->postField('keterangan');
            $data_request = [
                'status' => $status,
                'deskripsi' => $status === 'terima' ? 'Lanjut Konsultasi Bab' : $keterangan
            ];
            $data->update($data_request);
            return redirect('/siswa-bimbingan')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function finish()
    {
        try {
            $id = $this->postField('id');
            $data = Pengajuan::with('user.siswa.kelas.jurusan')
                ->findOrFail($id);
            $data_request = [
                'status' => 'selesai',
                'deskripsi' => 'Bimbingan Selesai'
            ];
            $data->update($data_request);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('Terjadi Kesalahan ' . $e->getMessage(), 500);
        }
    }
}
