<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;

    protected $table = 'phong';

    public $timestamps = false;
    
    public $incrementing = false;

    protected $primaryKey = 'MaPhong';

    protected $keyType = 'string';

    protected $fillable = [
        'MaPhong',
        'TenPhong',
        'SoMay',
        'TinhTrang',
        'GhiChu'
    ];

    public function lich_muon_phong() {
        return $this->belongsTo(LichMuonPhong::class, 'MaPhong', 'MaPhong');
    }

    public function getTenToaNha()
    {
        // $arrMaPhong = explode('.', $this->MaPhong); // Cắt chuỗi route theo ký tự . rồi push vào arr[]
        // $tenToaNha=$arrMaPhong[0];
        $tenToaNha = substr($this->MaPhong, 0, 2);
        return $tenToaNha;
    }

    public function setTenPhong($tenPhong)
    {
        $this->TenPhong = 'P' . $tenPhong;
        // return $this;
    }

    public function getTenPhong()
    {
      return $this->TenPhong;
    }
    

    public function getTenPhongKhongP()
    {
        $tenPhong = substr($this->TenPhong, 1);
        return $tenPhong;
    }

    public function setMaPhong($tenToaNha)
    {
        $this->MaPhong = $tenToaNha . '' . $this->TenPhong;
    }

    // public function getDateOfCreatedAt()
    // {
    //     return $this->created_at->format('d-m-Y');
    // }

    // public function getDateOfUpdateAt()
    // {
    //     return $this->updated_at->format('d-m-Y');
    // }

    public function getTinhTrang()
    {
        $tinhTrang = '';
        if ($this->TinhTrang === 0) {
            $tinhTrang = 'Đang hoạt động';
        } else {
            $tinhTrang = 'Đang bảo trì';
        }
        return $tinhTrang;
    }
}



