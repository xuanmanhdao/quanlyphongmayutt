<?php

namespace App\Observers;

use App\Models\GiangVien;
use App\Models\TaiKhoan;
use App\Notifications\TaoTaiKhoanNotificationMail;
use Illuminate\Support\Facades\Hash;

class GiangVienObserver
{
    /**
     * Handle the GiangVien "created" event.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return void
     */
    public function created(GiangVien $giangVien)
    {
        // dd($giangvien->MaGiangVien);
        $maGiangVien = $giangVien->MaGiangVien;
        $matKhauMacDinh = '123456';
        TaiKhoan::create([
            'MaGiangVien' => $maGiangVien,
            'MatKhau' => Hash::make($matKhauMacDinh),
        ]);

        $giangVien->notify(new TaoTaiKhoanNotificationMail($giangVien));

        // $delay = now()->addMinutes(5);
        // $giangVien->notify((new TaoTaiKhoanNotificationMail($giangVien))->delay($delay));
    }

    /**
     * Handle the GiangVien "updated" event.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return void
     */
    public function updated(GiangVien $giangVien)
    {
        //
    }

    /**
     * Handle the GiangVien "deleted" event.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return void
     */
    public function deleted(GiangVien $giangVien)
    {
        //
    }

    /**
     * Handle the GiangVien "restored" event.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return void
     */
    public function restored(GiangVien $giangVien)
    {
        //
    }

    /**
     * Handle the GiangVien "force deleted" event.
     *
     * @param  \App\Models\GiangVien  $giangVien
     * @return void
     */
    public function forceDeleted(GiangVien $giangVien)
    {
        //
    }
}
