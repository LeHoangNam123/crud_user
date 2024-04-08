<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//nhớ import 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;


class UserControllers extends Controller
{
    /**
     * View
     */
    public function show($user_id){
        $user = User::find($user_id);
        return view('show_user', compact('user'));
    }

    /**
     * Để làm chức năng đăng ký cần 2 bước
     * B1: giao diện -> tạo hàm r -> route
     * B2: xử lý $request 
     */
    public function register(){
        return view('auth/register'); //hàm này trả về giao diện B1
    }

    public function customRegister(Request $request){
        /**
         * Nhận request -> valitate data 
         * Xử lý kiểm tra và thêm vào db
         */          
        $validatedData = $request->validate([
            // 'tên trường dữ liệu' => 'xử lý ngoại lệ'
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|max:2048',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = new User([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // mã hóa mật khẩu 
        ]);

        //gán image
        if ($request->hasFile('image')) { // kiểm ta coi có request này k
            $image = $request->file('image');
            $filename = 'user'. '-'.time().rand(1,999). '.' .$image->extension();
            $image->move(public_path('images/users'), $filename);
            $user->image = $filename; //gán tên ảnh cho trường avatar của user
        }
        //lưu user vào db
        $user->save();
        return redirect('login');
    }
}
