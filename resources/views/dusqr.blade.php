<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inknut Antiqua', serif;
            font-family: 'Ravi Prakash', cursive;
            font-family: 'Lora', serif;
            font-family: 'Indie Flower', cursive;
            font-family: 'Cabin', sans-serif;
        }

        div.container {
            max-width: 1350px;
            margin: 0 auto;
            overflow: hidden
        }

        img {
            display: block;
            width: 100%;
            height: auto;
            padding-bottom: 12px;
        }

        .container .item {
            width: 100%;
            float: left;
            padding: 0 20px;
            background: #fff;
            overflow: hidden;
            margin: 10px
        }

        .container .item-right,
        .container .item-left {
            float: left;
            padding: 20px
        }
        

        .container .item-right {
            margin-right: 20px;
            width: 30%;
            position: relative;
            height: auto;
        }

        .container .item-right .num {
            font-size: 80px;
            text-align: center;
            color: #e7a400;
        }

        .container .item-right .day,
        .container .item-left .event {
            color: #e7a400;
            font-size: 10px;
        }

        .container .item-right .day,
        .container .item-left .events {
            padding-top: 15px;
            color: #e7a400;
            font-size: 10px;
        }

        .container .item-right .day {
            text-align: center;
            font-size: 25px;
        }

        .container .item-left {
            width: 65%;
            padding: 34px 0px 19px 46px;
            border-left: 2px dotted #999;
        }

        .container .item-left .title {
            color: #111;
            font-size: 34px;
            margin-bottom: 12px
        }

        .container .item-left .sce {
            margin-top: 5px;
            display: block
        }

        .container .item-left .sce .icon,
        .container .item-left .sce p,
        .container .item-left .loc .icon,
        .container .item-left .loc p {
            float: left;
            word-spacing: 5px;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 10px;
        }

        .container .item-left .sce .icon,
        .container .item-left .loc .icon {
            margin-right: 10px;
            font-size: 20px;
            color: #666
        }

        .container .item-left .loc {
            display: block
        }

        .container .item-left .num {
            font-size: 150px;
            text-align: center;
            color: #e7a400;
        }

        .fix {
            clear: both
        }

        .container .item .tickets,
        .booked,
        .cancel {
            color: #fff;
            padding: 6px 14px;
            float: right;
            margin-top: 10px;
            font-size: 18px;
            border: none;
            cursor: pointer
        }

        .container .item .tickets {
            background: #e7a400
        }

        .container .item .booked {
            background: #3D71E9
        }

        .container .item .cancel {
            background: #DF5454
        }

        .linethrough {
            text-decoration: line-through
        }

        table {
            table-layout: auto;
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 2px;
            background-color: rgba(255, 255, 255, 0.2);
            text-align: left;
        }

        th {
            text-align: center;
        }

        tr {
            text-align: center;
        }

        span {
            content: "\203A";
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="item">
            <div class="item-right">
                <img src="{{public_path('storage'.$data->qr_path)}}">

            </div> <!-- end item-right -->

            <div class="item-left">
                <h2 class="num">{{$data->nama_dus}}</h2>
                <!-- <table>
                    <thead>
                        <tr>
                            <th colspan="2">Nama Dokumen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arsips as $arsip)
                        <tr>
                            <td style="width:10px; vertical-align: top">
                                <span>&#8250;</span>
                            </td>
                            <td>
                                {{$arsip->nama_arsip}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> -->
                <div class="fix"></div>
                <button class="tickets">E-Arsip BPK RI</button>
                <p class="events">{{url('/')}}</p>
                <p class="event">{{$time}}</p>
            </div> <!-- end item-right -->
        </div> <!-- end item -->
</body>

</html>