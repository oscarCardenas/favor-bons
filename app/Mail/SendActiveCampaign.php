<?php
 
namespace App\Mail;
 
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
 
class SendActiveCampaign extends Mailable
{
    use Queueable, SerializesModels;
 
    protected $client;
    protected $categories;
 
    public function __construct($client,$categories)
    {
        $this->client = $client;
        $this->categories = $categories;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.active_campaign.notification_to_admin')
            ->subject('New Cliente from active campaign')
            ->with([
                'client' => $this->client,
                'categories' => $this->categories,
            ]);
    }
}