<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichMuonPhong extends Model
{
    use HasFactory;

    protected $table = 'lichmuonphong';

    public $timestamps = false;

    protected $fillable = [
        'NgayMuon',
        'TietHoc',
        'MaPhong',
        'MaGiangVien',
        'GhiChu',
        'Sync'
    ];

    public function GiangVien()
    {
        // return $this->belongsTo(TaiKhoan::class, 'MaGiangVien'); //Quan Hệ  1-1
        return $this->hasMany(GiangVien::class, 'MaGiangVien'); //Quan Hệ  1-n
    }

    public function Phong()
    {
        // return $this->hasOne(TaiKhoan::class, 'MaGiangVien');
        return $this->hasMany(Phong::class, 'MaPhong');
    }

    public function setNgayMuon($ngayMuon)
    {
        $this->NgayMuon = $ngayMuon;
    }

    public function setTietHoc($tietHoc)
    {
        $this->TietHoc = $tietHoc;
    }

    public function setMaPhong($maPhong)
    {
        $this->MaPhong = $maPhong;
    }

    public function setMaGiangVien($maGiangVien)
    {
        $this->MaGiangVien = $maGiangVien;
    }

    public function setGhiChu($ghiChu)
    {
        $this->GhiChu = $ghiChu;
    }

    public function getNgayMuonFormatView()
    {
        $valueNgayChuaDinhDang = $this->NgayMuon;
        $convertDataTypeDateNgayChuaDinhDang = DateTime::createFromFormat('d-m-Y', $valueNgayChuaDinhDang);
        return $convertDataTypeDateNgayChuaDinhDang->format('d/m/Y');
    }
    public function getNgayMuonFormated()
    {
        $valueNgayChuaDinhDang = $this->NgayMuon;
        $convertDataTypeDateNgayChuaDinhDang = DateTime::createFromFormat('d-m-Y', $valueNgayChuaDinhDang);
        return $convertDataTypeDateNgayChuaDinhDang->format('Y-m-d');
    }

    public function getTietHocFormated()
    {
        $valueTietHocChuaDinhDang = $this->TietHoc;
        $arrTietHoc = explode(',', $valueTietHocChuaDinhDang);
        // dd($arrTietHoc);
        return $arrTietHoc;
    }

    public function setSyncUpdate()
    {
        $this->Sync = 1;
    }
}
