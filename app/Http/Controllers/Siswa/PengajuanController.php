<?php


namespace App\Http\Controllers\Siswa;


use App\Helper\CustomController;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengajuan::with(['user.siswa', 'pembimbing.guru'])
            ->where('user_id', '=', Auth::id())
            ->get();
        return view('siswa.pengajuan.index')->with(['data' => $data]);
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
                'status' => 'menunggu'
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
