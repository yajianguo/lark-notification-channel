<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use NotificationChannels\Lark\Exceptions\CouldNotSendNotification;


class LarkChannel
{
    /** @var Client */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 发送指定的通知。
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {   
        $LarkData = $notification->toLark($notifiable)->toArray();

        $response = $this->client->post(Arr::get($LarkData, 'url'), [
            'query' => Arr::get($LarkData, 'query'),
            'body' => json_encode(Arr::get($LarkData, 'data')),
            'verify' => Arr::get($LarkData, 'verify'),
            'headers' => Arr::get($LarkData, 'headers'),
        ]);

        if ($response->getStatusCode() >= 300 || $response->getStatusCode() < 200) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $response;
    }
}