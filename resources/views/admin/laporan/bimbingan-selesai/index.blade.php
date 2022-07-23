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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Laporan Bimbingan Selesai</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="/dashboard">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Laporan Bimbingan Selesai
                </li>
            </ol>
        </div>
        <div class="w-100 p-2">
            <div class="d-flex justify-content-end align-items-center">
                <div class="text-right">
                    <a href="#" class="btn btn-primary" id="btn-cetak">
                        <i class="fa fa-print mr-2"></i>
                        <span>Cetak</span>
                    </a>
                </div>
            </div>
            <table id="table-data" class="display w-100 table table-bordered">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Judul</th>
                    <th>Pembimbing</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var table;
        function reload() {
            table.ajax.reload();
        }
        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/laporan-bimbingan-selesai/data', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'user.username'},
                {data: 'user.siswa.nama'},
                {data: 'user.siswa.kelas.nama'},
                {data: 'judul'},
                {
                    data:null, render: function (data, type, row, meta) {
                        let pembimbing = '';
                        if (data['user']['siswa']['pembimbing'] != null) {
                            pembimbing = data['user']['siswa']['pembimbing']['guru']['nama'];
                        }
                        return pembimbing;
                    }
                },
            ], [], function (d) {

            }, {
                dom: 'ltipr',
            });
            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                window.open('/laporan-bimbingan-selesai/cetak', '_blank');
            })
        });
    </script>
@endsection
