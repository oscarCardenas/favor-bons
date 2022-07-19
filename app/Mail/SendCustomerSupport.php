<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class SendCustomerSupport extends Mailable
{
    use Queueable, SerializesModels;
 
    protected $data;
 
    public function __construct($data)
    {
        $this->data = $data;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {         
        return $this->view('emails.customer_support.notification_to_support')
            ->subject('New Customer Support')
            ->with([ 'data' => $this->data ]);
    }
}