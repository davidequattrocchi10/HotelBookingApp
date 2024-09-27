<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;

class BookingUpdated extends Notification
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
            ->subject('Aggiornamento Prenotazione - Hotel Booking')
            ->greeting('Ciao ' . $this->booking->nome . '!')
            ->line('La tua prenotazione è stata aggiornata.')
            ->line('Nuovi dettagli:')
            ->line('Camera: ' . $this->booking->room->nome)
            ->line('Check-in: ' . $this->booking->data_checkin)
            ->line('Check-out: ' . $this->booking->data_checkout)
            ->line('Grazie per aver scelto il nostro hotel.')
            ->salutation('Cordiali saluti, Hotel Booking');
    }
}
