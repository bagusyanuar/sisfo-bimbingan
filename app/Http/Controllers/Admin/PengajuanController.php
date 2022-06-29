<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'pembimbing.guru'])->get();
        return view('admin.pengajuan.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'pembimbing.guru'])->findOrFail($id);
        $pembimbing = Guru::with('user')->get();
        return view('admin.pengajuan.detail')->with(['data' => $data, 'pembimbing' => $pembimbing]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $status = $this->postField('status');
            $deskripsi = $this->postField('deskripsi');
            $pembimbing = $this->postField('pembimbing');
            $data = Pengajuan::find($id);
            $value = [
                'status' => $status
            ];
            if ($status === 'terima') {
                $value['deskripsi'] = 'Lanjut Ke Konsultasi Bab';
                $value['pembimbing_id'] = $pembimbing;
            } else {
                $value['deskripsi'] = $deskripsi;

            }
            $data->update($value);
            return redirect('/pengajuan-laporan')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }
}
