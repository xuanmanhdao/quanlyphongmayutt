<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaoTaiKhoanNotificationMail extends Notification
{
    use Queueable;
    private $giangVien;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($giangVien)
    {
        // dd($giangVien);
        $this->giangVien = $giangVien;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Chào mừng bạn đến với UTT!')
            ->line('Đây là tài khoản đăng nhập vào ứng dụng lịch mượn phòng UTT của bạn')
            ->line('Mã giảng viên: ' . $this->giangVien->MaGiangVien)
            ->line('Mật khẩu: 123456')
            ->action('Notification Action', url('http://localhost/quanlyphongmaythuchanhutt/public/'))
            ->line('Cảm ơn bạn đã sử dụng ứng dụng!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
