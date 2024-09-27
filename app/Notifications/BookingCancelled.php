<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingCancelled extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Prenotazione Cancellata - Hotel Booking')
            ->greeting('Ciao ' . $this->booking->nome . '!')
            ->line('La tua prenotazione è stata cancellata con successo.')
            ->line('Camera: ' . $this->booking->room->nome)
            ->line('Check-in previsto: ' . $this->booking->data_checkin)
            ->line('Grazie per aver scelto il nostro hotel. Ci auguriamo di vederti presto.')
            ->salutation('Cordiali saluti, Hotel Booking');
    }
}
