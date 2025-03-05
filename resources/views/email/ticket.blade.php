<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xác thực Email</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">
    
    <div style="margin:0 auto">
        <h2 style="text-align: center">Xin chào {{ $name }}</h2>
        <h3 style="text-align: center"> dưới đây là thông tin vé của bạn vui lòng kiểm tra và mang vé cho nhân viên để vào rạp.</h3>
    </div>
    <div style="width: 800px; margin:0 auto">
        <img style="border:1px solid black" src="https://res.cloudinary.com/{{ $cloud_name }}/image/upload/{{ $cloud }}.png" alt="">
    </div>
</body>
</html>


