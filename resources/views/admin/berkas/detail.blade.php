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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Detail Pengajuan Berkas Magang Siswa</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/pengajuan-berkas">Pengajuan Berkas Magang Siswa</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">NIS</span>
                                </div>
                                <div class="col-lg-9 col-md-3">
                                    <span class="font-weight-bold">: {{ $data->user->username }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">Nama Siswa</span>
                                </div>
                                <div class="col-lg-9 col-md-3">
                                    <span class="font-weight-bold">: {{ $data->user->siswa->nama }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">Kelas</span>
                                </div>
                                <div class="col-lg-9 col-md-3">
                                    <span class="font-weight-bold">: {{ $data->user->siswa->kelas->nama }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">Jurusan</span>
                                </div>
                                <div class="col-lg-9 col-md-3">
                                    <span
                                        class="font-weight-bold">: {{ $data->user->siswa->kelas->jurusan->nama }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <span class="font-weight-bold">File Kegiatan Magang</span>
                                </div>
                                <div class="col-lg-9 col-md-6">
                                    <span class="font-weight-bold">:</span>
                                    <a href="{{ asset('/berkas').'/'.$data->file_kegiatan }}" target="_blank">{{ $data->file_kegiatan }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <span class="font-weight-bold">File Selesai Magang</span>
                                </div>
                                <div class="col-lg-9 col-md-6">
                                    <span class="font-weight-bold">:</span>
                                    <a href="{{ asset('/berkas').'/'.$data->file_selesai }}" target="_blank">{{ $data->file_selesai }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <span class="font-weight-bold">File Penilaian Magang</span>
                                </div>
                                <div class="col-lg-9 col-md-6">
                                    <span class="font-weight-bold">:</span>
                                    <a href="{{ asset('/berkas').'/'.$data->file_penilaian }}" target="_blank">{{ $data->file_penilaian }}</a>
                                </div>
                            </div>
                            <form method="post" action="/pengajuan-berkas/patch">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <div class="form-group w-100 mb-1">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="terima">Terima</option>
                                        <option value="tolak">Tolak</option>
                                    </select>
                                </div>
                                <div class="form-group w-100 mb-1 d-block" id="panel-pembimbing">
                                    <label for="pembimbing">Pembimbing</label>
                                    <select class="form-control" id="pembimbing" name="pembimbing">
                                        @foreach($pembimbing as $v)
                                            <option value="{{ $v->user->id }}">{{ $v->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group w-100 mb-1 d-none" id="panel-deskripsi">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea rows="3" class="form-control" id="deskripsi" placeholder="Deskripsi"
                                              name="deskripsi"></textarea>
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
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#status').on('change', function () {
                let val = this.value;
                console.log(val)
                if(val === 'tolak') {
                    $('#panel-pembimbing').addClass('d-none');
                    $('#panel-pembimbing').removeClass('d-block');
                    $('#panel-deskripsi').addClass('d-block');
                    $('#panel-deskripsi').removeClass('d-none');
                } else {
                    $('#panel-pembimbing').addClass('d-block');
                    $('#panel-pembimbing').removeClass('d-none');
                    $('#panel-deskripsi').addClass('d-none');
                    $('#panel-deskripsi').removeClass('d-block');
                }
            });
        });
    </script>
@endsection
