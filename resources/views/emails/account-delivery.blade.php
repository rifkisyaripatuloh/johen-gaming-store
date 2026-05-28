```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Akun Game Berhasil Dikirim</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:30px;">

<div style="max-width:600px; margin:auto; background:white; padding:30px; border-radius:20px;">

    <h2 style="color:#ff7a00;">
        🎮 Akun Game Berhasil Dikirim
    </h2>

    <p>
        Halo <b>{{ $order->customer_name }}</b>,
    </p>

    <p>
        Terima kasih telah melakukan pembelian akun premium di Johen Gaming.
    </p>

    <hr>

    <h3>📦 Informasi Order</h3>

    <p>
        Invoice :
        <b>{{ $order->invoice }}</b>
    </p>

    <p>
        Total :
        <b>Rp {{ number_format($order->final_price) }}</b>
    </p>

    <hr>

    <h3>🔐 Data Akun</h3>

    <p>
        Email Login :
        <b>{{ $account->login_email }}</b>
    </p>

    <p>
        Password :
        <b>{{ $account->login_password }}</b>
    </p>

    <p>
        Nickname :
        <b>{{ $account->nickname }}</b>
    </p>

    <hr>

    <p style="color:red;">
        Silakan segera ubah password akun setelah login.
    </p>

    <p>
        Terima kasih telah berbelanja di Johen Gaming ❤️
    </p>

</div>

</body>
</html>