<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Model
{
    use HasFactory;

    use Notifiable;

    protected $table = 'taikhoan';

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'MaGiangVien';

    protected $keyType = 'string';

    protected $fillable = [
        'MaGiangVien',
        'MatKhau',
        'Quyen'
    ];

    public function getTenQuyen()
    {
        $quyen = '';
        if ($this->Quyen === 0) {
            $quyen = 'Giao quyền admin';
        } else if ($this->Quyen === 1) {
            $quyen = 'Đang hoạt động';
        } else if ($this->Quyen === 2) {
            $quyen = 'Khóa hoạt động';
        }
        return $quyen;
    }
    
    public function GiangVien()
    {
        return $this->hasOne(GiangVien::class, 'MaGiangVien');
    }
}
