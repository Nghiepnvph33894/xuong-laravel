<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <div style="text-align: center; padding: 20px;">
        <h2>Hello, {{ $user->first_name . '' . $user->last_name }}</h2>
        <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấp vào nút bên dưới để đặt lại mật khẩu của bạn:</p>

        <a href="{{ $resetUrl }}"
            style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
            Đặt lại mật khẩu
        </a>

        <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này.</p>
    </div>
</body>

</html>
