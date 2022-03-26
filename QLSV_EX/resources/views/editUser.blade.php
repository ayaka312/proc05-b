<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chỉnh sửa thông tin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class='active'><a href="{{ route('home') }}">Trang chủ</a></li>
                <li><a href="{{ route('listExercise') }}">
                        @if (session('type') == 'teacher')
                            Thêm bài tập
                        @else
                            Danh sách bài tập
                        @endif

                    </a>
                </li>
                <li><a href="{{ route('listChallenge') }}">
                        @if (session('type') == 'teacher')
                            Thêm challenge
                        @else
                            Challenge
                        @endif
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!empty(session('username')))
                    @php
                        $user = User::where('username', session('username'))->first();
                    @endphp
                    <li><a href="{{ route('editUser', $user->id) }}"><span class="glyphicon glyphicon-user"></span>
                            Thông tin
                            người dùng</a></li>
                    <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Đăng xuất</a>
                    </li>
                @else
                    <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-user"></span>
                            Đăng nhập</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <div class="page-header">
        <h1>Chỉnh sửa thông tin</h1>
    </div>

    <div class="container">
        <form action="{{ route('updateUser', $userInfo->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (session('type') == 'teacher')
                <div class='form-group'>
                    <label>Tên đăng nhập: </label>
                    <input class='form-control' type='username' name='username' value='{{ $userInfo->username }}'>
                    @error('username')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class='form-group'>
                    <label>Họ tên: </label>
                    <input class='form-control' type='text' name='fullname' value='{{ $userInfo->fullname }}'>
                    @error('fullname')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label>Mật khẩu: </label>
                <input class="form-control" type="password" name="password" value="{{ $userInfo->password }}">
                @error('password')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Email: </label>
                <input class="form-control" type="email" name="email" value="{{ $userInfo->email }}">
                @error('email')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Số điện thoại: </label>
                <input class="form-control" type="tel" name="phoneNumber" value="{{ $userInfo->phoneNumber }}"
                    pattern="[0-9]{7,10}">
                @error('phoneNumber')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Ảnh sản phẩm</label>
                <input name="file" type="file" class="form-control" value="">
                @error('file')
                    <small class='text-danger'>{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success" type='submit'>Xác nhận</button>
        </form>

    </div>

</body>

</html>
