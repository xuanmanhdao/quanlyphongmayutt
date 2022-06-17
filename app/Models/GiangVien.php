<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class GiangVien extends Model
{
    use HasFactory;

    use Notifiable;

   

    protected $table = 'giangvien';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'MaGiangVien';

    protected $keyType = 'string';

    protected $fillable = [
        'MaGiangVien',
        'HoTen',
        'GioiTinh',
        'Email',
        'SDT'
    ];

    public function getGioiTinh()
    {
        $gioiTinh = '';
        if ($this->GioiTinh === 0) {
            $gioiTinh = 'Nữ';
        } else if ($this->GioiTinh === 1) {
            $gioiTinh = 'Nam';
        } else {
            $gioiTinh = 'Giới tính không xác định';
        }
        return $gioiTinh;
    }

    public function TaiKhoan(){
        return $this->hasOne(TaiKhoan::class, 'MaGiangVien');
    }

      /**
     * Remove the specified resource from storage.
     *
     * Test change column name email
     */
    // public function getEmailAttribute()
    // {
    //     return $this->Email;
    // }

    // public function setEmailAttribute($value)
    // {
    //     $this->attributes['Email'] = $value;
    // }

    // public function getEmailForPasswordReset()
    // {
    //     return $this->Email;
    // }

    public function routeNotificationFor($driver, $notification = null)
    {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}($notification);
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                // return $this->email; // Đây là mặc định của laravel
                return $this->Email; // Mình sẽ xử lý bằng cách trỏ đến chuẩn tên cột của mình trong sql
                
        }
    }
}
