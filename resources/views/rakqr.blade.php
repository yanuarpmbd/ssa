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
            width: 70%;
            height: auto;
            padding-bottom: 12px;
            margin-left: auto;
            margin-right: auto;
        }

        .container .item {
            width: 100%;
            float: left;
            padding: 0 20px;
            background: #fff;
            overflow: hidden;
            margin: 10px;
        }

        .container .item .num {
            font-size: 50px;
            text-align: center;
            color: #e7a400;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="item">
            <img src="{{public_path('storage'.$data->qr_path)}}">
            <h2 class="num">{{$data->kode_nama}}</h2>
        </div>
    </div>
</body>

</html>