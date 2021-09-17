<?php

namespace App\Listeners;

use App\Events\RequestedCarCreatedEvent;
use GuzzleHttp\Client;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLeadToBitrixListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param RequestedCarCreatedEvent $event
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(RequestedCarCreatedEvent $event)
    {
        $client = new Client();
        $webhookUri = config('api.bitrix_webhook');
        $uri =  $webhookUri .
            'crm.lead.add.json?FIELDS[NAME]='. $event->data->name .
            '&FIELDS[EMAIL][0][VALUE]=' . $event->data->email .
            '&FIELDS[PHONE][0][VALUE]='. $event->data->phone;
        $response = $client->request('GET', $uri);
        return $response;
    }
}
