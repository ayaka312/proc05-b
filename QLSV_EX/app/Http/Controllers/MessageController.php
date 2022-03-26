<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\User;

class MessageController extends Controller
{
    //
    public function send($id)
    {
        $user = User::find($id); 
        $idUser = $user->id;
        $fullnameUser = $user->fullname;
        $allMessages = Message::where([
            'sendId' => session('userId'),
            'receiveId' => $id
        ])->join('user', 'message.sendId', '=', 'user.id')->select('message.*', 'user.fullname')->get();
        return view('sendMessage', compact('allMessages', 'user', 'fullnameUser', 'idUser'));
    }
    public function store(Request $request ,$id){
        Message::create([
            'sendId' => session('userId'),
            'receiveId' => $id,
            'content' => $request->messageContent
        ]);
        return redirect()->back()->with('status' , 'Đã gửi tin nhắn thành công');
    }
    public function delete($id){
        Message::find($id)->delete();
        return redirect()->back()->with('status' , 'Đã xóa tin nhắn thành công');

    }
    public function edit($id){
        $message = Message::find($id);
        return view('editMessage', compact('message'));
    }
    public function update(Request $request, $id){
        $message = Message::find($id);
        $content = $request->messageContent;
        Message::find($id)->update([
            'content' => $content
        ]);
        return redirect()->route('sendMessage', $message->receiveId)->with('status' , 'Đã chỉnh sửa tin nhắn thành công');

    }
}
