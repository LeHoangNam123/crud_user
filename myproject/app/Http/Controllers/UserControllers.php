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
    public function show($user_id){
        $user = User::find($user_id);
        return view('show_user', compact('user'));
    }
    /**
     * Cập nhật người dùng cần 2 bước
     * B1: trả về trang sửa người dùng + người dùng muốn sửav thông qua  compact
     * B2: nhận request validate và xử lý cập nhật
     */
    public function edit($user_id){
        $user = User::find($user_id);
        if (!$user) {
            return back()->with("error", "User không tồn tại!");
        }
        return view('edit_user', compact('user'));
    }
    public function update(Request $request, $user_id){
        $user = User::find($user_id);
        if (!$user) {
            return back()->with("error", "User không tồn tại!");
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|max:2048',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        //xử lý cập nhật
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        /**
         * 2 trường hợp khi update user image
         * th1: Không chọn ảnh mới -> đéo xử lý
         * th2: chọn ảnh mới -> xóa ảnh cũ cập nhật ảnh mới
         */
        if ($request->hasFile('image')) { // kiểm ta coi có request này k
            $image = $request->file('image');
            $filename = 'user'. '-'.time().rand(1,999). '.' .$image->extension();
            $image->move(public_path('images/users'), $filename);
            $user->image = $filename;
        }
        $user->save();
        // return redirect()->route('index')->with("success", "Cập nhật user thành công");
        return redirect()->route('login');
    }

    public function index(){
        $users = DB::table('users')->paginate(4);
        return view('index', compact('users'));
    }
    //
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
