<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        .:: QUOTES TUGAS AKHIR :.
    </title>
    <style>
        body {
            background-image: url("images/download-boboiboy.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 20px;
            color: white;
        }

        i {
            font-size: 20px;
            font-weight: bold;
        }
    </style>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b29ffa4940f0ae5083b6', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    </script>
</head>
<body>

    <center>
        <i>
            " Hallo, Ini Adalah Sekedar Kata - Kata Penyemangat TA, (insya Allah) "
        </i>
        <br><br>
        <i>
            " Allah Tau Kamu Kuat, Makannya Kamu Milih TEKNIK INFORMATIKA. Nikmatin Yaa, Sebentar Lagi :))) "
        </i>
        <br><br>
        <i>
            " Allah Tidak Akan Menguji Di Luar Kemampuan Hambanya. "
        </i>
        <br><br>
        <i>
            " ~ Need Someone to Talk ~ ",
            "BOLEHHHHHHH"
        </i>
    </center>

</body>
</html>
