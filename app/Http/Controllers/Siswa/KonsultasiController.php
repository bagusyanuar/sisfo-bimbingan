<?php


namespace App\Http\Controllers\Siswa;


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
        $data = Pengajuan::with(['user.siswa.pembimbing.guru', 'konsultasi' => function ($q) {
            return $q->orderBy('id', 'DESC');
        }])
            ->where('user_id', Auth::id())
            ->where(function ($q) {
                return $q
                    ->where('status', '=', 'terima')
                    ->orWhere('status', '=', 'selesai');
            })
            ->first();
        return view('siswa.konsultasi.index')->with(['data' => $data]);
    }

    public function add_page($id)
    {
        $konsultasi = Konsultasi::with('pengajuan')
            ->where('pengajuan_id', $id)
            ->where('status', 'menunggu')
            ->first();
        if ($konsultasi) {
            return redirect()->back()->with(['failed' => 'Masih Ada Konsultasi Yang Belum Di tanggapi oleh guru!']);
        }
        $data = Pengajuan::with(['user', 'pembimbing.guru'])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();
        return view('siswa.konsultasi.add')->with(['data' => $data]);
    }

    public function create($id)
    {
        try {

            $data = [
                'user_id' => Auth::id(),
                'pengajuan_id' => $this->postField('id'),
                'tanggal' => date('Y-m-d'),
                'judul' => $this->postField('judul'),
                'status' => 'menunggu',
                'keterangan' => '',
            ];
            $nama_file = $this->generateImageName('file');

            if ($nama_file !== '') {
                $data['file_konsultasi'] = $nama_file;
                $this->uploadImage('file', $nama_file, 'file');
            }
            Konsultasi::create($data);
            return redirect('/konsultasi')->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function cetak($id)
    {
        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'user.siswa.pembimbing.guru', 'konsultasi' => function ($q) {
            return $q->orderBy('id', 'ASC');
        }])
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();
        return $this->convertToPdf('siswa.konsultasi.cetak', ['data' => $data]);
    }
}
