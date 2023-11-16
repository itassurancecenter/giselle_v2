<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GISELLE</title>

    <link rel="apple-touch-icon" href="{{asset('logo/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('logo/logo.png')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header" style="background-color: #b30000; color: white;">
                <h3 class="card-title m-0 center"><strong>GISELLE</strong></h3>
            </div>
            <form action="{{ route('login.doLogin') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for=""><strong>Username</strong></label>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group mb-3">
                        <label for=""><strong>Password</strong></label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-danger btn-block"
                                style="background-color: #b30000"><strong>Masuk</strong></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
    </div>
</body>

</html>
