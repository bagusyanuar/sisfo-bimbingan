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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Detail Konsultasi Laporan</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Detail Konsultasi Laporan
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Laporan</p>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Judul Laporan
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->pengajuan->judul }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Nama Siswa
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->pengajuan->user->siswa->nama }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Jurusan
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->pengajuan->user->siswa->kelas->jurusan->nama }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Kelas
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->pengajuan->user->siswa->kelas->nama }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="font-weight-bold">Detail Konsultasi</p>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Tanggal Konsultasi
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->tanggal }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Judul Konsultasi
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->judul }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        File Konsultasi
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    : <a href="{{ asset('/file').'/'.$data->file_konsultasi }}" target="_blank">
                                        {{ $data->file_konsultasi }}
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Status
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Keterangan
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->keterangan }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        File Revisi
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    : @if($data->file_revisi != null) <a
                                        href="{{ asset('/file').'/'.$data->file_revisi }}" target="_blank">
                                        {{ $data->file_revisi }}
                                    </a>
                                    @else <span>-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($data->status == 'menunggu')
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/konsultasi-guru/patch" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group w-100 mb-1 d-block" id="panel-pembimbing">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="acc">ACC</option>
                                    <option value="revisi">Revisi</option>
                                </select>
                            </div>
                            <div class="w-100 mb-1 d-none" id="panel-file">
                                <label for="file" class="form-label">File Revisi</label>
                                <input type="file" class="form-control-file" id="file" placeholder="File"
                                       name="file">
                            </div>
                            <div class="form-group w-100 mb-1 d-none" id="panel-keterangan">
                                <label for="keterangan">Keterangan</label>
                                <textarea rows="3" class="form-control" id="keterangan" placeholder="Keterangan"
                                          name="keterangan"></textarea>
                            </div>
                            <div class="w-100 mb-2 mt-3 text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#status').on('change', function () {
                let val = this.value;
                if (val === 'revisi') {
                    $('#panel-file').addClass('d-block');
                    $('#panel-file').removeClass('d-none');
                    $('#panel-keterangan').addClass('d-block');
                    $('#panel-keterangan').removeClass('d-none');
                } else {
                    $('#panel-file').addClass('d-none');
                    $('#panel-file').removeClass('d-block');
                    $('#panel-keterangan').addClass('d-none');
                    $('#panel-keterangan').removeClass('d-block');
                }
            });
        });
    </script>
@endsection
