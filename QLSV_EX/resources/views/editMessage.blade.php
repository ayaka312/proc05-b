<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sửa tin nhắn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/mycss.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
        <h1>Sửa tin nhắn</h1>
    </div>
    <div class="container">
        <form action='{{ route('updateMessage', $message->id) }}' method='post'>
            @csrf
            <div class="input-group">
                <input type="text" class="newmess" class="form-control " placeholder="Gửi tin nhắn"
                    name='messageContent' required value='{{ $message->content }}'>
                <span class="input-group-btn">
                    <button class="sendmess" type="submit" class="btn btn-default">
                        Gửi
                    </button>
                </span>
            </div>
        </form>
    </div>

    </body>

</html>
