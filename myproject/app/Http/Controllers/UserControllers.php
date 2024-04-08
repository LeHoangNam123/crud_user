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

    
}
