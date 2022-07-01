<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap3.min.css" rel="stylesheet">
    <style>
        .report-title {
            font-size: 14px;
            font-weight: bolder;
        }

        .f-bold {
            font-weight: bold;
        }

        .footer {
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            height: 2cm;
        }
    </style>
</head>
<body>
<div class="text-center f-bold report-title">LAPORAN HASIL KONSULTASI SISWA</div>
<div class="text-center f-bold report-title">SMK MUHAMMADIYAH 1 SUKOHARJO</div>
<hr>
<div class="row">
    <div class="col-xs-2">NIS</div>
    <div class="col-xs-8">: {{ $data->user->username }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Nama Siswa</div>
    <div class="col-xs-8">: {{ $data->user->siswa->nama }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Jurusan</div>
    <div class="col-xs-8">: {{ $data->user->siswa->kelas->jurusan->nama }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Kelas</div>
    <div class="col-xs-8">: {{ $data->user->siswa->kelas->nama }}</div>
</div>
<div class="row">
    <div class="col-xs-2">Judul Laporan</div>
    <div class="col-xs-8">: {{ $data->judul }}</div>
</div>
<hr>
<table id="my-table" class="table display">
    <thead>
    <tr>
        <th width="5%" class="text-center">#</th>
        <th width="15%">Tanggal</th>
        <th width="15%">Keterangan</th>
        <th>Hasil</th>
        <th width="15%">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data->konsultasi as $v)
        <tr>
            <td class="text-center">{{ $loop->index + 1 }}</td>
            <td>{{ $v->tanggal }}</td>
            <td>{{ $v->judul }}</td>
            <td>{{ $v->keterangan }}</td>
            <td class="text-center">{{ ucwords($v->status) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
<div class="row">
    <div class="col-xs-8"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Sukoharjo, {{ date('d-m-Y') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Siswa</p>
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Pembimbing</p>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">({{ $data->user->siswa->nama }})</p>
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">({{ $data->pembimbing->guru->nama }})</p>
        </div>
    </div>
</div>
</body>
</html>
