<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
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
        $pengajuan = User::with('pengajuan_success')->where('id', Auth::id())->first();
        $data = Pengajuan::with(['user.siswa', 'user.pengajuan_success' ,'pembimbing.guru'])
            ->where('user_id', '=', Auth::id())
            ->get();
        return view('siswa.pengajuan.index')->with(['data' => $data, 'pengajuan' => $pengajuan]);
    }

    public function add_page()
    {
        return view('siswa.pengajuan.add');
    }

    public function create()
    {
        try {
            $data = [
                'user_id' => Auth::id(),
                'judul' => $this->postField('judul'),
                'status' => 'menunggu',
                'deskripsi' => 'menunggu pemeriksaan laporan',
                'tanggal' => now()
            ];
            $nama_file = $this->generateImageName('file');

            if ($nama_file !== '') {
                $data['file'] = $nama_file;
                $this->uploadImage('file', $nama_file, 'file');
            }
            Pengajuan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }
}
