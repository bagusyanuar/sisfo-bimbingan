<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Jurusan;
use App\Models\Kelas;

class KelasController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kelas::with('jurusan')->get();
        return view('admin.data.kelas.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.data.kelas.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'jurusan_id' => $this->postField('jurusan'),
            ];
            Kelas::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Kelas::findOrFail($id);
        return view('admin.data.kelas.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $kelas = Kelas::find($id);
            $data = [
                'nama' => $this->postField('nama'),
                'jurusan_id' => $this->postField('jurusan'),
            ];
            $kelas->update($data);
            return redirect('/kelas')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Kelas::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
