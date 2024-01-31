<!DOCTYPE html>
<html>

<head>
    <title>Reply : Permintaan Layanan TI</title>
</head>

<body>
    <p>Halo, {{$comment->ticket->user->name}}</p>
    <p>Pengajuan Layanan TI dengan Nomor Tiket {{$comment->ticket->identifier}}</p>
    <br>
    <p>Nama Pegawai : {{$comment->ticket->user->name}}</p>
    <p>NIP : {{$comment->ticket->user->nip}}</p>
    <p>Jabatan : {{$comment->ticket->user->jabatan}}</p>
    <p>Unit Kerja : {{$comment->ticket->user->unitKerja->nama_unit_kerja}}
    <p>Deskripsi : {{$comment->ticket->content}}</p>
    <br>
    <p>REPLY : {{$comment->content}}</p>
    <br>
    <p>Silahkan klik link dibawah ini untuk melihat detil layanan dan memantau proses penyelesaian layanan</p>
    <br>
    <a href="http://10.126.1.43/tickets/{{$comment->ticket->identifier}}/edit?activeRelationManager=0">http://10.126.1.43/tickets/{{$comment->ticket->identifier}}/edit?activeRelationManager=0</a>
</body>

</html>