<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // في حال كان لديك قاعدة بيانات تحتوي على كلمة المرور المشفرة
    protected static function booted()
    {
        static::creating(function ($user) {
            if ($user->password) {
                $user->password = Hash::make($user->password); // تشفير كلمة المرور قبل الحفظ
            }
        });

        static::updating(function ($user) {
            if ($user->password) {
                $user->password = Hash::make($user->password); // تشفير كلمة المرور عند التحديث
            }
        });
    }
}
