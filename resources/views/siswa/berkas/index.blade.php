@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="container-fluid pt-3">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengajuan Berkas</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pengajuan Berkas
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            @if(!$has_accepted)
                <div class="text-right mb-2 pr-3">
                    <a href="/berkas/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                            class="font-weight-bold">Tambah</span></a>
                </div>
            @endif
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Tanggal</th>
                    <th>File Kegiatan</th>
                    <th>File Selesai Magang</th>
                    <th>File Penilaian Magang</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th width="12%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->tanggal }}</td>
                        <td><a href="{{ asset('/berkas').'/'.$v->file_kegiatan }}" target="_blank">{{ $v->file_kegiatan }}</a></td>
                        <td><a href="{{ asset('/berkas').'/'.$v->file_selesai }}" target="_blank">{{ $v->file_selesai }}</a></td>
                        <td><a href="{{ asset('/berkas').'/'.$v->file_penilaian }}" target="_blank">{{ $v->file_penilaian }}</a></td>
                        <td>{{ $v->status }}</td>
                        <td>{{ $v->keterangan }}</td>
                        <td class="text-center">
                            @if($v->status == 'menunggu')
                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                        class="fa fa-trash"></i></a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/berkas/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
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
