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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengajuan Laporan Siswa</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pengajuan Laporan Siswa
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Judul</th>
                    <th>File</th>
                    <th>Pembimbing</th>
                    <th>Status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->user->username }}</td>
                        <td>{{ $v->user->siswa->nama }}</td>
                        <td>{{ $v->user->siswa->kelas->nama }}</td>
                        <td>{{ $v->judul }}</td>
                        <td><a href="{{ asset('/file').'/'.$v->file }}" target="_blank">{{ $v->file }}</a></td>
                        <td>{{$v->pembimbing != null ? $v->pembimbing->guru->nama : '-'}}</td>
                        <td>{{ $v->status }}</td>
                        <td class="text-center">
                            @if($v->status == 'menunggu')
                                <a href="/pengajuan-laporan/detail/{{ $v->id }}" class="btn btn-sm btn-info btn-detail"
                                   data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
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
            AjaxPost('/kelas/delete', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable({
                scrollX: true
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
