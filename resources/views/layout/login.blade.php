<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Tiket BIS Online Damri Kalbar</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
    
    <!-- header -->
    <header id="header" style="margin-left:0;">
        <div class="container">
            <!-- box-logo -->
            <div class="box-logo">
                <img class="box-logo-image" src="img/damri-logo.png" style="width: 65px;">
                <h1 class="box-logo-title">Perum Damri Kantor Cab. Pontianak</h1>
                <h2 class="box-logo-title">Kalimantan Barat</h2>
                <p class="box-logo-caption">Damri Online System</p>
            </div>
            <!-- end-box-logo -->
        </div>
    </header>

    <section class="section-login">
        <div class="cover-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ url('auth/login') }}" method="POST" class="form-login">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-primary" value="Login">
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="login-banner">
                            <h2>Selamat Datang</h2>
                            <h4>Kami siap memberikan pelayanan terbaik untuk kenyamanan dalam perjalanan anda</h4>
                            <div class="partner">
                                <img src="{{ url('img/logo-mitra.jpg') }}" alt="" style="width: 250px;">
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </section>

    <section class="section-caption-login">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <i class="fa fa-arrows"></i>
                    <h4>Dukungan Trayek</h4>
                    <p>Didukung dengan jangkauan trayek yang luas akan lebih memudahkan anda dalam melakukan perjalanan kesegala penjuru wilayah</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-bus"></i>
                    <h4>Kekuatan Armada</h4>
                    <p>Dengan segala kekuatan yang berjumlah lebih dari 100 armada, kami siap untuk memenuhi segala kebutuhan transportasi anda</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-money"></i>
                    <h4>Kemudahan Pembayaran</h4>
                    <p>Dapatkan kemudahan dalam proses pembayaran tiket secara online dengan melakukan pembayaran di semua mitra pembayaran yang telah kami siapkan</p>
                </div>
                <div class="col-md-3">
                    <i class="fa fa-road"></i>
                    <h4>Produk Layanan Paket Pariwisata</h4>
                    <p>Dengan segala kemudahan, fasilitas dan ditunjang dengan mitra kerja yang hebat, nikmati produk baru kami berupa paket perjalanan wisata dalam dan luar negeri.</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>