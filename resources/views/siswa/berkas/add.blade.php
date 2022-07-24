@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Tambah Berkas</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/berkas">Berkas</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-6 col-sm-11">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="/berkas/create" enctype="multipart/form-data">
                                @csrf
                                <div class="w-100 mb-2">
                                    <label for="file_kegiatan" class="form-label">File Kegiatan</label>
                                    <input type="file" class="form-control-file" id="file_kegiatan" placeholder="File"
                                           name="file_kegiatan">
                                </div>
                                <div class="w-100 mb-2">
                                    <label for="file_selesai" class="form-label">File Selesai Magang</label>
                                    <input type="file" class="form-control-file" id="file_selesai" placeholder="File"
                                           name="file_selesai">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="file_penilaian" class="form-label">File Penilaian</label>
                                    <input type="file" class="form-control-file" id="file_penilaian" placeholder="File"
                                           name="file_penilaian">
                                </div>
                                <div class="w-100 mb-2 mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
