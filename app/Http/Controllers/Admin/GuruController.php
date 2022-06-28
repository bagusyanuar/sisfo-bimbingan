<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = User::with(['guru'])
            ->where('role', '=', 'guru')
            ->get();
        return view('admin.pengguna.guru.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.pengguna.guru.add');
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data_user = [
                'username' => $this->postField('username'),
                'password' => Hash::make($this->postField('password')),
                'role' => 'guru',
            ];
            $user = User::create($data_user);
            $data_guru = [
                'user_id' => $user->id,
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
            ];
            Guru::create($data_guru);
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = User::with('guru')->findOrFail($id);
        return view('admin.pengguna.guru.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            $user = User::find($id);
            $data = [
                'username' => $this->postField('username'),
            ];

            if ($this->postField('password') !== '') {
                $data['password'] = Hash::make($this->postField('password'));
            }
            $user->update($data);
            $data_guru = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
            ];
            $user->guru()->update($data_guru);
            DB::commit();
            return redirect('/guru')->with(['success' => 'Berhasil Merubah Data...']);
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            Guru::where('user_id', $id)->delete();
            User::destroy($id);
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed', 500);
        }
    }
}
