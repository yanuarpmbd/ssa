<!DOCTYPE html>
<html>

<head>
    <title>Permintaan Layanan TI</title>
</head>

<body>
    <p>Halo, {{$ticket->user->name}}</p>
    <p>Pengajuan Layanan TI dengan Nomor Tiket {{$ticket->identifier}}</p>
    <br>
    <p>Nama Pegawai : {{$ticket->user->name}}</p>
    <p>NIP : {{$ticket->user->nip}}</p>
    <p>Jabatan : {{$ticket->user->jabatan}}</p>
    <p>Unit Kerja : {{$ticket->user->unitKerja->nama_unit_kerja}}
    <p>Deskripsi : {{$ticket->content}}</p>
    <br>
    <p>Silahkan klik link dibawah ini untuk melihat detil layanan dan memantau proses penyelesaian layanan</p>
    <br>
    <a href="http://10.126.1.43/tickets/{{$ticket->identifier}}/edit?activeRelationManager=0">http://10.126.1.43/tickets/{{$ticket->identifier}}/edit?activeRelationManager=0</a>
</body>

</html>