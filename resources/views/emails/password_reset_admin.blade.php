<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset Request</h2>
    <p>You can reset your password by clicking the link below:</p>
    <a href="{{ url('/admin-reset-password?token=' . $token) }}" target="_blank">Reset Password</a>
    <p><strong>Note:</strong> This link will expire in 10 minutes. Please use it before the expiration time.</p>
    <p>If you did not request this, please ignore this email.</p>
</body>
</html>
