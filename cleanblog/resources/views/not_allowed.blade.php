<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Not Allowed</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: rgb(247, 247, 247);
            font-family: Arial, Helvetica, sans-serif;
            text-align: center
        }

        body .content {
            width: 40%;
        }

        body .content img {
            max-width: 50%;
        }

        body .content a {
            background: #068589;
            color: #ffffff;
            padding: 10px 20px;
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            border-radius: 5px
        }

        body .content a:hover {
            background: #1ca7ab;
        }
    </style>
</head>
<body>

    <div class="content">
        <img src="{{ asset('adminassets/img/forbidden.png') }}" alt="">
        <h1>You dont have access to this page</h1>
        <a href="{{ url('/') }}">Homepage</a>
    </div>

</body>
</html>
