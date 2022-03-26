<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách challenge</title>
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
        <h1>Danh sách challenge</h1>
    </div>


    @if (session('type') == 'teacher')
        <div class='container'>
            <a class='btn btn-success' href='{{ route('addChallenge') }}'>Thêm challenge</a>
        </div>
        <br>
    @endif
    @if ($challenges->count() > 0)

        <div class="container panel-group">
            @if (session('status'))
                <div class="alert alert-success">



                    {{ session('status') }}



                </div>
            @endif
            @foreach ($challenges as $challenge)
                <div class='panel panel-primary'>
                    <div class='panel-heading'>{{ $challenge->title }}</div>
                    <div class='panel-body'>Gợi ý: {{ $challenge->description }}</div>
                    @if (session('type') == 'student')
                        <div class='panel-body'><a class='btn btn-warning' href='{{ route('submitChallenge', $challenge->id) }}'>Nộp</a></div>
                    @elseif (session('type') == 'teacher')
                        <div class='panel-body'>
                            <form class='form-inline'>
                                <a class='btn btn-danger btn-inline' href='{{ route('deleteChallenge', $challenge->id) }}'
                                    onclick="return confirm('Bạn có muốn xóa?')">Xóa</a>
                            </form>
                        </div>
                    @endif

                </div>
            @endforeach


        </div>
    @endif

</body>

</html>
