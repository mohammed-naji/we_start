<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background: #f5f5f5;font-family:Arial, Helvetica, sans-serif">
    <div style="width: 600px;border: 2px solid #dddddd; padding: 30px;background: #fff;margin: 30px auto;">
        <p>There is new email with the follwing data</p>
        <p><b>Name</b>: {{ $data['name'] }}</p>
        <p><b>Email</b>: {{ $data['email'] }}</p>
        <p><b>Subject</b>: {{ $data['subject'] }}</p>
        <p><b>Message</b>: {{ $data['message'] }}</p>
    </div>
</body>
</html>
