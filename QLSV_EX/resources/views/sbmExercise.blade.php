<?php
use App\User;
use App\SbmExercise;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nộp bài tập</title>
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
    <div class='page-header'>
        <br><br>
        <h1>Nộp bài tập</h1>
    </div>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-6'>
                <div class='panel panel-primary'>
                    <div class="panel-heading">{{ $exercise->title }}</div>
                    <div class="panel-body"><i>{{ $exercise->description }}</i></div>
                    <div class='panel-body'>Thời gian nộp: {{  $exercise->created_at }}</div>
                   
                </div>
            </div>
            <div class='col-lg-6'>
                <br>
                <form action='{{ route('storeSubmitExercise', $exercise->id) }}' method='post' enctype='multipart/form-data'>
                    @csrf
                    <div class='form-group'>
                        <label for='file'>Chọn từ tệp: </label>
                        <input class='form-control' type="file" name="file" id="file" required>
                    </div>
                    <input class='btn btn-success' type="submit" value="Nộp bài tập" name="submit">


                </form>

            </div>
        </div>

    </div>
</body>

</html>
