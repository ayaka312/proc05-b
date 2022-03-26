<?php
use App\User;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Challenge</title>
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
        <h1>Gửi đáp án</h1>
    </div>
    <div class="container panel-group">
        <div class='panel-heading'>{{ $challenge->title }}</div>
        <div class='panel-body'>Gợi ý: {{ $challenge->description }}</div>
        <form action='{{ route('storeSubmitChallenge', $challenge->id) }}' method='post'>
            @csrf
            <div class="form-group">
                <label for="answer">Đáp án: </label>
                <input required class='form-control' type="text" name="answer" id="answer">
            </div>
            <button class='btn btn-warning' type="submit" name="sbmChallenge">Nộp</button>
            <div style="margin-top: 10px"
                class="status @if (!empty(session('errors'))) text-danger
            @elseif(!empty(session('message')))
            text-success @endif">
                @if (!empty(session('errors')))
                    {{ session('errors')->first('message') }}
                @elseif(!empty(session('message')))
                    {{ session('message') }}
                @endif
            </div>
            @if (!empty(session('message')))

                <div id="content-poem" style="margin-top: 10px">
                    @php
                        $dir = url('uploads/challenges/' . $challenge->filePath);
                        ($myfile = fopen($dir, 'r')) or die('Unable to open file!');
                        // Output one line until end-of-file
                        while (!feof($myfile)) {
                            echo fgets($myfile) . '<br>';
                        }
                        fclose($myfile);
                    @endphp


                </div>
            @endif

        </form>
    </div>
</body>

</html>
