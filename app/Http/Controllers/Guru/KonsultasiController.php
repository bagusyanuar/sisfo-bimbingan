<?php


namespace App\Http\Controllers\Guru;


use App\Helper\CustomController;
use App\Models\Konsultasi;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Konsultasi::with(['pengajuan.user.siswa.kelas.jurusan'])
            ->whereHas('pengajuan', function ($q) {
                $q->where('pembimbing_id', '=', Auth::id());
            })
            ->orderBy('id', 'DESC')
            ->get();
        return view('guru.konsultasi.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Konsultasi::with(['pengajuan.user.siswa.kelas.jurusan'])->findOrFail($id);
        return view('guru.konsultasi.detail')->with(['data' => $data]);
    }

    public function patch()
    {

        try {
            $id = $this->postField('id');
            $status = $this->postField('status');
            $keterangan = $this->postField('keterangan');
            $konsultasi = Konsultasi::find($id);
            $value = [
                'status' => $status
            ];
            if ($status === 'acc') {
                $value['keterangan'] = 'Laporan di ACC';
            } else {
                $value['keterangan'] = $keterangan;
                $nama_file = $this->generateImageName('file');
                if ($nama_file !== '') {
                    $value['file_revisi'] = $nama_file;
                    $this->uploadImage('file', $nama_file, 'file');
                }
            }
            $konsultasi->update($value);
            return redirect('/konsultasi-guru')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }
}
