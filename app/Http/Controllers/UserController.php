<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('welcome');  // عرض نموذج الإدخال
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', // تأكد من أن كلمة المرور قوية
        ]);

        // تشفير كلمة المرور
        $validated['password'] = Hash::make($validated['password']);

        // تخزين البيانات في قاعدة البيانات
        User::create($validated);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('users.create')->with('success', 'User created successfully');
    }
}
