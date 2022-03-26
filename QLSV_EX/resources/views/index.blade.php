<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang quản trị chung</title>
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
        <h1>Danh sách người dùng</h1>
    </div>

    @if (session('type') == 'teacher')
        <div class='container'>
            <a class='btn btn-success' href='{{ route('addUser') }}'>Thêm tài khoản</a>
        </div>
        <br>
    @endif

    @if ($users->count() > 0)

        <div class="container panel-group">
            @if (session('status'))
                <div class="alert alert-success">



                    {{ session('status') }}



                </div>
            @endif
            @foreach ($users as $user)
                <div class='panel panel-success'>
                    <div class='panel-heading'><img width='30' height='30'
                            src='{{ url('uploads/users/' . $user->avatar) }}' />Họ tên: {{ $user->fullname }}
                    </div>
                    <div class='panel-body'>Email: {{ $user->email }}</div>
                    <div class='panel-body'>Số điện thoại: {{ $user->phoneNumber }}</div>
                    <div class='panel-body'>
                        <a class='btn btn-info' href='{{ route('sendMessage', $user->id) }}'>Gửi tin nhắn</a>

                        @if (session('type') == 'teacher')
                            <button class='btn btn-danger' style='float:right;'
                                onclick="return confirm('Bạn có muốn xóa tài khoản?')"><a style='color:white'
                                    href='{{ route('deleteUser', $user->id) }}'>Xóa</a></button>
                            <a class='btn btn-primary' href='{{ route('editUser', $user->id) }}'
                                style='float:right'>Chỉnh sửa
                                thông tin</a>
                        @endif

                    </div>
                </div>
            @endforeach


        </div>
    @endif

</body>

</html>
