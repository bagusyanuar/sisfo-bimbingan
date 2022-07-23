<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Berkas;
use App\Models\Guru;
use Illuminate\Support\Facades\DB;

class BerkasController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Berkas::with('user')
            ->where('status', '=', 'menunggu')
            ->get();
        return view('admin.berkas.index')->with(['data' => $data]);
    }

    public function detail($id)
    {
        $data = Berkas::with('user')
            ->findOrFail($id);
        $pembimbing = Guru::with('user')->get();
        return view('admin.berkas.detail')->with(['data' => $data, 'pembimbing' => $pembimbing]);
    }

    public function patch()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            $status = $this->postField('status');
            $deskripsi = $this->postField('deskripsi');
            $pembimbing = $this->postField('pembimbing');
            $data = Berkas::with('user.siswa')
                ->findOrFail($id);

            $value = [
                'status' => $status
            ];
            if ($status === 'terima') {
                $value['keterangan'] = 'Lanjut Ke Pengajuan Laporan';
                $siswa = $data->user->siswa;
                $siswa->update([
                    'pembimbing_id' => $pembimbing
                ]);
            } else {
                $value['keterangan'] = $deskripsi;

            }
            $data->update($value);
            DB::commit();
            return redirect('/pengajuan-berkas')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }
}
