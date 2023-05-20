<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject)
    {
        $this->order = $data;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order');
    }

    private function prepareData($order)
    {
        $time = $order->orderDetails->shifts;
        $hour = $time->format('H');
        $minute = $time->format('i');

        $dateWork = $order->orderDetails->date_work;
        $dayStr = \App\Models\Order::convertToDayVi[$dateWork->dayOfWeek];

        $day = $dateWork->format('d');
        $month = $dateWork->format('m');
        $year = $dateWork->format('Y');

        return sprintf('%s:%s, %s - %s/%s/%s', $hour, $minute, $dayStr, $day, $month, $year);
    }
}
