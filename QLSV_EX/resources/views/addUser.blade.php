<?php 
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
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

    <div class="container">
        <div class="center">
            <br>
            <br>
            <h2>Điền thông tin sinh viên </h2>
            <form action="{{ route('storeUser') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" name="username" class="form-control" value="{{ request()->old('username') }}">
                    <span class="help-block"></span>
                    @error('username')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" class="form-control"
                        value="{{ request()->old('password') }}">
                    <span class="help-block"></span>
                    @error('password')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" value="">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label>Họ tên</label>
                    <input type="text" name="fullname" class="form-control"
                        value="{{ request()->old('fullname') }}">
                    <span class="help-block"></span>
                    @error('fullname')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ request()->old('email') }}">
                    <span class="help-block"></span>
                    @error('email')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="tel" name="phoneNumber" class="form-control"
                        value="{{ request()->old('phoneNumber') }}">
                    <span class="help-block"></span>
                    @error('phoneNumber')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Là: </label>
                    <select name="type">
                        <option value="student">Student</option>
                    </select>
                    @error('type')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ảnh</label>
                    <input name="file" type="file" class="form-control" value="">
                    <span class="help-block"></span>
                    @error('file')
                        <small class='text-danger'>{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Đồng ý">
                    <input type="reset" class="btn btn-default" value="Làm mới">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
