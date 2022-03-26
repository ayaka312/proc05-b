<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="row" class="center">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Đăng nhập</div>
                @if (session('status'))
                    <div class="alert alert-success">



                        {{ session('status') }}



                    </div>
                @endif



                @if (session('error'))
                    <div class="alert alert-danger">



                        {{ session('error') }}



                    </div>
                @endif

                <div class="panel-body">

                    <form role="form" method="post" action="{{ route('checkLogin') }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Tên đăng nhập" name="username" type="username"
                                    autofocus>
                                @error('username')
                                    <small class='text-danger'>{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mật khẩu" name="password" type="password"
                                    value="">
                            </div>
                            @error('password')
                                <small class='text-danger'>{{ $message }}</small>
                            @enderror
                            <button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
