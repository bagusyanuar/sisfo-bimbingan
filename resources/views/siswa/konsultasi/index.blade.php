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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Konsultasi Laporan</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/pengajuan">Pengajuan</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konsultasi Laporan
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Judul
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
                                        Pembimbing
                                    </span>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : {{ $data->user->siswa->pembimbing->guru->nama }}
                                    </span>
                                </div>
                            </div>
                            @if($data->status == 'selesai')
                                <div class="row">
                                    <div class="col-lg-3 col-md-3">
                                    <span class="font-weight-bold">
                                        Status
                                    </span>
                                    </div>
                                    <div class="col-lg-9 col-md-9">
                                    <span class="font-weight-bold">
                                        : Bimbingan Telah Selesai
                                    </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($data->status == 'terima')
                <div class="text-right mb-2 pr-3">

                    <a href="/konsultasi/{{ $data->id }}/tambah" class="btn btn-primary"><i
                            class="fa fa-plus mr-1"></i><span
                            class="font-weight-bold">Tambah Konsultasi</span></a>
                </div>
            @endif
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Tanggal</th>
                    <th>Deadline Revisi</th>
                    <th>Judul Konsultasi</th>
                    <th>File Konsultasi</th>
                    <th>File Revisi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->konsultasi as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->tanggal }}</td>
                        <td>{{ $v->deadline == null ? '-' : $v->deadline }}</td>
                        <td>{{ $v->judul }}</td>
                        <td>
                            <a href="{{ asset('/file').'/'.$v->file_konsultasi }}" target="_blank">
                                {{ $v->file_konsultasi }}
                            </a>
                        </td>
                        <td>
                            @if($v->file_revisi != null)
                                <a href="{{ asset('/file').'/'.$v->file_revisi }}" target="_blank">{{ $v->file_revisi }}
                                </a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>{{ $v->keterangan }}</td>
                        <td>{{ $v->status }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-right mt-3">
                <a href="/konsultasi/{{ $data->id }}/cetak" target="_blank" class="btn btn-success"><i
                        class="fa fa-print mr-2"></i><span
                        class="font-weight-bold">Cetak</span></a>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/admin/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable({
                "scrollX": true
            });
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah Anda Yakin?', 'Data yang sudah dihapus tidak dapat di kembalikan', function () {
                    destroy(id);
                })
            });
        });
    </script>
@endsection
