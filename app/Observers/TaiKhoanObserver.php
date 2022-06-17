<?php

namespace App\Observers;

use App\Models\GiangVien;
use App\Models\TaiKhoan;
use App\Notifications\TaoTaiKhoanNotificationMail;

class TaiKhoanObserver
{
    /**
     * Handle the TaiKhoan "created" event.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return void
     */
    public function created(TaiKhoan $taiKhoan)
    {
        // dd($taiKhoan->MaGiangVien);
        // $taiKhoan->notify(new TaoTaiKhoanNotificationMail($taiKhoan));
    }

    /**
     * Handle the TaiKhoan "updated" event.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return void
     */
    public function updated(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Handle the TaiKhoan "deleted" event.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return void
     */
    public function deleted(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Handle the TaiKhoan "restored" event.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return void
     */
    public function restored(TaiKhoan $taiKhoan)
    {
        //
    }

    /**
     * Handle the TaiKhoan "force deleted" event.
     *
     * @param  \App\Models\TaiKhoan  $taiKhoan
     * @return void
     */
    public function forceDeleted(TaiKhoan $taiKhoan)
    {
        //
    }
}
