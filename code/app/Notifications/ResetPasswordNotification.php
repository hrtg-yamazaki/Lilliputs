<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->subject('パスワード再設定')
            ->line('このメールは、ご登録頂いているアカウントについて、パスワード再設定をご希望の方へ送信しております。')
            ->action('再設定を行う', url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::get('このリンクの有効期限は :count 分です。', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line('再設定を希望されない場合、これ以降の操作は必要ありません。')
            ->line('( 万が一このメールに心あたりのない方は、お手数ではございますが破棄してくださいますよう、お願い申し上げます。 )');
    }

}
