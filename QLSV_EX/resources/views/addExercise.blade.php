<?php
use App\User;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Thêm bài tập</title>
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
        <h1>Thêm bài tập</h1>

    </div>
    <div class='container'>
        @if (session('status'))
            <div class="alert alert-success">



                {{ session('status') }}



            </div>
        @endif
        <form action='{{ route('storeExercise') }}' method='post' enctype='multipart/form-data'>
            @csrf
            <div class='form-group'>
                <label for='title'>Đề bài: </label>
                <input type='text' id='title' name='title' required><br>
            </div>
            <div class='form-group'>
                <label for='description'>Mô tả: </label>
                <textarea id='description' name='description' required></textarea><br>
            </div>
            <div class='form-group'>
                <label for='file'>Chọn từ tệp: </label>
                <input type="file" name="file" id="file" required> <br>
            </div>
            <div class='form-group'>
                <button type="submit" class="btn btn-success" value="Upload File" name="submit">Thêm bài tập</button>
                <a class='btn btn-primary' href='listExercise.php'>Hủy</a>
            </div>
        </form>
    </div>
</body>

</html>
