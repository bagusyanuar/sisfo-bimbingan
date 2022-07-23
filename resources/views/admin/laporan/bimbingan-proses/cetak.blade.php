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
<div class="text-center f-bold report-title">LAPORAN SISWA PROSES BIMBINGAN</div>
<div class="text-center f-bold report-title">SMK MUHAMMADIYAH 1 SUKOHARJO</div>
<hr>
<table id="my-table" class="table display">
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
    @foreach($data as $v)
        <tr>
            <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
            <td>{{ $v->user->username }}</td>
            <td>{{ $v->user->siswa->nama }}</td>
            <td>{{ $v->user->siswa->kelas->nama }}</td>
            <td>{{ $v->judul }}</td>
            <td>{{$v->user->siswa->pembimbing != null ? $v->user->siswa->pembimbing->guru->nama : '-'}}</td>
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
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">Admin</p>
        </div>
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-xs-3">
        <div class="text-center">
        </div>
    </div>
    <div class="col-xs-5"></div>
    <div class="col-xs-3">
        <div class="text-center">
            <p class="text-center">(Admin)</p>
        </div>
    </div>
</div>
</body>
</html>
