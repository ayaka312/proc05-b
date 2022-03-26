<?php

namespace App\Http\Controllers;

use App\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ChallengeController extends Controller
{
    //
    public function index()
    {
        $challenges = Challenge::orderBy('created_at', 'desc')->get();
        return view('listChallenge', compact('challenges'));
    }
    public function add()
    {
        return view('addChallenge');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file_original = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_array = Str::of($file_original)->explode('.');
            $file_name = $file_array[0];
            $target_dir = 'uploads/challenges/';
            $file_upload = $file_original;

            $file_path = $target_dir . $file_upload;
            if (file_exists($file_path)) {
                //Tao ra ten file moi
                $new_file_name = $file_name . ' - Copy.';
                $file_upload = $new_file_name . $extension;
                $new_upload_path = $target_dir . $file_upload;
                $k = 1;
                while (file_exists($new_upload_path)) {
                    //=====================================================
                    //Tiep tuc tao ra ten file moi
                    //=====================================================
                    $new_file_name = $file_name . " - Copy({$k}).";
                    $k++;
                    $file_upload = $new_file_name . $extension;
                    $new_upload_path = $target_dir . $file_upload;
                }
                $file_path = $new_upload_path;
            }
            if ($file->move($target_dir,  $file_upload)) {
                $excercise = $file_upload;
            }
            $input['filePath'] = $excercise;
        }
        $input['teacherId']   = session('userId');
        Challenge::create($input);
        return redirect()->route('listChallenge')->with(['status' => 'Bạn đã thêm mới thử thách thành công']);
    }
    public function delete($id)
    {
        $challenge = Challenge::find($id);
        $file_path = 'uploads/challenges/' . $challenge->filePath;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        Challenge::find($id)->delete();
        return redirect()->back()->with(['status' => 'Đã xóa thử thách thành công']);
    }
    public function submit($id)
    {
        $challenge = Challenge::find($id);
        return view('sbmChallenge', compact('challenge'));
    }
    public function storeSubmit(Request $request, $id)
    {
        $challenge = Challenge::find($id);
        $result = $challenge->filePath;
        $file_array = Str::of($result)->explode('.');
        $file_name = $file_array[0];
        $answer = Str::slug($request->answer);
        if ($answer != $file_name) {
            return redirect()->back()->withErrors(['message' => 'Đáp án sai']);
        } else {
            return redirect()->back()->with(['message' => 'Đáp án đúng']);
        }
    }
}
