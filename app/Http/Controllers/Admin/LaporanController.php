<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pengajuan;

class LaporanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.laporan.index');
    }

    public function data_pengajuan()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'pembimbing.guru'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'pembimbing.guru'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('admin.laporan.cetak', [
            'data' => $data,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        ]);
    }
}
