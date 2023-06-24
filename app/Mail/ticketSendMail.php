<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ticketSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ticket = $this->ticket;

        return $this
            ->subject('A Issue Has Been Submitted By ' . $ticket->product->name)
            //    -> attachData($pdf->output(),'invoice.pdf') || if u send attach mail
            ->view('pages.pdf.tickets_pdf', compact('ticket'));
    }
}
