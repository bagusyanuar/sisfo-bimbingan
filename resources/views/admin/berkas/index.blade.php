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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Pengajuan Berkas Magang Siswa</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Pengajuan Berkas Magang Siswa
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
                    <th>File Kegiatan</th>
                    <th>File Selesai Magang</th>
                    <th>File Penilaian</th>
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
                        <td><a href="{{ asset('/berkas').'/'.$v->file_kegiatan }}" target="_blank">{{ $v->file_kegiatan }}</a></td>
                        <td><a href="{{ asset('/berkas').'/'.$v->file_selesai }}" target="_blank">{{ $v->file_selesai }}</a></td>
                        <td><a href="{{ asset('/berkas').'/'.$v->file_penilaian }}" target="_blank">{{ $v->file_penilaian }}</a></td>
                        <td class="text-center">
                            <a href="/pengajuan-berkas/detail/{{ $v->id }}" class="btn btn-sm btn-info btn-detail"
                               data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
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

        $(document).ready(function () {
            $('#table-data').DataTable({
                scrollX: true
            });
        });
    </script>
@endsection
