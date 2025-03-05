<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thay đổi mật khẩu</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #dddddd; border-radius:5px;">
                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding: 20px; background-color:#F0EAD8; border-bottom:1px solid #dddddd;">
                            {{-- <img src="/images/web/{{$info['logo']}}" alt="User Avatar" width="100"> --}}
                            <h3>HCinema</h3>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding: 20px; text-align:center;">
                            <h2 style="font-family: Arial, sans-serif; color:#333333;">{{ $account->fullname }}</h2>
                            <p style="font-family: Arial, sans-serif; color:#555555;">Click vào đây để xác thực thay đổi mật khẩu của bạn.</p>
                            <a href="{{$link_verify}}" style="display:inline-block; padding:10px 20px; font-family: Arial, sans-serif; color:#ffffff; background-color:#007bff; text-decoration:none; border-radius:5px;">Xác thực</a>
                        </td>
                    </tr>
                    <!-- Footer -->
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
