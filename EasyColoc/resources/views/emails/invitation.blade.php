<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>You are invited to join a colocation!</h2>

<p>Please choose an option below:</p>

<a href="{{ $acceptLink }}"
   style="padding:10px 20px;background:#22c55e;color:white;text-decoration:none;border-radius:6px;">
    ✅ Accept Invitation
</a>

<br><br>

<a href="{{ $refuseLink }}"
   style="padding:10px 20px;background:#ef4444;color:white;text-decoration:none;border-radius:6px;">
    ❌ Refuse Invitation
</a>
</body>
</html>

