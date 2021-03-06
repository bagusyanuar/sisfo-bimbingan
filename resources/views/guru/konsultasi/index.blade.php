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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Konsultasi Siswa</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Konsultasi Siswa
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
{{--            @if($pengajuan->pengajuan_success == null)--}}
{{--                <div class="text-right mb-2 pr-3">--}}
{{--                    <a href="/pengajuan/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span--}}
{{--                            class="font-weight-bold">Tambah</span></a>--}}
{{--                </div>--}}
{{--            @endif--}}
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Tanggal</th>
                    <th>Judul laporan</th>
                    <th>Nama Siswa</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $v->tanggal }}</td>
                        <td>{{ $v->pengajuan->judul }}</td>
                        <td>{{ $v->pengajuan->user->siswa->nama }}</td>
                        <td>{{ $v->pengajuan->user->siswa->kelas->jurusan->nama }}</td>
                        <td>{{ $v->pengajuan->user->siswa->kelas->nama }}</td>
                        <td>{{ $v->status }}</td>
                        <td>
                            <a href="/konsultasi-guru/detail/{{ $v->id }}" class="btn btn-sm btn-info btn-edit"
                               data-id="{{ $v->id }}"><i class="fa fa-info"></i></a>
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
            AjaxPost('/admin/delete', {id}, function () {
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
