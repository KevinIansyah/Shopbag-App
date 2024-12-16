<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $serviceType;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($serviceType, $data)
    {
        $this->serviceType = $serviceType;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->serviceType) {
            case 'order_mail':
                Mail::to('keviniansyah10@gmail.com')->send(new OrderMail($this->data));
                break;
        }
    }
}
