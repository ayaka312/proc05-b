<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Danh sách nộp</title>
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
        <h1>Danh sách nộp</h1>
    </div>
    <div class='container'>
        <div class="panel panel-success">
            <div class="panel-heading">Bài tập: {{ $exercise->title }}</div>
            <div class='panel-body'>Gợi ý: {{ $exercise->description }}</div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Danh sách đã nộp</div>
            @if ($listSubmited->count() > 0)
                <div class="panel-body">
                    @foreach ($listSubmited as $submit)
                        <div class='panel panel-info'>
                            <div class='panel-heading'>Họ tên: {{ $submit->fullname }}</div>
                            <div class='panel-body'>Thời gian nộp: {{ $submit->created_at }}</div>
                            <div class='panel-body'><a role='button' class='btn btn-warning'
                                    href='{{ url('uploads/sbmExercises/std' . $submit->studentId . '/' . $submit->filePath) }}'>File:
                                    {{ $submit->filePath }}</a></div>
                        </div>
                    @endforeach

                </div>
            @endif
        </div>
    </div>
</body>

</html>
