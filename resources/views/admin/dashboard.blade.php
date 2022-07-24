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
            <p class="font-weight-bold mb-0" style="font-size: 20px">Halaman Dashboard</p>
            <ol class="breadcrumb breadcrumb-transparent mb-0">
                <li class="breadcrumb-item active" aria-current="page">Dashboard
                </li>
            </ol>
        </div>
        <img src="{{ asset('/assets/icon/profil1.jpg') }}" class="w-100 mb-3"/>
        <div class="mb-2">
            <p class="font-weight-bold">Visi Sekolah</p>
            <p class="text-justify">Sekolah unggul yang menghasilkan lulusan beriman, bertaqwa,berakhlaq mulia,
                kompeten, mandiri dan tangguh menghadapi era global</p>
        </div>
        <div class="mb-2">
            <p class="font-weight-bold">Misi Sekolah</p>
            <ol type="a">
                <li>
                    <p>Menumbuhkan karakter melalui pembiasaan nilai nilai Islami</p>
                </li>
                <li>
                    <p>Menguatkan pendidikan ketarunaan</p>
                </li>
                <li>
                    <p>Menerapkan budaya industri di lingkungan sekolah
                    </p>
                </li>
                <li>
                    <p>Menerapkan pembelajaran berbasis industri</p>
                </li>
                <li>
                    <p>Menerapkan pembelajaran active learning
                    </p>
                </li>
                <li>
                    <p>Melaksanakan uji kompetensi melalui industri dan atau lembaga sertifikasi profesi</p>
                </li>
                <li>
                    <p>Membangun sumber daya manusia yang mandiri dan profesional</p>
                </li>
                <li>
                    <p>Menerapkan sistem manajemen mutu dan pelayanan prima secara konsisten dan berkelanjutan</p>
                </li>
            </ol>
        </div>
        <div class="mb-2">
            <p class="font-weight-bold">Tujuan</p>
            <ol>
                <li><p>Menghasilkan lulusan yang berakhlaq mulia, santun dan percaya diri</p></li>
                <li><p>Menghasilkan lulusan yang mampu berwira usaha dan siap memasuki lapangan kerja atau pendidikan
                        yang lebih tinggi.</p></li>
                <li><p>Menghasilkan lulusan yang handal dan mampu bersaing di era global</p></li>
                <li><p>Mewujudkan kepuasan pelanggan</p></li>
                <li><p>Mewujudkan perilaku warga sekolah yang sesuai dengan budaya industri</p></li>
            </ol>
        </div>
        <div class="mb-2">
            <p class="font-weight-bold">Slogan</p>
            <p>“ Disiplin, Cerdas, Sukses ”</p>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript">
        let table;
        var role = '{{ auth()->user()->role }}';

        function reload() {
            table.ajax.reload()
        }

        function confirm(id, status) {
            if (role === 'kitchen' && status === '1') {
                handleConfirm(id, status);
            } else if ((role === 'admin' || role === 'kasir') && status === '0') {
                handleConfirm(id, status);
            }
        }

        async function handleConfirm(id, status) {
            try {
                let nextStatus = parseInt(status) + 1;
                let response = await $.post('/transaction', {
                    id: id,
                    status: nextStatus,
                    _token: '{{ csrf_token() }}'
                });
                if (response['status'] === 200) {
                    reload();
                } else {
                    alert('Terjadi Kesalahan Server...');
                }
            } catch (e) {
                alert('Terjadi Kesalahan Server...');
            }
        }

        $(document).ready(function () {
            table = $('#table-data').DataTable({
                "scrollX": true,
                processing: true,
                ajax: {
                    type: 'GET',
                    url: '/transaction/data',
                    'data': function (d) {
                        if (role === 'kitchen') {
                            return $.extend(
                                {},
                                d,
                                {
                                    status: 1
                                }
                            );
                        }
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'tanggal'},
                    {data: 'customer'},
                    {data: 'total'},
                    {
                        data: null, render: function (data, type, row, meta) {
                            let status = data['status'];
                            let statusText = 'Menunggu';
                            let classButton = 'btn-danger';
                            switch (status) {
                                case 1:
                                    statusText = 'Proses';
                                    classButton = 'btn-warning';
                                    break;
                                case 2:
                                    statusText = 'Selesai';
                                    classButton = 'btn-success';
                                    break;
                                default:
                                    break;
                            }
                            return '<a href="#" data-id="' + data['id'] + '" data-status="' + status + '" class="btn ' + classButton + ' btn-sm text-center btn-confirm">' + statusText + '</a>';
                        }
                    },
                ],
                paging: true,
            });


            $(document).on('click', '.btn-confirm', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                let status = this.dataset.status;
                confirm(id, status);
            });
        });
    </script>
@endsection
