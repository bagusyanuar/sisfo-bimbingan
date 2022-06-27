<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class JurusanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Jurusan::all();
        return view('admin.data.jurusan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.data.jurusan.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
            ];
            Jurusan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Jurusan::findOrFail($id);
        return view('admin.data.jurusan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $jurusan = Jurusan::find($id);
            $data = [
                'nama' => $this->postField('nama'),
            ];
            $jurusan->update($data);
            return redirect('/jurusan')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Jurusan::destroy($id);
            return $this->jsonResponse('success', 200);
        }catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
