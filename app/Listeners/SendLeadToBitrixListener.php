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
        $uri = 'https://b24-w923r7.bitrix24.ua/rest/1/y29e0zpk9g4ysdfu/crm.lead.add.json?FIELDS[NAME]='. $event->data->name .
            '&FIELDS[EMAIL][0][VALUE]=' . $event->data->email .
            '&FIELDS[PHONE][0][VALUE]='. $event->data->phone;
        $response = $client->request('GET', $uri);
        return $response;
    }
}
