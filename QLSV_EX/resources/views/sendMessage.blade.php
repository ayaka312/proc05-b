<?php
use App\User;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Send message</title>
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
        <h1>Gửi tin nhắn tới: {{ $fullnameUser }}</h1>
    </div>

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success">



                {{ session('status') }}



            </div>
        @endif
        @if ($allMessages->count() > 0)
            @foreach ($allMessages as $message) 
                <div class='media'>
                    <div class='media-body text-right'>
                        <h3 class='media-heading'>{{ $message->fullname }}</h3>
                        <div class='mess' style="padding: 0 10px">{{ $message->content }}</div>
                        <br>
                        <a href='{{ route('editMessage', $message->id) }}' style='float:right'>Sửa
                        </a>
                        <a onclick="return confirm('Bạn có muốn xóa tin nhắn?')" href='{{ route('deleteMessage', $message->id) }}' style='float:right; margin-right: 5px'> Xóa </a>
                    </div>
                </div>
            @endforeach

        @endif


        <div id="bottomPage">
            <br>
            <form action='{{ route('storeMessage', $idUser) }}' method='post'>
                @csrf
                <div class="input-group">
                    <input type="text" class="newmess" class="form-control " placeholder="Gửi tin nhắn"
                        name='messageContent' required>
                    <span class="input-group-btn">
                        <button class="sendmess" type="submit" name='newMessage' class="btn btn-default">
                            Gửi
                        </button>
                    </span>
                </div>
            </form>
        </div>
        <br>

    </div>

</body>

</html>
