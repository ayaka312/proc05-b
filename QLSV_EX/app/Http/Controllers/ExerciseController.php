<?php

namespace App\Http\Controllers;

use App\Excercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Exercise;
use App\SbmExercise;

class ExerciseController extends Controller 
{
    //
    public function index()
    {
        $allExercises = Exercise::orderBy('created_at','DESC')->get();
        return view('listExercise', compact('allExercises'));
    }
    public function add()
    {

        return view('addExercise');
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
            $target_dir = 'uploads/exercises/';
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
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['teacherId']   = session('userId');
        Exercise::create($input);
        return redirect()->route('listExercise')->with(['status' => 'Bạn đã thêm mới bài tập thành công']);
    }
    public function delete($id)
    {
        Exercise::find($id)->delete();
        return redirect()->back()->with('status', 'Đã xóa bài tập thành công');
    }
    public function submit($id)
    {
        $exercise = Exercise::find($id);
        return view('sbmExercise', compact('exercise'));
    }
    public function storeSubmit(Request $request, $id)
    {
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file_original = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_array = Str::of($file_original)->explode('.');
            $file_name = $file_array[0];
            $target_dir = 'uploads/sbmExercises/std'  . session('userId') . '/';
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

                SbmExercise::create([
                    'exerciseId' => $id,
                    'studentId' => session('userId'),
                    'filePath' => $file_upload
                ]);
                return redirect()->route('listExercise')->with(['status' => 'Bạn đã nộp bài thành công']);
            }
        }
    }
    public function seeSubmit($id)
    {
        $exercise = Exercise::find($id);
        $listSubmited = SbmExercise::where('exerciseId', $id)->join('user', 'sbmExercise.studentId', '=', 'user.id')->select('sbmExercise.*', 'user.fullname')->get();
        return view('seeSbmExercise', compact('exercise', 'listSubmited'));
    }
}
