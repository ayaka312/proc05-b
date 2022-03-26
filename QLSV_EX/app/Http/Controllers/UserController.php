<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
    public function checkLogin(Request $request)
    {
        $request->validate(
            [
                'username' => ['required'],
                'password' => ['required']
            ],
            [
                'required' => ':attribute không được để trống'
            ],
            [
                'username' => "Tên đăng nhập",
                'password' => 'Mật khẩu'
            ]
        );
        $username = $request->username;
        $password = $request->password;
        $user = User::where([
            'username' => $username,
            'password' => $password
        ])->first();
        if (!empty($user)) {
            $type = $user->type;

            session([
                'type' => $type,
                'username' => $username,
                'userId' => $user->id
            ]);
            return redirect()->route('home');
        } else {
            $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
            return back();
        }
    }
    public function add()
    {
        return view('addUser');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => ['required', 'unique:user'],
                'password' => ['required', 'min:6', 'confirmed'],
                'fullname' => 'required',
                'email' => 'required',
                'phoneNumber' => 'required',
                'type' => 'required',
                'file' => ['required', 'image']

            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => ':attribute đã tồn tại trên hệ thống',
                'min' => ':attribute tối thiểu là :min kí tự',
                'confirmed' => ':attribute phải trùng với :attribute trước đó',
                'image' => ':attribute phải có định dạng ảnh'
            ],
            [
                'username' => 'Tên đăng nhập',
                'password' => 'Mật khẩu',
                'fullname' => 'Họ và tên',
                'phoneNumber' => 'Số điện thoại',
                'file' => 'Ảnh đại diện',
                'type' => 'Loại'
            ]
        );
        $input = $request->all();
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file_original = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_array = Str::of($file_original)->explode('.');
            $file_name = $file_array[0];
            $target_dir = 'uploads/users/';
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
                $input['avatar'] = $file_upload;
            }
        }
        User::create($input);
        return redirect()->route('home')->with(['status' => 'Bạn đã thêm mới user thành công']);
    }
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('status', 'Đã xóa user thành công');
    }
    public function edit($id)
    {
        $userInfo =  User::find($id);

        return view('editUser', compact('userInfo'));
    }
    public function update(Request $request, $id)

    {
        if (session('type') == 'teacher') {


            $request->validate(
                [
                    'username' => ['required'],
                    'password' => ['required', 'min:6'],
                    'fullname' => 'required',
                    'email' => 'required',
                    'phoneNumber' => 'required',
                    'file' => ['image']

                ],
                [
                    'required' => ':attribute không được để trống',
                    'unique' => ':attribute đã tồn tại trên hệ thống',
                    'min' => ':attribute tối thiểu là :min kí tự',
                    'confirmed' => ':attribute phải trùng với :attribute trước đó',
                    'image' => ':attribute phải có định dạng ảnh'
                ],
                [
                    'username' => 'Tên đăng nhập',
                    'password' => 'Mật khẩu',
                    'fullname' => 'Họ và tên',
                    'phoneNumber' => 'Số điện thoại',
                    'file' => 'Ảnh đại diện',
                ]
            );
        } else {
            $request->validate(
                [
                    'password' => ['required', 'min:6'],
                    'email' => 'required',
                    'phoneNumber' => 'required',
                    'file' => ['image']

                ],
                [
                    'required' => ':attribute không được để trống',
                    'unique' => ':attribute đã tồn tại trên hệ thống',
                    'min' => ':attribute tối thiểu là :min kí tự',
                    'confirmed' => ':attribute phải trùng với :attribute trước đó',
                    'image' => ':attribute phải có định dạng ảnh'
                ],
                [
                    'password' => 'Mật khẩu',
                    'phoneNumber' => 'Số điện thoại',
                    'file' => 'Ảnh đại diện',
                ]
            );
        }
        if ($request->hasFile('file')) {
            $file = $request->file;
            $file_original = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $file_array = Str::of($file_original)->explode('.');
            $file_name = $file_array[0];
            $target_dir = 'uploads/users/';
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
                $avatar = $file_upload;
            }
        }
        if (session('type') == 'teacher') {
            if (!empty($avatar)) {
                User::find($id)->update([
                    'username' => $request->username,
                    'password' => $request->password,
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                    'avatar' => $avatar
                ]);
            } else {
                User::find($id)->update([
                    'username' => $request->username,
                    'password' => $request->password,
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                ]);
            }
        } else {
            if (!empty($avatar)) {
                User::find($id)->update([
                    'password' => $request->password,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                    'avatar' => $avatar
                ]);
            } else {
                User::find($id)->update([
                    'password' => $request->password,
                    'email' => $request->email,
                    'phoneNumber' => $request->phoneNumber,
                ]);
            }
        }


        return redirect()->route('home')->with(['status' => 'Bạn đã cập nhật user thành công']);
    }
}
