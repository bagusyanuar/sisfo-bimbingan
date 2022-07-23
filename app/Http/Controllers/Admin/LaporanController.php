<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Konsultasi;
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

    public function selesai()
    {
        return view('admin.laporan.bimbingan-selesai.index');
    }

    public function data_selesai()
    {
        try {

            $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'user.siswa.pembimbing.guru'])
                ->where('status', '=', 'selesai')
                ->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak_selesai()
    {

        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'user.siswa.pembimbing.guru'])
            ->where('status', '=', 'selesai')
            ->get();
        return $this->convertToPdf('admin.laporan.bimbingan-selesai.cetak', [
            'data' => $data,
        ]);
    }

    public function proses()
    {
        return view('admin.laporan.bimbingan-proses.index');
    }

    public function data_proses()
    {
        try {

            $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'user.siswa.pembimbing.guru'])
                ->where('status', '=', 'terima')
                ->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak_proses()
    {

        $data = Pengajuan::with(['user.siswa.kelas.jurusan', 'user.siswa.pembimbing.guru'])
            ->where('status', '=', 'terima')
            ->get();
        return $this->convertToPdf('admin.laporan.bimbingan-proses.cetak', [
            'data' => $data,
        ]);
    }

    public function konsultasi()
    {
        return view('admin.laporan.konsultasi.index');
    }

    public function data_konsultasi()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Konsultasi::with(['pengajuan.user.siswa.kelas.jurusan', 'pengajuan.user.siswa.pembimbing.guru'])
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function cetak_konsultasi()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Konsultasi::with(['pengajuan.user.siswa.kelas.jurusan', 'pengajuan.user.siswa.pembimbing.guru'])
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('admin.laporan.konsultasi.cetak', [
            'data' => $data,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        ]);
    }


}
