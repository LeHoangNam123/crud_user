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
    public function delete($user_id){
        /**
         * Tìm coi user đó tồn tại không theo user_id
         * nếu có xóa
         * hết
         */
        $user = User::find($user_id);
        // kiểm tra nếu không tồn tại
        if (!$user) {
            return back()->with("error", "User không tồn tại!");
        }
        $user->delete();
        return redirect()->route('index');
    }
    // authenticate
    public function login(){
        // trả về giao diện người dùng  => ở resouce -> view 
        return view('auth/login'); //'auth/login' => có 1 folder auth bọc login.blade.php 
    }
    public function customLogin(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        } else {
            return back()->with("error", "Không mật khẩu không chính xác!");
        }
    }
    public function logout(){
        // hàm đăng xuất 
        /**
         * Xử lý đăng xuất
         * tạo router
         * gán thẻ a với router đó
         */ 
        Auth::logout();
        return redirect()->route('login');
    }
}
